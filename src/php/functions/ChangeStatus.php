<?php
require_once(__DIR__ . '/connectSql.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $rawData = file_get_contents("php://input");

  if (!empty($rawData)) {
    $jsonData = json_decode($rawData, true);

    if ($jsonData !== null) {
      $taskId = $jsonData['taskId'];

      if ($jsonData['isChecked']) {
        $completion_status = 1;
      } else {
        $completion_status = 0;
      }

      $dbh = connectSql();

      $query = <<<EOT
        UPDATE tasks
        SET completion_status = :completion_status
        WHERE task_id = :taskId
      EOT;

      $stmt = $dbh->prepare($query);
      $stmt->bindParam(':completion_status', $completion_status, PDO::PARAM_INT);
      $stmt->bindParam(':taskId', $taskId, PDO::PARAM_INT);
      $stmt->execute();

      echo json_encode($jsonData);
      $dbh = null;
      exit;
    }
  }
}
