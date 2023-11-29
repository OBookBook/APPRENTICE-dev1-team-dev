const screenshot = new Screenshot();

// 本日の日報を端末にダウンロード
document.getElementById('js-captureGet-btn').addEventListener('click', function() {
  screenshot.get();
});

// twitterに日報画像付きでシェア
document.getElementById('js-captureTweet-btn').addEventListener('click', function() {
  screenshot.capture();
});
