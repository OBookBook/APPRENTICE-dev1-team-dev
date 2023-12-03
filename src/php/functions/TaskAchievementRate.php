<?php

require_once("Task.php");
class TaskAchievementRate extends Task
{
  public function calcMonthlyAchievementRate($raw)
  {
    $dateArr = json_decode($raw);
    $dbh = $this->connectionToSql->connectSql();
    $compArr = [];
    $res = [];

    $query = <<<EOT
    SELECT completion_status
      FROM tasks
     WHERE user_id = 1
       AND execution_date = :date
    EOT;

    $stmt = $dbh->prepare($query);
    foreach ($dateArr as $date) {
      $stmt->bindValue(':date', $date, PDO::PARAM_STR);
      $stmt->execute();
      $compArr[] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    for ($i = 0; $i < count($compArr); $i++) {
      $amountOfTasks = count($compArr[$i]);
      $complete = 0;
      for ($j = 0; $j < $amountOfTasks; $j++) {
        if ($compArr[$i][$j]["completion_status"] == 1) {
          $complete++;
        }
      }
      if ($complete == 0) {
        $res[$i] = [0];
      } else {
        $rate = floor($complete / $amountOfTasks * 100);
        $res[$i] = [$rate];
        $res[$i][] = 100 - $rate;
      }
    }
    $dbh = null;
    echo json_encode($res);
  }
}
$raw = file_get_contents("php://input");
$taskAchievementRate = new TaskAchievementRate();
$taskAchievementRate->calcMonthlyAchievementRate($raw);
