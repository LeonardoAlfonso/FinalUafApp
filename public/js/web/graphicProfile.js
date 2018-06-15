google.charts.load('current', {'packages':['line', 'corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {

var chartDiv = document.getElementById('chart_div');

var data = new google.visualization.DataTable();
data.addColumn('date', 'Month');
data.addColumn('number', "Average Temperature");

data.addRows([
  [new Date(2014, 0),  -.5],
  [new Date(2014, 1),   .4],
  [new Date(2014, 2),   .5],
  [new Date(2014, 3),  2.9],
  [new Date(2014, 4),  6.3],
  [new Date(2014, 5),    9],
  [new Date(2014, 6), 10.6],
  [new Date(2014, 7), 10.3],
  [new Date(2014, 8),  7.4],
  [new Date(2014, 9),  4.4],
  [new Date(2014, 10), 1.1],
  [new Date(2014, 11), -.2]
]);

var materialOptions = {

  // width: 900,
  // height: 500,

  backgroundColor: {
    fill: '#E5E5E5',
    fillOpacity: 0.7
  },
  series: {
    // Gives each series an axis name that matches the Y-axis below.
    0: {axis: 'Temps'},
  },
  axes: {
    // Adds labels to each axis; they don't have to match the axis names.
    y: {
      Temps: {label: 'Temps (Celsius)'},
    }
  }
};


function drawMaterialChart() {
  var materialChart = new google.charts.Line(chartDiv);
  materialChart.draw(data, google.charts.Line.convertOptions(materialOptions));
  button.innerText = 'Change to Classic';
  button.onclick = drawClassicChart;
}

drawMaterialChart();

}
