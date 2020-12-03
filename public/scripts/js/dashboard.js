function showChart(clabels, col1, barChart, colors){
  var barChartCanvas = barChart.get(0).getContext('2d')
  var barChart = new Chart(barChartCanvas)
  var areaChartData = {
    labels : clabels,
    datasets: [
    {
      fillColor           : colors[0],
      strokeColor         : colors[0],
      data                : col1
    }
    ]
  }
  var barChartData = areaChartData
  barChart.Bar(barChartData, {responsive: true})
};

function showChart2(clabels, col1, col2, barChart, labels, colors){
  var barChartCanvas = barChart.get(0).getContext('2d')
  var barChart = new Chart(barChartCanvas)
  var areaChartData = {
    labels : clabels,
    datasets: [
    {
      label               : labels[0],
      fillColor           : colors[0],
      strokeColor         : colors[0],
      data                : col1
    },
    {
      label               : labels[1],
      fillColor           : colors[1],
      strokeColor         : colors[1],
      data                : col2
    }
    ]
  }
  var barChartData = areaChartData
  barChart.Bar(barChartData, {responsive: true})
};

function showChart3(clabels, col1, col2, col3, barChart, labels, colors){
  var barChartCanvas = barChart.get(0).getContext('2d')
  var barChart = new Chart(barChartCanvas)
  var areaChartData = {
    labels : clabels,
    datasets: [
    {
      label               : labels[0],
      fillColor           : colors[0],
      strokeColor         : colors[0],
      data                : col1
    },
    {
      label               : labels[1],
      fillColor           : colors[1],
      strokeColor         : colors[1],
      data                : col2
    },
    {
      label               : labels[2],
      fillColor           : colors[2],
      strokeColor         : colors[2],
      data                : col3
    }
    ]
  }
  var barChartData = areaChartData
  barChart.Bar(barChartData, {responsive: true})
};