  /**
   * テキストを1文字ずつ表示するアニメーションを行うクラス
   */
  class TextAnimator {
    /**
     * @param {string} elementId - 表示するテキストが含まれるHTML要素のID
     * @param {number} [speed=40] - テキストを表示する速度（ミリ秒単位）
     */
    constructor(elementId, speed = 40) {
      /**
       * 表示するテキストが含まれるHTML要素
       * @type {HTMLElement}
       */
      this.element = document.getElementById(elementId);

      /**
       * 表示するテキスト
       * @type {string}
       */
      this.text = this.element.innerText;

      // テキストをクリアしてアニメーションを開始する
      this.element.innerText = '';

      /**
       * テキストを表示する速度（ミリ秒単位）
       * @type {number}
       */
      this.speed = speed;

      // テキストの表示を開始し、js-aiText-hiddenクラスを除去して要素を表示する
      this.animateText();
      this.element.classList.remove('js-aiText-hidden');
    }

    /**
     * テキストをアニメーション表示するメソッド
     */
    animateText() {
      let index = 0;
      const interval = setInterval(() => {
        this.element.innerText += this.text[index];
        index++;
        if (index === this.text.length) {
          clearInterval(interval);
        }
      }, this.speed);
    }
  }
