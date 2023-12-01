"use strict";
export class Calendar {
  today = new Date(); //今日の日付
  displayDate = new Date(this.today.getFullYear(), this.today.getMonth(), 1); // カレンダー表示に使う日付
  daysOfWeek = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
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
            calendarHtml +=
              '<td class="disabled">' +
              (lastDateLastMonth - firstDate.getDay() + j + 1) +
              "</td>";
          } else if (dayCount > lastDate) {
            // 来月分の空白を埋める
            calendarHtml +=
              '<td class="disabled">' + (dayCount - lastDate) + "</td>";
            dayCount++;
          } else {
            // 当日の日付を選択した状態にする
            if (
              this.today.getFullYear() == year &&
              this.today.getMonth() == month &&
              this.today.getDate() == dayCount
            ) {
              calendarHtml += '<td class="date selected">' + dayCount + "</td>";
            } else {
              calendarHtml += '<td class="date">' + dayCount + "</td>";
            }
            dayCount++;
          }
        }
        calendarHtml += "</tr>";
      }
    }
    calendarHtml += "</table>";

    // カレンダー表示
    document.getElementById("year-month").innerHTML = year + "/" + (month + 1);
    document.getElementById("calendar").innerHTML = calendarHtml;
  }

  // 曜日テーブルの作成
  createWeekTable() {
    let calendarHtml = '<table><tr id="day-of-week">';
    for (let i = 0; i < this.daysOfWeek.length; i++) {
      calendarHtml += "<th>" + this.daysOfWeek[i] + "</th>";
    }
    calendarHtml += "</tr>";
    return calendarHtml;
  }

  // 先月のカレンダーを表示
  PrevMonth() {
    document.getElementById("prev").addEventListener("click", () => {
      this.displayDate.setMonth(this.displayDate.getMonth() - 1);
      this.createCalendar();
      this.setDateClickEvent();
    });
  }

  // 来月のカレンダーを表示
  NextMonth() {
    document.getElementById("next").addEventListener("click", () => {
      this.displayDate.setMonth(this.displayDate.getMonth() + 1);
      this.createCalendar();
      this.setDateClickEvent();
    });
  }

  // 日付をクリックした際のイベントを設定
  setDateClickEvent() {
    document.querySelectorAll(".date").forEach((e) => {
      e.addEventListener("click", () => {
        // クリックしたらハイライト
        const selected = document.querySelector(".selected");
        if (selected) {
          selected.classList.remove("selected");
        }
        e.classList.add("selected");
        const yearMonth = document
          .getElementById("year-month")
          .innerHTML.split("/");
        const date = yearMonth[0] + "-" + yearMonth[1] + "-" + e.innerHTML; // 出力例:2023-12-3
        console.log(date);
        // タスク一覧までページをスクロール
        document.getElementById("task-management").scrollIntoView({
          behavior: "smooth",
        });

        this.showContents(date);
      });
    });
  }

  // タスク一覧とレポートの表示
  showContents(execution_date) {
    const UL_OF_TASK_LIST = document.querySelector(".task-lists");
    UL_OF_TASK_LIST.innerHTML = "";
    let userId = 1; // 仮にユーザー１とする

    console.log("userId:" + userId);
    console.log("execution_date:" + execution_date);

    return axios
      .post("http://localhost:9080/src/php/functions/ShowTasks.php", {
        userId: userId,
        execution_date: execution_date,
      })
      .then((response) => {
        let taskList = response.data.taskList;
        let report = response.data.report;

        this.createList(taskList);
        // this.createReport(report);
      })
      .catch((error) => {
        console.log(error);
      });
  }

  // タスク一覧のHTML生成
  createList(taskList) {
    const UL_OF_TASK_LIST = document.querySelector(".task-lists");
    if (taskList.length) {
      for (let i = 0; i < taskList.length; i++) {
        UL_OF_TASK_LIST.innerHTML += `
      <li class="task-list">
        <form class="checkbox_form">
          <input class="checkbox" type="checkbox" name="${taskList[i].task_id}">
        </form>
        <div class="task_name">
          ${taskList[i].task_name}
        </div>
        <form class="delete_form">
          <input type="text" name="delete_task_id" value="${taskList[i].task_id}" hidden>
          <label>
            <span class="delete-icon material-symbols-outlined">delete</span>
            <button type="submit" name="delete-btn" hidden>
          </label>
        </form>
      </li>`;

        if (taskList[i]["completion_status"] === 1) {
          let checkboxes = document.querySelectorAll(".checkbox");
          let lastCheckbox = checkboxes[checkboxes.length - 1];
          lastCheckbox.setAttribute("checked", true);
        }
      }

      UL_OF_TASK_LIST.innerHTML += `
    <li class="task-list list_to_add_task">
    <form class="add_task_form">
      <input type="hidden" name="form_id" value="input_task">
      <input class="input_task" type="text" name="input_task" maxlength="255" required>
      <button class="add_task_btn disabled" type="submit" disabled><span class="add_task_btn_inner">＋</span></button>
    </form>
  </li>
  <div class="feed_back"></div>`;
    } else {
      UL_OF_TASK_LIST.innerHTML += `
    <li class="task-list list_to_add_task">
    <form class="add_task_form">
      <input type="hidden" name="form_id" value="input_task">
      <input class="input_task" type="text" name="input_task" maxlength="255" required>
      <button class="add_task_btn disabled" type="submit" disabled><span class="add_task_btn_inner">＋</span></button>
    </form>
  </li>
  <div class="feed_back"></div>`;
    }
  }
}
