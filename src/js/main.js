console.log("デイリポ開発!!");

function screenshot() {
  var buttonContainer = document.getElementById('js-capture-btn');
  buttonContainer.style.display = 'none'; // ボタンを非表示にする

  var elementToCapture = document.getElementById('js-capture');
  elementToCapture.classList.add('js-capture-style');

  html2canvas(elementToCapture).then(function (canvas) {
    var img = canvas.toDataURL('image/png');
    var link = document.createElement('a');
    link.href = img;
    link.download = 'screenshot.png';
    link.click();

    elementToCapture.classList.remove('js-capture-style');
  });
}
