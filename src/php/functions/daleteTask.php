<?php

require_once(__DIR__ . '/../functions/connectSql.php');

// jsonデータの取得
$rawData = file_get_contents("php://input");

if (!empty($rawData)) {
  $jsonData = json_decode($rawData, true);

  if (array_key_exists('deleteTaskId', $jsonData)) {
    deleteTask($jsonData);
  } else {
    $response = [
      "error" => "error1:データがありません",
      "deletedTaskId" => $deleteTaskId
    ];
    echo json_encode($response);
    exit;
  }
} else {
  $response = [
    "error" => "error3:データがありません",
    "deletedTaskId" => $deleteTaskId
  ];
  echo json_encode($response);
  exit;
}


function deleteTask($jsonData)
{
  $deleteTaskId = $jsonData['deleteTaskId'];


  $dbh = connectSql();

  $query = <<<EOT
          DELETE FROM tasks
          WHERE task_id = :taskId
      EOT;

  $stmt = $dbh->prepare($query);
  $stmt->bindParam(':taskId', $deleteTaskId, PDO::PARAM_INT);
  $stmt->execute();

  $dbh = null;

  $response = [
    "error" => "OK",
    "deletedTaskId" => $deleteTaskId
  ];
  echo json_encode($response);
  exit;
}
