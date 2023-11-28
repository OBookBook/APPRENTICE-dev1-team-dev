"use strict";

export const createCalender = () => {
  const today = new Date(); //今日の日付
  const year = today.getFullYear(); //今年
  const month = today.getMonth(); //今月 0が起点なので11月なら10が返ってくる
  const weeks = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
  const firstDate = new Date(year, month, 1); //初日
  const lastDate = new Date(year, month + 1, 0); //最終日
  let dayCount = 1;
  let calendarHtml = "";
  console.log(lastDate);
  // 曜日の作成
  calendarHtml += '<table><tr id="day-of-week">';

  for (let i = 0; i < weeks.length; i++) {
    calendarHtml += "<th>" + weeks[i] + "</th>";
  }
  calendarHtml += "</tr>";

  // 日付の作成
  for (let i = 0; i < 5; i++) {
    calendarHtml += '<tr id="week">';

    for (let j = 0; j < 7; j++) {
      if (i == 0 && j < firstDate.getDay()) {
        calendarHtml += "<td></td>";
      } else if (dayCount > lastDate.getDate()) {
        calendarHtml += "<td></td>";
      } else {
        calendarHtml += "<td>" + dayCount + "</td>";
        dayCount++;
      }
    }
    calendarHtml += "</tr>";
  }
  calendarHtml += "</table>";

  // カレンダー表示
  document.querySelector("#month-date").innerHTML = year + "/" + (month + 1);
  document.querySelector("#calendar").innerHTML = calendarHtml;
};
