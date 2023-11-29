<?php

require_once(__DIR__ . '/../functions/connectSql.php');

function getTasksOfTheDay($userId, $date)
{
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

  $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $dbh = null;

  return $tasks;
}

function showTasks($userId, $date)
{
  $tasks = getTasksOfTheDay($userId, $date);

  foreach ($tasks as $task) {
?>
    <li class="task-list">
      <div>
        <form method="POST" action="../functions/TaskControl.php">
          <input type="hidden" name="form_id" value="get_task">
          <?php if ($task["completion_status"] === 0) : ?>
            <input class="checkbox" type="checkbox" name="<?php echo $task["task_id"]; ?>">
          <?php else : ?>
            <input class="checkbox" type="checkbox" name="<?php echo $task["task_id"]; ?>" checked>
          <?php endif; ?>
          <?php echo $task["task_name"]; ?>
        </form>
      </div>
      <form method="POST" action="../functions/TaskControl.php">
        <input type="text" name="form_id" value="delete_task" hidden>
        <input type="text" name="delete_task_id" value="<?php echo $task["task_id"]; ?>" hidden>
        <label>
          <span class="delete-icon material-symbols-outlined">delete</span>
          <button type="submit" name="delete-btn" hidden>
        </label>
      </form>
    </li>
<?php
  }
}
