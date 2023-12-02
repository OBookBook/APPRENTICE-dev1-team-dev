<?php

require_once("Task.php");

class UnnecessaryTask extends Task
{
  private $deleteTaskId;

  public function checkReceivedInfo($rawData)
  {
    if (!empty($rawData)) {
      $jsonData = json_decode($rawData, true);

      if (array_key_exists('deleteTaskId', $jsonData)) {
        $this->deleteTask($jsonData);
      } else {
        $response = [
          "error" => "error1:データがありません",
          "deletedTaskId" => $this->deleteTaskId
        ];
        echo json_encode($response);
        exit;
      }
    } else {
      $response = [
        "error" => "error2:データがありません",
        "deletedTaskId" => $this->deleteTaskId
      ];
      echo json_encode($response);
      exit;
    }
  }

  public function deleteTask($jsonData)
  {
    $this->deleteTaskId = $jsonData['deleteTaskId'];

    $dbh = $this->connectionToSql->connectSql();

    $query = <<<EOT
            DELETE FROM tasks
            WHERE task_id = :taskId
        EOT;

    $stmt = $dbh->prepare($query);
    $stmt->bindParam(':taskId', $this->deleteTaskId, PDO::PARAM_INT);
    $stmt->execute();

    $dbh = null;

    $response = [
      "error" => "OK",
      "deletedTaskId" => $this->deleteTaskId
    ];
    echo json_encode($response);
    exit;
  }
}


$unnecessaryTask = new UnnecessaryTask();

// jsonデータの取得
$rawData = file_get_contents("php://input");
$unnecessaryTask->checkReceivedInfo($rawData);
