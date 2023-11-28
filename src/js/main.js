console.log("デイリポ開発!!");

// 画像生成
document.getElementById('js-capture-btn').addEventListener('click', function() {
  const screenshot = new Screenshot();
  screenshot.capture();
});
