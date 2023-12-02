import { Calendar } from "./Calendar.js";

const cal = new Calendar();
cal.createCalendar();
cal.setDateClickEvent();
cal.PrevMonth();
cal.NextMonth();
cal.showTodaysContents();

// 本日の日報を端末にダウンロード
const screenshot = new Screenshot();
document.getElementById("js-captureGet-btn").addEventListener("click", function () {
  screenshot.get();
});

// 本日の実績textarea要素にてフォーカスが外れた際にイベントが発火します。
const reportHandler = new ReportFormHandler();
document.getElementById("reflectionComment").addEventListener("blur", reportHandler.handleSubmit);

// コピペクリックイベント
document.getElementById("js-copy-btn").addEventListener("click", function () {
  const clipboard = new Clipboard();
  clipboard.copyToClipboard("copyTarget");
});

// twitterボタンクリックイベント
document.getElementById("js-twitter-btn").addEventListener("click", function () {
  const twitterShare = new TwitterShare();
  twitterShare.openDialog();
});

// 引数で渡した要素の文字が1文字ずつ表示されます。 AIからのコメントで使用
const animator = new TextAnimator("js-text-answer");
