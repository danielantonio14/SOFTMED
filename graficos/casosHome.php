<script>
  var headers = [
    "Crianças", "Adolescentes", "Jovens", "Adultos", "Idosos"
  ]
  var dados_mulheres = [
    <?= $casos->graficosMulheres($BD) ?>
  ]
  var dados_homens = [
    <?= $casos->graficosHomens($BD) ?>
  ]

  var dados_todos = [
    <?= $casos->graficosGeral($BD) ?>
  ]


  Highcharts.chart('graficosColuna', {
    chart: {
      align: 'left',
      type: 'column',
      options3d: {
        enabled: true,
        alpha: 45
      }
    },
    title: {
      text: 'CASOS DE MALÁRIA',
      y: 15,
      x: 5,
      style: {
        color: '#41CD7D',
        display: 'block'
      }
    },
    colors: ['hsl(233, 27%, 30%)', '#12CCAD'],
    xAxis: {
      categories: headers,
    },
    credits: {
      enabled: false
    },
    yAxis: {
      min: 0,
      title: {
        text: 'Total de casos estudados',
        style: {
          color: '#41CD7D',
          x: 75,

        },
        enabled: true,
      },
      stackLabels: {
        enabled: true,
        style: {
          fontWeight: 'bold',
          color: ( // theme
            Highcharts.defaultOptions.title.style &&
            Highcharts.defaultOptions.title.style.color
          ) || 'blue'
        }
      }
    },
    legend: {
      align: 'right',
      x: -30,
      verticalAlign: 'top',
      y: 25,
      floating: true,
      backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || '#fff',
      borderColor: '#41CD7D',
      borderWidth: 1,
      shadow: true
    },
    tooltip: {
      headerFormat: '<b>{point.x}</b><br/>',
      pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
    },
    plotOptions: {
      column: {
        stacking: 'normal',
        dataLabels: {
          enabled: true
        }
      }
    },
    series: [{
      name: 'Homens',
      data: dados_homens
    }, {
      name: 'Mulheres',
      data: dados_mulheres
    }]
  });
</script>