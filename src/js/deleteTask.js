export const deleteTask = (forms) => {
  for (let delete_form of forms) {
    addDeleteTaskListener(delete_form);
  }
};

export function addDeleteTaskListener(delete_form) {
  delete_form.addEventListener("submit", function (e) {
    console.log("delete");
    e.preventDefault();

    let taskId = this.children[0].value;
    console.log(taskId);

    axios
      .post("http://localhost:9080/src/php/functions/daleteTask.php", {
        deleteTaskId: taskId,
      })
      .then((response) => {
        let error = response.data.error;
        console.log(response);
        console.log("送信内容: " + JSON.stringify(response.data));

        if (error === "OK") {
          this.parentElement.remove();
        }
      })
      .catch((error) => {
        console.log(error);
      });
  });
}
