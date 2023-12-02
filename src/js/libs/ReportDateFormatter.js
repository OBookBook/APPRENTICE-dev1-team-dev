/**
 * 選択された要素に基づいて日付を整形します。
 */
class ReportDateFormatter {
    /**
     * ReportDateFormatterのインスタンスを作成します。
     * @param {string} yearMonthSelector - 年と月を含む要素のID。
     * @param {string} taskManagementSelector - タスク管理要素のID。
     */
    constructor(yearMonthSelector, taskManagementSelector) {
        /**
         * 年と月を含む要素のID。
         * @type {string}
         */
        this.yearMonthSelector = yearMonthSelector;

        /**
         * タスク管理要素のID。
         * @type {string}
         */
        this.taskManagementSelector = taskManagementSelector;
    }

    /**
     * DOMから選択された年と月を取得します。
     * @returns {string} 選択された年と月。
     */
    getSelectedYearMonth() {
        const selected = document.getElementById(this.yearMonthSelector);
        return selected.textContent;
    }

    /**
     * タスクセクションからタイトルテキストを取得します。
     * @returns {string} タイトルテキスト。
     */
    getTitleText() {
        const taskSection = document.getElementById(this.taskManagementSelector);
        const h2Element = taskSection.querySelector('h2 span');
        return h2Element.textContent;
    }

    /**
     * 整形された日付を取得します。
     * @returns {string} 整形された日付。
     */
    getFormattedDate() {
        const selectedYearMonth = this.getSelectedYearMonth();
        const title = this.getTitleText();
        const [month, day] = title.match(/\d+/g);
        const year = selectedYearMonth.split('/')[0];
        return `${year}-${month}-${day}`;
    }
}
