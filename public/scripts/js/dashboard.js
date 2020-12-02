function showChart(data, barChart){
  var titulo = [];
  var importe = [];
  var devengado = [];
  for (var i = 0; i < data.length; i++) {
    titulo[i] = data[i].organismo;
    importe[i] = data[i].imp_preven;
    devengado[i] = data[i].imp_deven;
  }
  var barChartCanvas = barChart.get(0).getContext('2d')
  var barChart = new Chart(barChartCanvas)
  var areaChartData = {
    labels : titulo,
    datasets: [
    {
      label               : 'Preventivo',
      fillColor           : 'orange',
      strokeColor         : 'orange',
      data                : importe
    },
    {
      label               : 'Devengado',
      fillColor           : 'rgba(210, 214, 222, 1)',
      strokeColor         : 'rgba(210, 214, 222, 1)',
      data                : devengado
    }
    ]
  }
  var barChartData = areaChartData
  barChart.Bar(barChartData, {responsive: true})
}; 