function createChart(ctx) {
  const chart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: [],
      datasets: [{
        label: 'Temperature',
        data: [],
      }]
    },
    options: {
      responsive: true,
      scales: {
        x: {
          type: 'time',
        }
      }
    }
  });

  updateChart(chart);

  return chart;
}

function updateChart(chart) {
  const beginDate = $('#beginDate').val();
  const endDate = $('#endDate').val();
  
  const requestData = {
    ...(beginDate != '') && {begin: beginDate},
    ...(endDate != '') && {end: endDate},
  };
  
  $.getJSON('/api/temperature', requestData, (data) => {
    const values = data.map((d) => {
      return d.value;
    });
    const datetimes = data.map((d) => {
      return d.datetime;
    });
    chart.data.datasets[0].data = values;
    chart.data.labels = datetimes;
    chart.update();
  });

  return;
}

function main() {
  const myChartElement = $('#myChart');
  const myChart = createChart(myChartElement);
  const updateChartTimer = setInterval(updateChart, 5000, myChart);

  $('#beginDate').on('change', (data) => {
    updateChart(myChart);
  });
  $('#endDate').on('change', (data) => {
    updateChart(myChart);
  });

  return;
}

$(document).ready(() => {
  main();
});
