<?php

require_once(__DIR__ . '/../functions/connectSql.php');

function validate($inputTask)
{
  $error = "OK";
  if (!strlen($inputTask)) {
    $error = 'タスク名を入力してください';
  } elseif (strlen($inputTask) > 255) {
    $error = '255文字で入力してください';
  }
  return $error;
}

function getInputTask($userId, $date, $taskName)
{
  $inputTask = ($taskName);
  $error = validate($inputTask);
  $response = [];

  if ($error === "OK") {
    $inputTask = nl2br(htmlspecialchars($inputTask));

    $dbh = connectSql();

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
    $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
    $stmt->bindParam(':date', $date, PDO::PARAM_STR);
    $stmt->bindParam(':taskName', $inputTask, PDO::PARAM_STR);
    $stmt->execute();

    $query = <<<EOT
    SELECT MAX(task_id) as newTaskId FROM tasks
    WHERE user_id = :userId
      AND task_name = :taskName
      AND execution_date = :date
  EOT;

    $stmt2 = $dbh->prepare($query);
    $stmt2->bindParam(':userId', $userId, PDO::PARAM_INT);
    $stmt2->bindParam(':date', $date, PDO::PARAM_STR);
    $stmt2->bindParam(':taskName', $inputTask, PDO::PARAM_STR);
    $stmt2->execute();

    $data = $stmt2->fetch(PDO::FETCH_ASSOC);
    $newTaskId = $data["newTaskId"];

    $dbh = null;

    $response = [
      "error" => $error,
      "newTaskId" => $newTaskId
    ];
  } else {
    $response = [
      "error" => $error,
      "newTaskId" => "",
    ];
  }
  echo json_encode($response);
  exit;
}


function deleteTask()
{
  $taskId = $_POST['delete_task_id'];

  $dbh = connectSql();

  $query = <<<EOT
      DELETE FROM tasks
      WHERE task_id = :taskId
  EOT;

  $stmt = $dbh->prepare($query);
  $stmt->bindParam(':taskId', $taskId, PDO::PARAM_INT);
  $stmt->execute();

  $dbh = null;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  if (isset($_POST['form_id'])) {

    if ($_POST['form_id'] === 'delete_task') {

      deleteTask();
      header("Location: ../pages/index.php");
    } else {
      exit;
    }
  } else {
    $rawData = file_get_contents("php://input");

    if (!empty($rawData)) {
      $jsonData = json_decode($rawData, true);

      if ($jsonData !== null) {
        $taskName = $jsonData['newTask'];
        getInputTask(1, '2023-11-20', $taskName);
      }
    }
  }
}
