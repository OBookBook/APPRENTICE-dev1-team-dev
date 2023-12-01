import { addCheckStatusListener } from "./changeStatus.js";

export function createNewTask() {
  const INPUT = document.querySelector(".input_task");
  const ADD_TASK_BTN = document.querySelector(".add_task_btn");
  const ADD_TASK_BTN_INNER = document.querySelector(".add_task_btn_inner");
  const FEED_BACK = document.querySelector(".feed_back");
  const FORM = document.querySelector(".add_task_form");
  const LIST_TO_ADD_TASK = document.querySelector(".list_to_add_task");

  let error = "タスクを入力してください";

  function checkLength() {
    INPUT.addEventListener("input", (e) => {
      const target = e.currentTarget;

      if (target.validity.valueMissing) {
        error = "タスクを入力してください";
      } else if (target.validity.tooLong) {
        error = "255文字未満で入力してください";
      } else {
        error = false;
      }
      console.log(error);
    });
  }

  function activateSubmitBtn() {
    INPUT.addEventListener("input", () => {
      if (!error) {
        ADD_TASK_BTN.classList.add("enabled");
        ADD_TASK_BTN.classList.remove("disabled");

        ADD_TASK_BTN.removeAttribute("disabled");
      } else {
        ADD_TASK_BTN.classList.add("disabled");
        ADD_TASK_BTN.classList.remove("enabled");

        ADD_TASK_BTN.setAttribute("disabled", true);
      }
    });
  }

  function showErrorMessage() {
    ADD_TASK_BTN_INNER.addEventListener("click", () => {
      if (!error) {
        FEED_BACK.classList.add("is_success");
        FEED_BACK.classList.remove("is_error");
      } else {
        FEED_BACK.classList.add("is_error");
        FEED_BACK.classList.remove("is_success");

        FEED_BACK.innerText = error;
      }
    });
  }

  function showNewTask() {
    FORM.addEventListener("submit", async (e) => {
      e.preventDefault();
      console.log("submit");

      let task = e.target[1];
      let newTask = task.value;
      console.log(newTask);

      task.value = "";

      axios
        .post("http://localhost:9080/src/php/functions/insertTask.php", {
          newTask: newTask,
        })
        .then((response) => {
          let error = response.data.error;
          let newTaskId = response.data.newTaskId;
          console.log("レスポンス error: " + error);
          console.log("レスポンス id: " + newTaskId);

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

            LIST_TO_ADD_TASK.parentElement.insertBefore(list, LIST_TO_ADD_TASK);
            let newCheckbox = document.querySelector(".newCheckbox");

            addCheckStatusListener(newCheckbox);
          } else {
            throw new Error("エラーが発生しました");
          }
        })
        .catch((error) => {
          FEED_BACK.innerText = "エラーが発生しました";
          console.log(error.message);
        });
    });
  }

  checkLength();
  activateSubmitBtn();
  showErrorMessage();
  showNewTask();
}
