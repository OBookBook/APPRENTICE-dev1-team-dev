export class UnnecessaryTask {
  deleteTask = (forms) => {
    for (let delete_form of forms) {
      this.addDeleteTaskListener(delete_form);
    }
  };

  addDeleteTaskListener(deleteForm) {
    console.log("delete");
    deleteForm.addEventListener("submit", function (e) {
      e.preventDefault();

      let taskId = this.children[0].value;
      console.log(taskId);

      axios
        .post("http://localhost:9080/src/php/functions/UnnecessaryTask.php", {
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
}
