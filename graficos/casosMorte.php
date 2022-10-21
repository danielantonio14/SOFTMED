<script>
  const morte = document.getElementById('casoMorte').getContext('2d');
  const myChart1 = new Chart(morte, {
    type: 'line',
    data: {
      labels: ['LUANDA', 'K. KIAXI', 'CACUACO', 'I. BENGO', 'CAZENGA', 'KISSAMA', 'TALATONA', 'BELAS', 'VIANA'],
      datasets: [{
        label: 'Casos de morte por Malária a nível municipal',
        data: [<?= $casos->graficosMorte($BD) ?>],
        backgroundColor: [
          'rgb(255, 0, 83, 0.2)',
          'rgba(5, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)',
          'rgba(255, 159, 225, 0.2)',
          'rgba(255, 159, 0, 0.2)',
          'rgba(255, 0, 64, 0.2)',
        ],
        borderColor: [
          'rgba(52, 168, 83, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)',
          'rgba(255, 159, 225, 1)',
          'rgba(255, 159, 0, 1)',
          'rgba(255, 0, 64, 1)',
        ],
        borderWidth: 2
      }]
    },
    options: {
      animations: {
        tension: {
          duration: 10000,
          easing: 'linear',
          from: 1,
          to: 0,
          loop: true
        }
      },
      scales: {
        y: {
          min: 10,
          max: 100,
        }
      }


    }
  });
</script>