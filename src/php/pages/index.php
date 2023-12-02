<?php
require_once(__DIR__ . '/header.php');
require_once(__DIR__ . '/footer.php');
require_once(__DIR__ . '/../functions/ConnectionToSql.php');
require_once(__DIR__ . '/../classes/TimeSelectorBox.php');

getHeader();

$timeSelectorBox = new TimeSelectorBox();
?>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<main>
  <div id="calendar-wrapper">
    <div id="cal-header">
      <button id="prev">&lt;</button>
      <h2 id="year-month"></h2>
      <button id="next">&gt;</button>
    </div>
    <div id="calendar"></div>
  </div>

  <div class="bottom-wrapper">
    <section id="task-management">
      <h2><span>タスク一覧</span></h2>
      <ul class="task-lists">
      </ul>
    </section>

    <section id="report">
      <div id="copyTarget">
        <h2><span>本日の実績</span></h2>
        <div id="js-capture">
          <!-- <h1>📅 日付:11 月 26 日(日)</h1> -->
          <p class="study_hours">
            <span class="material-symbols-outlined">alarm</span>
            <span>学習時間 10 時間</span>
          </p>
          <ul>
            <li>
              <span class="material-symbols-outlined">priority</span>
              <span>AtCoder Problems ABC317 : C 問題</span>
            </li>
            <li>
              <span class="material-symbols-outlined">priority</span>
              <span>QUEST 24 : ブラウザの仕組みを説明できる(advanced)</span>
            </li>
            <li>
              <span class="material-symbols-outlined">priority</span>
              <span>技術記事 : Web ブラウザの仕組み</span>
            </li>
            <li>
              <span class="material-symbols-outlined">dangerous</span>
              <span>提出クエスト : React+TypeScript 実装</span>
            </li>
            <li>
              <span class="material-symbols-outlined">priority</span>
              <span>チーム開発準備 Docker : Xdebug 環境構築</span>
            </li>
            <li>
              <span class="material-symbols-outlined">priority</span>
              <span>本 : これからはじめる React 実践入門</span>
            </li>
            <div class="memo">【明日】AtCoder、チーム開発実装!!</div>
          </ul>
        </div>
      </div>
      <p>-------------------------------------------------------</p>
      <p id="js-text-answer" class="js-aiText-hidden">
        【AIからのコメント】
        Ajaxで取得してきた、本日の実績AIコメントを表示して頂けたら、以下、id属性とclass属性をつけて下さい。id="js-text-answer" class="js-aiText-hidden"。textarea要素をフォーカスアウトしたら、イベントが発火して登録、更新APIが走ります。
        今日の日報が存在しない場合は新規登録。
        今日の日報が存在する場合は更新。
        また、チャットGPTからのコメントが登録、更新するごとに走るようになってますので、リアルタイム感がでます。

        イベントをフォーカスアウトにしたので、submitボタンは削除しました。

      </p>
      <p>-------------------------------------------------------</p>
      <form id="reportForm">
        <div class="reflection-wrapper">
          <div>
            <label for="reflectionComment">本日の振り返りを記入</label>
            <textarea id="reflectionComment" class="js-aiText-hidden" name="reflectionComment"></textarea><br>
          </div>
          <div>
            <label for="studyHours">学習時間</label>
            <select id="studyHours" name="studyHours">
              <?php echo $timeSelectorBox->generateOptions(); ?>
            </select>
            <!-- <input type="submit" value="Submit"> -->
          </div>
        </div>
      </form>
      <div class="btn-wrapper">
        <button id="js-captureGet-btn">Download</button>
        <button id="js-copy-btn">Copy</button>
        <button id="js-twitter-btn">Share for X</button>
      </div>
    </section>
  </div>
</main>

<?php getFooter(); ?>