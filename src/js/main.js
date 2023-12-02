import { Calendar } from "./calendar.js";
import { changeStatus } from "./changeStatus.js";
import { createNewTask } from "./createNewTask.js";
import { deleteTask } from "./deleteTask.js";

const cal = new Calendar();
cal.createCalendar();
cal.setDateClickEvent();
cal.PrevMonth();
cal.NextMonth();
createNewTask();
deleteTask();
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
