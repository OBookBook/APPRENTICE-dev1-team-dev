<?php
require_once(__DIR__ . '/header.php');
require_once(__DIR__ . '/footer.php');

getHeader();
?>
<main>
  <div id="calendar-wrapper">
    <div id="cal-header">
      <button id="prev">&lt;</button>
      <h2 id="month-date"></h2>
      <button id="next">&gt;</button>
    </div>
    <div id="calendar"></div>
  </div>
</main>
<?php
getFooter();
?>
