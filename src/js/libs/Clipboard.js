class Clipboard {
    /**
     * 指定された要素のテキストをクリップボードにコピーします。
     * @param {string} targetId - コピー先要素のID
     * @returns {Promise<void>} コピーが成功した場合はresolve、失敗した場合はrejectを返します。
     */
    copyToClipboard(targetId) {
        /**
         * コピー対象の要素
         * @type {HTMLElement}
         */
        const copyTarget = document.getElementById(targetId);

        if (!copyTarget) {
            console.error(`IDが ${targetId} の要素は存在しません`);
            return Promise.reject(`IDが ${targetId} の要素は存在しません`);
        }

        /**
         * コピーするテキスト
         * @type {string}
         */
        const copyText = copyTarget.innerText;

        return navigator.clipboard.writeText(copyText)
            .then(() => {
                alert("コピーできました！ : " + copyText);
            })
            .catch(err => {
                console.error('コピーに失敗しました:', err);
                throw err;
            });
    }
}
