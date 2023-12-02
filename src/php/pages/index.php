<?php
require_once(__DIR__ . '/header.php');
require_once(__DIR__ . '/footer.php');
require_once(__DIR__ . '/../functions/connectSql.php');

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
    <h2><span>タスク一覧</span></h2>
    <ul class="task-lists">
    </ul>
  </section>
</main>
<?php
getFooter();
?>