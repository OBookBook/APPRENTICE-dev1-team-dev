export class Status {
  changeStatus = (checkboxes) => {
    for (let checkbox of checkboxes) {
      this.addCheckStatusListener(checkbox);
    }
  };

  addCheckStatusListener(checkbox) {
    checkbox.addEventListener("change", function () {
      let isChecked = this.checked;
      let taskId = this.name;
      console.log(isChecked);
      console.log(taskId);

      axios
        .post("http://localhost:9080/src/php/functions/Status.php", {
          taskId: taskId,
          isChecked: isChecked,
        })
        .then((response) => {
          console.log(response);
          console.log("送信内容: " + JSON.stringify(response.data));
        })
        .catch((error) => {
          console.log(error);
        });
    });
  }
}
