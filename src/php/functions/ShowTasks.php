<?php

require_once(__DIR__ . '/../functions/connectSql.php');


// jsonデータの取得,返信
$rawData = file_get_contents("php://input");

if (!empty($rawData)) {
  $jsonData = json_decode($rawData, true);

  if (array_key_exists('execution_date', $jsonData)) {

    getTaskList($jsonData);

    exit;
  } else {

    $response = [
      "error" => "error1:データがありません",
    ];
    echo json_encode($response);
    exit;
  }
} else {

  $response = [
    "error" => "error2:データがありません",
  ];
  echo json_encode($response);
  exit;
}


// タスク一覧の取得
function getTaskList($jsonData)
{
  $userId = $jsonData["userId"];
  $date = $jsonData["execution_date"];

  $dbh = connectSql();

  $query = <<<EOT
  SELECT *
    FROM tasks
  WHERE user_id=:user_id
    AND execution_date=:date
  ORDER BY display_order
  EOT;

  $stmt = $dbh->prepare($query);
  $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
  $stmt->bindValue(':date', $date, PDO::PARAM_STR);
  $stmt->execute();

  $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $dbh = null;

  $response = [
    "error" => "OK",
    "taskList" => $data,
  ];

  echo json_encode($response);
}
