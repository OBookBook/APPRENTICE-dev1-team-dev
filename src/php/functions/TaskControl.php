<?php

require_once(__DIR__ . '/../functions/connectSql.php');

function getInputTask($userId, $date)
{
  $inputTask = $_POST['input_task'];

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
    :task,
    :date,
    0,
    (SELECT (MAX(display_order) + 1)
      FROM tasks as t
    WHERE t.user_id = :userId))
EOT;

  $stmt = $dbh->prepare($query);
  $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
  $stmt->bindParam(':date', $date, PDO::PARAM_STR);
  $stmt->bindParam(':task', $inputTask, PDO::PARAM_STR);
  $stmt->execute();

  $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $dbh = null;

  return $tasks;

  echo $inputTask;
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
    } elseif ($_POST['form_id'] === 'input_task') {
      getInputTask(1, '2023-11-20');
    }
  }
}
header("Location: ../pages/index.php");
