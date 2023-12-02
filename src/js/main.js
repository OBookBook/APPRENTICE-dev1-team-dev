import { createCalender } from "./calendar.js";
import { changeStatus } from "./changeStatus.js";

createCalender();
changeStatus();


// 本日の日報を端末にダウンロード
const screenshot = new Screenshot();
document.getElementById('js-captureGet-btn').addEventListener('click', function() {
    screenshot.get();
});

// 本日の実績登録イベント
const reportHandler = new ReportFormHandler();
document.getElementById('reportForm').addEventListener('submit', reportHandler.handleSubmit);

// コピペクリックイベント
document.getElementById('js-copy-btn').addEventListener('click', function() {
    const clipboard = new Clipboard();
    clipboard.copyToClipboard('copyTarget');
});

// twitterボタンクリックイベント
document.getElementById('js-twitter-btn').addEventListener('click', function() {
    const twitterShare = new TwitterShare();
    twitterShare.openDialog();
});
