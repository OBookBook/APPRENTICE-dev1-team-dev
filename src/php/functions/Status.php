<?php

require_once("Task.php");

class Status extends Task
{
  public $error = "OK";
  private $taskId;
  private $completion_status;

  private function checkReceivedInfo($rawData)
  {
    if (!empty($rawData)) {
      $jsonData = json_decode($rawData, true);

      if ($jsonData !== null) {
        $this->taskId = $jsonData['taskId'];

        if ($jsonData['isChecked']) {
          $this->completion_status = 1;
        } else {
          $this->completion_status = 0;
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

  public function insertTask($rawData)
  {
    $this->checkReceivedInfo($rawData);

    $dbh = $this->connectionToSql->connectSql();

    $query = <<<EOT
      UPDATE tasks
      SET completion_status = :completion_status
      WHERE task_id = :taskId
    EOT;

    $stmt = $dbh->prepare($query);
    $stmt->bindParam(':completion_status', $this->completion_status, PDO::PARAM_INT);
    $stmt->bindParam(':taskId', $this->taskId, PDO::PARAM_INT);
    $stmt->execute();

    echo json_encode($this->error);
    $dbh = null;
    exit;
  }
}


$rawData = file_get_contents("php://input");
$status = new Status();
$status->insertTask($rawData);
?>
<script src="../../js/changeStatus.js"></script>