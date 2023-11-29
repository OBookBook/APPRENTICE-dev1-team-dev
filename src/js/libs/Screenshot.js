/**
 * HACK: あまりきれいじゃないコード、余裕ができたら綺麗にしますね。
 * 画面のスクリーンショットをキャプチャおよび取得するクラスです。
 */
class Screenshot {
  /**
   * 画面のスクリーンショットをキャプチャして保存します。
   * @async
   * @returns {Promise<void>} 画像の保存処理が完了するPromise
   */
  async capture() {
    try {
      const elementToCapture = document.getElementById('js-capture');
      elementToCapture.classList.add('js-capture-style');

      // await を追加して Promise を待つ
      const canvas = await html2canvas(elementToCapture);
      const imgData = canvas.toDataURL('image/png');
      const response = await fetch('save_image.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `imgData=${encodeURIComponent(imgData)}`
      });

      if (response.ok) {
        console.log('画像を保存しました');
      } else {
        throw new Error('画像の保存に失敗しました');
      }

    } catch (error) {
      console.error('エラー:', error);
    }
  }

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
