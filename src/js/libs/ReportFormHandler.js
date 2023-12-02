/**
 * ReportFormHandlerはレポートデータのフォーム送信を処理します。
 * @class
 */
class ReportFormHandler {
    /**
     * フォームの送信を非同期で処理します。
     * @param {Event} event - 送信イベント
     * @returns {Promise<void>} 処理が完了した時に解決されるPromise
     */
    handleSubmit = async (event) => {
        event.preventDefault();
        const requestData = this.createRequestData();
        await this.sendRequest(requestData);
    };

    /**
     * フォームの入力からリクエストデータを作成します。
     * @returns {Object} リクエストデータのオブジェクト
     */
    createRequestData = () => {
        const formatter = new ReportDateFormatter('year-month', 'task-management');
        return {
            userId: 1,
            reflectionComment: document.getElementById("reflectionComment").value,
            studyHours: document.getElementById("studyHours").value,
            submittedDate: formatter.getFormattedDate()
        };
    };

    /**
     * 提供されたデータでリクエストを送信します。
     * @param {Object} requestData - 送信するデータ
     * @returns {Promise<void>} リクエストが完了した時に解決されるPromise
     */
    sendRequest = async (requestData) => {
        try {
            const response = await fetch("../../php/functions/post_report.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(requestData)
            });

            if (response.ok) {
                console.log("データが正常に送信されました。");
            } else {
                throw new Error("データの送信中にエラーが発生しました。");
            }
        } catch (error) {
            console.error("エラーが発生しました:", error);
        }
    };
}
