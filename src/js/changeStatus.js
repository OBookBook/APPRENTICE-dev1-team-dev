export const changeStatus = () => {
  let checkboxes = document.querySelectorAll(".checkbox");

  for (let checkbox of checkboxes) {
    addCheckStatusListener(checkbox);
  }
};

export function addCheckStatusListener(checkbox) {
  checkbox.addEventListener("change", function () {
    let isChecked = this.checked;
    let taskId = this.name;

    axios
      .post("http://localhost:9080/src/php/functions/ChangeStatus.php", {
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
