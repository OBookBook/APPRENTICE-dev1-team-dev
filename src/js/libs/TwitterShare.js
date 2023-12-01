/**
 * Twitterへの投稿ダイアログを扱います。
 */
class TwitterShare {
  /**
   * ツイート内容を入力するダイアログを開きます。
   * @returns {void}
   */
  openDialog() {
    Swal.fire({
      title: "ツイート入力",
      html: '<textarea id="tweetText" rows="7" cols="45" placeholder="ツイートを入力してください""></textarea>' +
        '<p>文字数: <span id="characterCount">148</span></p>' +
        '<div class="btn-container">' +
        '<button id="js-tweet-text-post">テキスト投稿</button>' +
        '<button id="js-tweet-textImage-post">テキスト画像投稿</button>' +
        '</div>',
      showCloseButton: true,
      showConfirmButton: false,
      customClass: {
        popup: 'custom-swal2-popup'
      }
    });
      document.getElementById('tweetText').addEventListener('input', this.countCharacters);
      document.getElementById('js-tweet-text-post').addEventListener('click', this.shareText);
      document.getElementById('js-tweet-textImage-post').addEventListener('click', this.shareTextAndImage);
  }

  /**
   * テキストエリア内の文字数をカウントして表示します。
   * @returns {void}
   */
  countCharacters() {
    const textArea = document.getElementById('tweetText');
    const countSpan = document.getElementById('characterCount');

    const text = textArea.value;
    let totalCount = 148 - text.length;
    countSpan.textContent = totalCount;

    if (totalCount <= 0) {
      countSpan.classList.add('js-over-limit');
    } else {
      countSpan.classList.remove('js-over-limit');
    }
  }

  /**
   * テキストのみ投稿のイベント処理
   * @returns {void}
   */
  shareText() {
    const tweetText = document.getElementById('tweetText').value;
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../../php/functions/post_text_tweet.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        Swal.fire('OK', '投稿に成功しました!!', 'success');
      }else{
        Swal.fire('エラー', 'テキストのみの投稿に失敗しました', 'error');
      }
    };
    xhr.send('tweet=' + encodeURIComponent(tweetText)); // ツイート内容をエンコードして送信
  }

  /**
   * テキストと画像投稿のイベント処理
   * @returns {void}
   */
  shareTextAndImage() {
    Swal.fire('エラー', 'テキストと画像の投稿に失敗しました', 'error');
  }
}
