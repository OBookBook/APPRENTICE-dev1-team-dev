"use strict";

export class Calendar {
  today = new Date(); //今日の日付
  year = this.today.getFullYear(); //今年
  month = this.today.getMonth(); //今月 0が起点なので11月なら10が返ってくる
  weeks = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
  firstDate = new Date(this.year, this.month, 1); //初日
  lastDate = new Date(this.year, this.month + 1, 0); //最終日
  dayCount = 1;
  calendarHtml = "";

  createCalendar() {
    // 曜日の作成
    this.calendarHtml += '<table><tr id="day-of-week">';
    for (let i = 0; i < this.weeks.length; i++) {
      this.calendarHtml += "<th>" + this.weeks[i] + "</th>";
    }
    this.calendarHtml += "</tr>";

    // 日付の作成
    for (let i = 0; i < 5; i++) {
      this.calendarHtml += '<tr id="week">';

      for (let j = 0; j < 7; j++) {
        if (i == 0 && j < this.firstDate.getDay()) {
          this.calendarHtml += "<td></td>";
        } else if (this.dayCount > this.lastDate.getDate()) {
          this.calendarHtml += "<td></td>";
        } else {
          this.calendarHtml += "<td>" + this.dayCount + "</td>";
          this.dayCount++;
        }
      }
      this.calendarHtml += "</tr>";
    }
    this.calendarHtml += "</table>";

    // カレンダー表示
    document.querySelector("#month-date").innerHTML =
      this.year + "/" + (this.month + 1);
    document.querySelector("#calendar").innerHTML = this.calendarHtml;
  }
}
