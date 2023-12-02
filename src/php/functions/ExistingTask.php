<?php

require_once("Task.php");

class ExistingTask extends Task
{
  public function checkReceivedInfo($rawData)
  {
    if (!empty($rawData)) {
      $jsonData = json_decode($rawData, true);

      if (array_key_exists('execution_date', $jsonData)) {

        $this->getTaskList($jsonData);

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
  }

  // タスク一覧の取得
  public function getTaskList($jsonData)
  {
    $userId = $jsonData["userId"];
    $date = $jsonData["execution_date"];

    $dbh = $this->connectionToSql->connectSql();

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

    $taskList = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $query = <<<EOT
  SELECT *
    FROM reports
  WHERE user_id=:user_id
    AND submitted_date=:date
  EOT;

    $stmt2 = $dbh->prepare($query);
    $stmt2->bindValue(':user_id', $userId, PDO::PARAM_INT);
    $stmt2->bindValue(':date', $date, PDO::PARAM_STR);
    $stmt2->execute();

    $report = $stmt2->fetch(PDO::FETCH_ASSOC);

    $dbh = null;

    $response = [
      "error" => "OK",
      "taskList" => $taskList,
      "report" => $report,
    ];

    echo json_encode($response);
  }
}

// jsonデータの取得
$rawData = file_get_contents("php://input");

$existingTask = new ExistingTask();

$existingTask->checkReceivedInfo($rawData);
