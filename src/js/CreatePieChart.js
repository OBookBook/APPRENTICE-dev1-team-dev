export class CreatePieChart {
  createMonthPieChart(dateArr) {
    let ctx = Array.from(document.getElementsByClassName("chart"));
    console.log(ctx);
    for (let i = 0; i < ctx.length; i++) {
      new Chart(ctx[i], {
        type: "pie",
        data: {
          labels: ["完了", "未完了"],
          datasets: [
            {
              backgroundColor: ["#FFAFAC", "#E7D9D8"],
              data: [60, 40],
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
  }
}
