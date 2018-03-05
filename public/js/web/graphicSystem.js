google.charts.load("current", {packages:["corechart"]});
google.charts.setOnLoadCallback(drawChart);
function drawChart() {
  var data = google.visualization.arrayToDataTable([
    ['Task', 'Hours per Day'],
    ['FIUS',     11],
    ['Subsistema AgroForestal',      2],
    ['Subsistema Pecuario',  2]
  ]);

  var options = {

    is3D: true,
    backgroundColor: {
      fill: '#E5E5E5',
      fillOpacity: 0.8
    },
  }

  var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
  chart.draw(data, options);
}
