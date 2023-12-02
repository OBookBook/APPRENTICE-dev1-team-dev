  /**
   * テキストを1文字ずつ表示するアニメーションを行うクラス
   */
class TextAnimator {
  constructor(elementClass, speed = 40) {
    const elementsWithHiddenClass = document.getElementsByClassName(elementClass);

    if (elementsWithHiddenClass.length > 0) {
      this.text = elementsWithHiddenClass[0].innerText;
      elementsWithHiddenClass[0].innerText = '';
      this.element = elementsWithHiddenClass[0];
      this.element.classList.remove('js-aiText-hidden');
      this.speed = speed;
      this.animateText();
    } else {
      console.error('指定されたクラスを持つ要素が見つかりませんでした。');
    }
  }

  animateText() {
    let index = 0;
    const interval = setInterval(() => {
      // 文字として表示したい部分
      const displayText = this.text.slice(0, index + 1);
      this.element.innerText = this.addSpaces(displayText); // スペースを追加して表示
      index++;
      if (index === this.text.length) {
        clearInterval(interval);
      }
    }, this.speed);
  }

  // 適切なスペースと改行を追加する関数
  addSpaces(text) {
    // ここでは、特定の箇所で改行を追加しています。必要に応じて修正してください。
    const words = text.split(/(?=[A-Z])/); // 大文字の位置で単語を分割する
    const spacedText = words.join(' ').replace(/(?<=[a-z])(?=[A-Z])/g, '\n'); // スペースと改行を追加する
    return spacedText;
  }
}
