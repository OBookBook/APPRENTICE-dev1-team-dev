class Clipboard {
    /**
     * 指定された要素のテキストをクリップボードにコピーします。
     * @param {string} targetId - コピー先要素のID
     * @returns {Promise<void>} コピーが成功した場合はresolve、失敗した場合はrejectを返します。
     */
    copyToClipboard(targetId) {
        const copyTarget = document.getElementById(targetId);
        if (!copyTarget) {
            console.error(`IDが ${targetId} の要素は存在しません`);
            return Promise.reject(`IDが ${targetId} の要素は存在しません`);
        }

        const lines = copyTarget.innerText.split('\n');
        const copiedContent = lines
            .map(line => line.replace(/(alarm|priority|dangerous)/g, '').trim()) // 不要な文字列を削除
            .filter(line => line !== ''); // 空行を除去

        // 学習内容とメモを挿入
        copiedContent.splice(2, 0, "");
        copiedContent.splice(3, 0, "【学習内容】");
        copiedContent.splice(copiedContent.length - 1, 0, "");
        copiedContent.splice(copiedContent.length - 1, 0, "【メモ】");
        const formattedContent = copiedContent.join('\n');

        return navigator.clipboard.writeText(formattedContent)
            .then(() => {
                alert("コピーできました！ : " + formattedContent);
            })
            .catch(err => {
                console.error('コピーに失敗しました:', err);
                throw err;
            });
    }
}
