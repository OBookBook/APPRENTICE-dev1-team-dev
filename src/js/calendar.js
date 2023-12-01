'use strict';
export class Calendar {
  today = new Date(); //今日の日付
  displayDate = new Date(this.today.getFullYear(), this.today.getMonth(), 1); // カレンダー表示に使う日付
  daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
  weekTable = this.createWeekTable();

  createCalendar() {
    // 初期化
    const year = this.displayDate.getFullYear(); //今年
    const month = this.displayDate.getMonth(); //今月 0が起点なので11月なら10が返ってくる
    const firstDate = new Date(year, month, 1); //今月初日
    const lastDate = new Date(year, month + 1, 0).getDate(); //今月最終日
    const lastDateLastMonth = new Date(year, month, 0).getDate(); //先月最終日
    let dayCount = 1;
    let calendarHtml = this.weekTable;

    // 日付の作成
    for (let i = 0; i < 6; i++) {
      if (dayCount <= lastDate) {
        // 余計な空白を作らない
        calendarHtml += '<tr id="week">';
        for (let j = 0; j < 7; j++) {
          if (i == 0 && j < firstDate.getDay()) {
            // 今月分の空白を埋める
            calendarHtml += '<td class="disabled">' + (lastDateLastMonth - firstDate.getDay() + j + 1) + '</td>';
          } else if (dayCount > lastDate) {
            // 来月分の空白を埋める
            calendarHtml += '<td class="disabled">' + (dayCount - lastDate) + '</td>';
            dayCount++;
          } else {
            // 当日の日付を選択した状態にする
            if (this.today.getFullYear() == year && this.today.getMonth() == month && this.today.getDate() == dayCount) {
              calendarHtml += '<td class="date selected">' + dayCount + '</td>';
            } else {
              calendarHtml += '<td class="date">' + dayCount + '</td>';
            }
            dayCount++;
          }
        }
        calendarHtml += '</tr>';
      }
    }
    calendarHtml += '</table>';

    // カレンダー表示
    document.getElementById('year-month').innerHTML = year + '/' + (month + 1);
    document.getElementById('calendar').innerHTML = calendarHtml;
  }

  // 曜日テーブルの作成
  createWeekTable() {
    let calendarHtml = '<table><tr id="day-of-week">';
    for (let i = 0; i < this.daysOfWeek.length; i++) {
      calendarHtml += '<th>' + this.daysOfWeek[i] + '</th>';
    }
    calendarHtml += '</tr>';
    return calendarHtml;
  }

  // 先月のカレンダーを表示
  PrevMonth() {
    document.getElementById('prev').addEventListener('click', () => {
      this.displayDate.setMonth(this.displayDate.getMonth() - 1);
      this.createCalendar();
      this.setDateClickEvent();
    });
  }

  // 来月のカレンダーを表示
  NextMonth() {
    document.getElementById('next').addEventListener('click', () => {
      this.displayDate.setMonth(this.displayDate.getMonth() + 1);
      this.createCalendar();
      this.setDateClickEvent();
    });
  }
  // 日付をクリックした際のイベントを設定
  setDateClickEvent() {
    document.querySelectorAll('.date').forEach((e) => {
      e.addEventListener('click', () => {
        // クリックしたらハイライト
        const selected = document.querySelector('.selected');
        if (selected) {
          selected.classList.remove('selected');
        }
        e.classList.add('selected');
        const yearMonth = document.getElementById('year-month').innerHTML.split('/');
        const date = yearMonth[0] + '-' + yearMonth[1] + '-' + e.innerHTML; // 出力例:2023-12-3
        console.log(date);
        // タスク一覧までページをスクロール
        document.getElementById('task-management').scrollIntoView({
          behavior: 'smooth',
        });
      });
    });
  }
}
