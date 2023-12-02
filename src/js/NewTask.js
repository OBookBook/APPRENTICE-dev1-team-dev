import { Status } from "./Status.js";
import { UnnecessaryTask } from "./UnnecessaryTask.js";

export class NewTask {
  error = "タスクを入力してください";

  // タスク名の長さのバリデーション
  checkLength(input) {
    input.addEventListener("input", (e) => {
      const target = e.target;

      if (target.validity.valueMissing) {
        this.error = "タスクを入力してください";
      } else if (target.validity.tooLong) {
        this.error = "255文字未満で入力してください";
      } else {
        this.error = false;
      }
      console.log(this.error);
    });
  }

  // タスクを登録して表示する
  addNewTask(form, date) {
    form.addEventListener("submit", async (e) => {
      e.preventDefault();
      console.log("submit");

      let task = e.target[1];
      console.log(task);
      let newTask = task.value;
      console.log(newTask);

      task.value = "";

      axios
        .post("http://localhost:9080/src/php/functions/NewTask.php", {
          newTask: newTask,
          execution_date: date,
        })
        .then((response) => {
          let error = response.data.error;
          let newTaskId = response.data.newTaskId;
          console.log(response);
          console.log("レスポンス error: " + error);
          console.log("レスポンス id: " + newTaskId);
          console.log("レスポンス date: " + date);

          if (error === "OK") {
            let list = document.createElement("li");
            list.classList.add("task-list");
            list.innerHTML = `
          <form class="checkbox_form">
            <input class="checkbox newCheckbox" type="checkbox" name="${newTaskId}">
          </form>
          <div class="task_name">
            ${newTask}
          </div>
          <form class="delete_form">
            <input type="text" name="delete_task_id" value="${newTaskId}" hidden>
            <label>
              <span class="delete-icon material-symbols-outlined">delete</span>
              <button type="submit" name="delete-btn" hidden>
            </label>
          </form>
          `;

            const LIST_TO_ADD_TASK =
              document.querySelector(".list_to_add_task");

            LIST_TO_ADD_TASK.parentElement.insertBefore(list, LIST_TO_ADD_TASK);
            let newCheckbox = document.querySelector(".newCheckbox");
            console.log(newCheckbox);

            let status = new Status();
            status.addCheckStatusListener(newCheckbox);

            let unnecessaryTask = new UnnecessaryTask();
            const DELETE_FORM = list.children[2];
            unnecessaryTask.addDeleteTaskListener(DELETE_FORM);
          } else {
            throw new Error("エラーが発生しました");
          }
        })
        .catch((error) => {
          const FEED_BACK = document.querySelector(".feed_back");

          FEED_BACK.innerText = "エラーが発生しました";
          console.log(error.message);
        });
    });
  }

  toggleClassToTaskList(input, btn, btnInner, feedBack) {
    this.checkLength(input);
    this.activateSubmitBtn(input, btn);
    this.showErrorMessage(btnInner, feedBack);
  }

  // タスク登録ボタンのアクティブ化
  activateSubmitBtn(input, btn) {
    input.addEventListener("input", () => {
      console.log("input!");
      console.log(this.error);

      if (!this.error) {
        console.log("エラーなし");
        console.log(btn);

        btn.classList.add("enabled");
        btn.classList.remove("disabled");

        btn.removeAttribute("disabled");
      } else {
        btn.classList.add("disabled");
        btn.classList.remove("enabled");

        btn.setAttribute("disabled", true);
      }
    });
  }

  // エラーメッセージの表示
  showErrorMessage(btnInner, feedBack) {
    btnInner.addEventListener("click", () => {
      if (!this.error) {
        feedBack.classList.add("is_success");
        feedBack.classList.remove("is_error");
      } else {
        feedBack.classList.add("is_error");
        feedBack.classList.remove("is_success");

        feedBack.innerText = this.error;
      }
    });
  }
}
