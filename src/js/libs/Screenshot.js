class Screenshot {
    capture() {
      const buttonContainer = document.getElementById('js-capture-btn');
      buttonContainer.style.display = 'none';

      const elementToCapture = document.getElementById('js-capture');
      elementToCapture.classList.add('js-capture-style');

      html2canvas(elementToCapture).then(function (canvas) {
        const img = canvas.toDataURL('image/png');
        const link = document.createElement('a');
        link.href = img;
        // TODO: ファイル名の命名を考える
        link.download = 'screenshot.png';
        link.click();

        elementToCapture.classList.remove('js-capture-style');
      });
    }
  }
