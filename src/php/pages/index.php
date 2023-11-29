<?php
require_once(__DIR__ . '/header.php');
require_once(__DIR__ . '/footer.php');
require_once(__DIR__ . '/../functions/connectSql.php');
require_once(__DIR__ . '/../functions/ShowTasks.php');

getHeader();
?>
<main>
  <section id="task-management">
    <h2><span>〇月〇日のタスク一覧</span></h2>
    <ul class="task-lists">
      <?php
      // 仮に user_id が 1 のユーザー、日付を2023-11-20として実装
      $userId = 1;
      $date = '2023-11-20';
      showTasks($userId, $date);
      ?>
      <li class="task-list">
        <form class="add_task_form" action="../functions/TaskControl.php" method="post">
          <input type="hidden" name="form_id" value="input_task">
          <input class="input_task" type="text" name="input_task">
          <button class="add_task_btn" type="submit">＋</button>
        </form>
      </li>
    </ul>
  </section>
</main>
<?php
getFooter();
?>