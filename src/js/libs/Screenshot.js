/**
 * 画面のスクリーンショットをキャプチャおよび取得するクラスです。
 */
class Screenshot {
  /**
   * 画面のスクリーンショットを取得し、ダウンロードします。
   */
  get() {
    const elementToCapture = document.getElementById('js-capture');
    elementToCapture.classList.add('js-capture-style');

    const today = new Date();
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, '0');
    const day = String(today.getDate()).padStart(2, '0');
    const dateFormatted = `${year}${month}${day}`;

    html2canvas(elementToCapture).then(function (canvas) {
      const img = canvas.toDataURL('image/png');
      const link = document.createElement('a');
      link.href = img;
      link.download = `日報_${dateFormatted}.png`;
      link.click();

      elementToCapture.classList.remove('js-capture-style');
    });
  }
}
