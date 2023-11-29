let checkboxes = document.querySelectorAll(".checkbox");

for (let checkbox of checkboxes) {
  checkbox.addEventListener("change", function () {
    let isChecked = this.checked;
    let taskId = this.name;

    axios
      .post("http://localhost:9080/src/php/functions/ChangeStatus.php", {
        taskId: taskId,
        isChecked: isChecked,
      })
      .then((response) => {
        console.log("送信内容: " + JSON.stringify(response.data));
      })
      .catch((error) => {
        console.log(error);
      });
  });
}
