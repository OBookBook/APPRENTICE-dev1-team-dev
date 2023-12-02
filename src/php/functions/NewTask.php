<?php

require_once("Task.php");

class NewTask extends Task
{
  public $error;
  public $response = [];
  public $taskName;
  public $userId;
  public $execution_date;

  public function __construct()
  {
    $this->userId = 1;
    $this->error = "OK";
  }


  public function checkReceivedInfo($rawData)
  {
    if (!empty($rawData)) {
      $jsonData = json_decode($rawData, true);

      if ($jsonData !== null) {

        if (array_key_exists('newTask', $jsonData)) {
          $this->taskName = $jsonData['newTask'];
          $this->execution_date = $jsonData['execution_date'];
        }
      } else {
        $this->error = "データがありません";
        echo json_encode($this->error);
        exit;
      }
    } else {
      $this->error = "データがありません";
      echo json_encode($this->error);
      exit;
    }
  }


  private function validate($inputTask)
  {

    if (!strlen($inputTask)) {
      $this->error = 'タスク名を入力してください';
    } elseif (strlen($inputTask) > 255) {
      $this->error = '255文字で入力してください';
    }
    return $this->error;
  }


  public function insertTask($rawData)
  {
    $this->checkReceivedInfo($rawData);

    $inputTask = $this->taskName;
    $error = $this->validate($inputTask);
    $this->response = [];

    if ($this->error === "OK") {
      // XSS攻撃対策
      $inputTask = nl2br(htmlspecialchars($inputTask));

      $connectionToSql = new ConnectionToSql();
      $dbh = $connectionToSql->connectSql();

      $query = <<<EOT
      INSERT INTO tasks
        (user_id,
        task_name,
        execution_date,
        completion_status,
        display_order)
      VALUES
        (:userId,
        :taskName,
        :date,
        0,
        (SELECT (MAX(display_order) + 1)
          FROM tasks as t
        WHERE t.user_id = :userId))
    EOT;

      $stmt = $dbh->prepare($query);
      $stmt->bindParam(':userId', $this->userId, PDO::PARAM_INT);
      $stmt->bindParam(':date', $this->execution_date, PDO::PARAM_STR);
      $stmt->bindParam(':taskName', $inputTask, PDO::PARAM_STR);
      $stmt->execute();

      $query = <<<EOT
      SELECT MAX(task_id) as newTaskId FROM tasks
      WHERE user_id = :userId
        AND task_name = :taskName
        AND execution_date = :date
    EOT;

      $stmt2 = $dbh->prepare($query);
      $stmt2->bindParam(':userId', $this->userId, PDO::PARAM_INT);
      $stmt2->bindParam(':date', $this->execution_date, PDO::PARAM_STR);
      $stmt2->bindParam(':taskName', $inputTask, PDO::PARAM_STR);
      $stmt2->execute();

      $data = $stmt2->fetch(PDO::FETCH_ASSOC);
      $newTaskId = $data["newTaskId"];

      $dbh = null;

      $this->response = [
        "error" => $this->error,
        "newTaskId" => $newTaskId
      ];
    } else {
      $this->response = [
        "error" => $this->error,
        "newTaskId" => "",
      ];
    }
    echo json_encode($this->response);
    exit;
  }
}


// jsonデータの取得
$rawData = file_get_contents("php://input");

$newTask = new NewTask();
$newTask->insertTask($rawData);
