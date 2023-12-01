<?php
require_once(__DIR__ . '/header.php');
require_once(__DIR__ . '/footer.php');
require_once(__DIR__ . '/../functions/connectSql.php');
require_once(__DIR__ . '/../functions/ShowTasks.php');
require_once(__DIR__ . '/../classes/TimeSelectorBox.php');

getHeader();

$timeSelectorBox = new TimeSelectorBox();
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
  <section>
    <div id="copyTarget">
      <h3>本日の実績</h3>
      <div id="js-capture">
        <h1>📅 日付:11 月 26 日(日)</h1>
        <p>⌚ 学習時間 10 時間</p>
        <ul>
          <li>✅ AtCoder Problems ABC317 : C 問題 (完了)</li>
          <li>✅ QUEST 24 : ブラウザの仕組みを説明できる(advanced) (完了)</li>
          <li>✅ 技術記事 : Web ブラウザの仕組み (提出完了)</li>
          <li>✅ 提出クエスト : React+TypeScript 実装 (完了)</li>
          <li>✅ チーム開発準備 Docker : Xdebug 環境構築 (完了)</li>
          <li>✅ 本 : これからはじめる React 実践入門</li>
          <p>【明日】AtCoder、チーム開発実装!!</p>
        </ul>
      </div>
    </div>
    <form id="reportForm">
      <label for="reflectionComment">本日の振り返りを記入</label>
      <textarea id="reflectionComment" name="reflectionComment"></textarea><br>
      <label for="studyHours">学習時間:</label>
      <select id="studyHours" name="studyHours">
        <?php echo $timeSelectorBox->generateOptions(); ?>
      </select>
      <input type="submit" value="Submit">
    </form>
    <button id="js-captureGet-btn">日報ダウンロード</button>
    <button id="js-captureTweet-btn">twitter 改造中、php/outputフォルダ内に格納されるのみです</button>
    <button id="js-copy-btn">コピペボタン</button>
    <button id="js-twitter-btn">Twitterにシェア</button>
  </section>
</main>

<?php getFooter(); ?>
