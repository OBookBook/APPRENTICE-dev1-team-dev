const screenshot = new Screenshot();
const reportHandler = new ReportFormHandler();

// 本日の日報を端末にダウンロード
document.getElementById('js-captureGet-btn').addEventListener('click', function() {
    screenshot.get();
});
// twitterに日報画像付きでシェア
document.getElementById('js-captureTweet-btn').addEventListener('click', function() {
    screenshot.capture();
});

// 本日の実績登録イベント
document.getElementById('reportForm').addEventListener('submit', reportHandler.handleSubmit);
