<?php
require_once(__DIR__ . '/header.php');
require_once(__DIR__ . '/footer.php');
require_once(__DIR__ . '/../functions/connectSql.php');
require_once(__DIR__ . '/../functions/ShowTasks.php');

getHeader();
?>
<main>
  <div id="calendar-wrapper">
    <div id="cal-header">
      <button id="prev">&lt;</button>
      <h2 id="year-month"></h2>
      <button id="next">&gt;</button>
    </div>
    <div id="calendar"></div>
  </div>
  <section id="task-management">
    <h2><span>〇月〇日のタスク一覧</span></h2>
    <ul class="task-lists">
      <?php
      // 仮に user_id が 1 のユーザー、日付を2023-11-20として実装
      $userId = 1;
      $date = '2023-11-20';
      showTasks($userId, $date);
      ?>
      <li class="task-list list_to_add_task">
        <form class="add_task_form" action="../functions/TaskControl.php" method="post">
          <input type="hidden" name="form_id" value="input_task">
          <input class="input_task" type="text" name="input_task" maxlength="255" required>
          <button class="add_task_btn disabled" type="submit" disabled><span class="add_task_btn_inner">＋</span></button>
        </form>
      </li>
      <div class="feed_back"></div>
    </ul>
  </section>
</main>
<?php
getFooter();
?>
