export class CreatePieChart {
  createMonthlyPieChart(dateArr) {
    fetch("http://localhost:9080/src/php/functions/TaskAchievementRate.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(dateArr),
    })
      .then((response) => response.json())
      .then((res) => {
        let ctx = Array.from(document.getElementsByClassName("chart"));
        for (let i = 0; i < ctx.length; i++) {
          new Chart(ctx[i], {
            type: "pie",
            data: {
              labels: ["完了", "未完了"],
              datasets: [
                {
                  backgroundColor: ["#FFAFAC", "rgba(0, 0, 0, 0)"],
                  data: res[i],
                },
              ],
            },
            options: {
              plugins: {
                legend: {
                  display: false,
                },
                tooltip: {
                  enabled: false,
                },
              },
            },
          });
        }
      })
      .catch((error) => {
        console.log(error);
      });
  }
}
