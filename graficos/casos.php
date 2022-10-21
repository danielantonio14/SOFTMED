<script>
  // ================ GRAFICOS =====================
  // Load the Visualization API and the corechart package.
  google.charts.load('current', {
    'packages': ['corechart']
  });

  // Set a callback to run when the Google Visualization API is loaded.
  google.charts.setOnLoadCallback(drawChart);

  // Callback that creates and populates a data table,
  // instantiates the pie chart, passes in the data and
  // draws it.
  async function drawChart() {

    // Create the data table.
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Topping');
    data.addColumn('number', 'Slices');
    data.addRows([
      <?= $casos->graficos($BD) ?>
    ]);

    // Set chart options
    var options = {
      'title': 'Fases Estudadas',
      titleTextStyle: {
        color: '#444'
      },
      'width': 900,
      'height': 500,
      'backgroundColor': '#f7f7f7',
      legend: {
        textStyle: {
          color: '#444',
          fontSize: 16
        }
      },
      is3D: true,


    };

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.PieChart(document.getElementById('casos_graficos'));
    chart.draw(data, options);

  }
</script>


<script>
  // ================ GRAFICOS PREVALENCIAS=====================
  // Load the Visualization API and the corechart package.
  google.charts.load('current', {
    'packages': ['corechart']
  });

  // Set a callback to run when the Google Visualization API is loaded.
  google.charts.setOnLoadCallback(drawChart);

  // Callback that creates and populates a data table,
  // instantiates the pie chart, passes in the data and
  // draws it.
  async function drawChart() {

    // Create the data table.
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Topping');
    data.addColumn('number', 'Slices');
    data.addRows([
      <?= $casos->insidenciaPrevalencia($BD) ?>
    ]);

    // Set chart optionsm
    var options = {
      'title': 'Fases Estudadas',
      titleTextStyle: {
        color: '#444'
      },
      'width': 900,
      'height': 500,
      'backgroundColor': '#f7f7f7',
      legend: {
        textStyle: {
          color: '#444',
          fontSize: 16
        }
      },
      is3D: true,
    };

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.PieChart(document.getElementById('ip_graficos'));
    chart.draw(data, options);
    chart.getImageUrl

  }
</script>