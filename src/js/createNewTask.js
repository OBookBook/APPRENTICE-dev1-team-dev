import { addCheckStatusListener } from "./changeStatus.js";

const INPUT = document.querySelector(".input_task");
const ADD_TASK_BTN = document.querySelector(".add_task_btn");
const FEED_BACK = document.querySelector(".feed_back");
const ADD_TASK_BTN_INNER = document.querySelector(".add_task_btn_inner");
const FORM = document.querySelector(".add_task_form");

let error = "タスクを入力してください";

export function createNewTask(form, date) {
  checkLength(INPUT);
  activateSubmitBtn(INPUT, ADD_TASK_BTN);
  showErrorMessage(ADD_TASK_BTN_INNER, FEED_BACK);
  showNewTask(form, date);
}

function checkLength(input) {
  console.log(input);
  input.addEventListener("input", (e) => {
    const target = e.target;

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

export function showNewTask(form, date) {
  form.addEventListener("submit", async (e) => {
    e.preventDefault();
    console.log("submit");

    let task = e.target[1];
    console.log(task);
    let newTask = task.value;
    console.log(newTask);

    task.value = "";

    axios
      .post("http://localhost:9080/src/php/functions/insertTask.php", {
        newTask: newTask,
        execution_date: date,
      })
      .then((response) => {
        let error = response.data.error;
        let newTaskId = response.data.newTaskId;
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

          const LIST_TO_ADD_TASK = document.querySelector(".list_to_add_task");

          LIST_TO_ADD_TASK.parentElement.insertBefore(list, LIST_TO_ADD_TASK);
          let newCheckbox = document.querySelector(".newCheckbox");
          console.log(newCheckbox);

          addCheckStatusListener(newCheckbox);
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

export function toggleClassToTaskList(input, btn, btnInner, feedBack) {
  checkLength(input);
  activateSubmitBtn(input, btn);
  showErrorMessage(btnInner, feedBack);
}

function activateSubmitBtn(input, btn) {
  console.log("activate");

  input.addEventListener("input", () => {
    console.log("input!");
    console.log(error);

    if (!error) {
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

function showErrorMessage(btnInner, feedBack) {
  btnInner.addEventListener("click", () => {
    if (!error) {
      feedBack.classList.add("is_success");
      feedBack.classList.remove("is_error");
    } else {
      feedBack.classList.add("is_error");
      feedBack.classList.remove("is_success");

      feedBack.innerText = error;
    }
  });
}
