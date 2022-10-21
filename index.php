<?php
session_start();
if (!isset($_SESSION['idfuncionarios']) && !$_SESSION['idfuncionarios'] >= 1) {
  header('location:./login.php');
}
require './env.php';
require './assets/controllers/funcionarios.php';
$funcionario->show($BD);
require './assets/controllers/casos.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- BOOTSTRAP -->
  <link rel="stylesheet" href="./assets/vendor/bootstrap-5.1.3-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="./assets/vendor/bootstrap-5.1.3-dist/icon/bootstrap-icons.css">

  <link rel="stylesheet" href="./pugins/highchart/highchart.css">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="./pugins/chart/Chart.min.css">
  <link rel="stylesheet" href="./assets/css/padrao.css">

  <title>SOFT-MED | Software para analista</title>
</head>

<body class="">

  <!-- PRELOAD -->
  <!--   <div class="preloader" style="background-color: hsl(167deg 52% 46%)">
    <img src="./assets/./images/heart-loading2.gif">
  </div> -->

  <!--MENU HORIZONTAL -->

  <div class="nav-header p-3 fixed-top bg-1">
    <div class="h2 card-title float-start text-white">
      <a href="./" class="cor text-decoration-none text-white">Softmed</a>
    </div>
    <ul class="nav justify-content-end">
      <div class="float-end">
        <img src="<?= $funcionario->getFoto() ?>" class="img-fluid rounded rounded-circle text-center foto-direita">
      </div>
      <li class="nav-item">
        <a class="nav-link text-white"><?= $funcionario->getNome() ?></a>
      </li>
    </ul>

  </div><!-- FIM MENU HORIZONTAL -->
  <br>



  <div class="row rounded-0 alert-light mt-5 my-5">
    <!-- MENU VERTICAL -->
    <div class="col-3 rounded-0">
      <div class="list-group rounded-0 bg-light menu-vertical menu-vertical-scroll" id="list-tab" role="tablist">
        <div class="foto-adm w-100 text-center bg-white text-dark">
          <br>
          <img src="<?= $funcionario->getFoto() ?>" class="img-fluid rounded rounded-circle text-center card-img-top">
          <div class="card-body text-center  text-dark">
            <span class="card-title"><?= $funcionario->getNome() ?></>
              <p class="card-text cor-2"><?= $funcionario->getTipoFuncionario() ?></p>
              <p class="card-text cor-2"><?= $funcionario->getIdLocalidade() ?></p>
          </div>
        </div>


        <a class=" text-decoration-none border-end p-4 text-muted links" id="list-home-list" data-bs-toggle="list" href="#list-home" role="tab" aria-controls="list-home">
          <i class="bi-house"></i> <span class="ms-3">HOME</span>
        </a>
        <a class=" text-decoration-none border-end p-4 text-muted links" id="menu-usuarios" data-bs-toggle="list" href="#usuarios" role="tab" aria-controls="usuarios">
          <i class="bi-people"></i> <span class="ms-3">FUNCIONÁRIOS</span>
        </a>
        <!-- <a class=" text-decoration-none border-end p-4 text-muted links" id="menu-adm" data-bs-toggle="list" href="#adm" role="tab" aria-controls="adm">
          <i class="bi-person"></i> <span class="ms-3">ADMINISTRADORES</span>
        </a>-->
        <a class=" text-decoration-none border-end p-4 text-muted links" id="menu-casos" data-bs-toggle="list" href="#casos" role="tab" aria-controls="casos">

          <i class="bi-bug"></i> <span class="ms-3">CASOS</span>
        </a>
        <a class=" text-decoration-none border-end p-4 text-muted links" id="menu-incidencia" data-bs-toggle="list" href="#incidencia" role="tab" aria-controls="incidencia">
          <i class="bi-hourglass-split"></i> <span class="ms-3">Incidências & Prevalências</span>
        </a>
        <a class=" text-decoration-none border-end p-4 text-muted links" id="menu-prevalencia" data-bs-toggle="list" href="#prevalencia" role="tab" aria-controls="prevalencia">
          <i class="bi-list-columns-reverse"></i> <span class="ms-3">RELATÓRIOS</span>
        </a>
        <a class="text-decoration-none border-end p-4 text-muted links" id="menu-info" data-bs-toggle="list" href="#info" role="tab" aria-controls="info">
          <i class="bi-info"></i> <span class="ms-3">SOBRE OS CASOS</span>
        </a>
        <a class=" text-decoration-none border-end p-4 text-muted links" id="menu-analista" data-bs-toggle="list" href="#analistas" role="tab" aria-controls="analistas">
          <i class="bi-clock-history"></i> <span class="ms-3">LOGS DO SITEMA</span>
        </a>

        <a class=" text-decoration-none border-end p-4 text-muted links" href="./sair.php?logout=yes">
          <i class="bi-door-closed"></i> <span class="ms-3">LOGOUT</span>
        </a>

      </div>
    </div> <!-- FIM MENU VERTICAL  -->



    <div class="col-9 -2">
      <div class="alert alert-light -2 me-2 barra-info shadow-sm">
        <div class="row">
          <!-- CARDS INFO CONTADORES -->
          <div class="col">
            <div class="shadow-none border-0 zoom alert alert-success">
              <div class="card-subtitle text-center h4"><i class="bi-bug-fill"></i></div>
              <div class="card-title text-center">
                CASOS
              </div>
              <div class="text-center align-content-center d-flex justify-content-center">
                <button class="btn badge rounded-pill btn-success d-block" id="total-casos">0</button>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="shadow-none border-0 zoom alert alert-info">
              <div class="card-subtitle text-center h4"><i class="bi-check"></i></div>
              <div class="card-title text-center">
                ATIVOS
              </div>
              <div class="text-center align-content-center d-flex justify-content-center">
                <button class="btn badge rounded-pill btn-success d-block" id="total-ativos">0</button>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="shadow-none border-0 zoom alert alert-warning">
              <div class="card-subtitle text-center h4"><i class="bi-heartbreak-fill"></i></div>
              <div class="card-title text-center">
                RISCOS
              </div>
              <div class="text-center align-content-center d-flex justify-content-center">
                <button class="btn btn-warning badge rounded-pill d-block" id="total-funcionarios">0</button>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="shadow-none border-0 zoom alert alert-danger">
              <div class="card-subtitle text-center h4"><i class="bi-heart-pulse-fill"></i></div>
              <div class="card-title text-center">
                MORTOS
              </div>
              <div class="text-center align-content-center d-flex justify-content-center">
                <button class="btn btn-danger badge rounded-pill d-block" id="total-analista">0</button>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="shadow-none border-0 zoom alert alert-primary">
              <div class="card-subtitle text-center h4"><i class="bi-heart-fill"></i></div>
              <div class="card-title text-center">
                RECUPERADOS
              </div>
              <div class="text-center align-content-center d-flex justify-content-center">
                <button class="btn btn-primary badge rounded-pill d-block" id="total-adm">0</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <br><br><br><br><br><br><br><br>

      <div class="tab-content" id="nav-tabContent">

        <!-- HOME -->
        <?php
        if ($funcionario->getTipoFuncionario() == "Administrador") { ?>

          <div class="tab-pane fade bg-white m-2 me-3" id="list-home" role="tabpanel" aria-labelledby="list-home-list">

            <div class="container mt-2 p-2">
              <div class="alert">
                <h3>HOME</h3>
              </div>
              <div class="row shadow shadow-sm p-5 text-center d-flex bg-light alert-light">
                <div class="alert alert-light shadow-sm">

                  <a class="p-1 btn-sm btn-outline-success graficos-modal text-decoration-none" data-bs-toggle="modal" href="#modalCasoMunicipio" role="button" id="viana">Viana (<span class="casosViana">(0)</span>)</a>
                  <a class="p-1 btn-sm btn-outline-success graficos-modal text-decoration-none" data-bs-toggle="modal" href="#modalCasoMunicipio" role="button" id="belas">Belas (<span class="casosBelas">(0)</span>)</a>
                  <a class="p-1 btn-sm btn-outline-success graficos-modal text-decoration-none" data-bs-toggle="modal" href="#modalCasoMunicipio" role="button" id="cazenga">Cazanga (<span class="casosCazenga">(0)</span>)</a>
                  <a class="p-1 btn-sm btn-outline-success graficos-modal text-decoration-none" data-bs-toggle="modal" href="#modalCasoMunicipio" role="button" id="cacuaco">Cacuaco (<span class="casosCacuaco">(0)</span>)</a>
                  <a class="p-1 btn-sm btn-outline-success graficos-modal text-decoration-none" data-bs-toggle="modal" href="#modalCasoMunicipio" role="button" id="kk">K. Kiaxi (<span class="casosKK">(0)</span>)</a>
                  <a class="p-1 btn-sm btn-outline-success graficos-modal text-decoration-none" data-bs-toggle="modal" href="#modalCasoMunicipio" role="button" id="kissama">Kissama (<span class="casosKissama">(0)</span>)</a>
                  <a class="p-1 btn-sm btn-outline-success graficos-modal text-decoration-none" data-bs-toggle="modal" href="#modalCasoMunicipio" role="button" id="luanda">Luanda (<span class="casosLuanda">(0)</span>)</a>
                  <a class="p-1 btn-sm btn-outline-success graficos-modal text-decoration-none" data-bs-toggle="modal" href="#modalCasoMunicipio" role="button" id="talatona">Talatona (<span class="casosTalatona">(0)</span>)</a>
                  <a class="p-1 btn-sm btn-outline-success graficos-modal text-decoration-none" data-bs-toggle="modal" href="#modalCasoMunicipio" role="button" id="icolo">I. Bengo (<span class="casosIB">(0)</span>)</a>
                </div>
                <div class="col-12 alert-light">
                  <canvas id="myChart" width="400" height="200"></canvas>
                </div>

                <div class="col-12 alert-light">
                  <div class="alert alert-light h2">Casos de Mortes. Total de [<?= $casos->countMortes($BD) ?>]</div>
                  <canvas id="casoMorte" width="400" height="200"></canvas>
                </div>
              </div>

              <div class="mt-5 bg-light container">

                <!-- <canvas id="myChart" width="400" height="400"></canvas> -->
                <a href="#" class="btn btn-success float-end me-5 gp">
                  <i class="bi-pie-chart"></i>
                </a>
                <a href="#" class="btn btn-warning float-end me-3 gg">
                  <i class="bi-file-bar-graph">
                  </i>
                </a>
                <br><br>
                <div class="row shadow-sm">
                  <div class="col-6 bg-white">
                    <div id="graficosColuna"></div>

                  </div>
                  <div class="col-6 bg-white">
                    <div id="graficoColuna2"></div>

                  </div>
                </div>

                <div class="container">
                  <div class="col">
                    <div id="graficoPizza"></div>
                  </div>

                </div>



              </div>
            </div>
          </div>
        <?php }
        ?>
        <!-- END HOME -->


        <!-- VIEW FUNCIONARIOS -->
        <?php
        if ($funcionario->getTipoFuncionario() == "Administrador") {
          require './assets/includes/views/view.funcionarios.php';
        }
        ?>

        <!-- END FUMMCIONÁRIOS -->

        <!-- VIEW CASOS -->
        <?php require './assets/includes/views/view.casos.php'; ?>

        <!-- END CASOS -->

        <div class="tab-pane fade " id="adm" role="tabpanel" aria-labelledby="menu-adm">administradores</div>


        <!-- INSIDÊNCIAS E PREVALÊNCIAS -->
        <?php require './assets/includes/views/view.insidencias.php'; ?>
        <!-- END INSIDÊNCIAS E PREVALÊNCIAS -->

        <!-- RELATÓRIOS PREDEFINIDOS -->
        <?php
        if ($funcionario->getTipoFuncionario() == "Administrador") {
          require './assets/includes/views/view.relatorios.php';
        }
        ?>
        <!-- END RELATÓRIOS PREDFINIDOS -->
        <?php
        if ($funcionario->getTipoFuncionario() == "Administrador") { ?>
          <div class="tab-pane fade" id="info" role="tabpanel" aria-labelledby="menu-info">

            <div class="card border-dark">
              <div class="container border-light">
                <div class="card-header alert-light">
                  <h5>Inormações sobre os casos</h5>
                </div>
                <div class="card-body alert-light info-data">

                </div>
              </div>


            </div>

          </div>
        <?php } ?>

        <div class="tab-pane fade" id="analistas" role="tabpanel" aria-labelledby="menu-analista">
          <div class="container">
            <div class="card">

              <div class="card-body">
                <h4 class="card-title">Ações registrados pelo sistema</h4>
                <hr>
                <table class="table table-striped table-sm">
                  <thead class="bg-1 text-white">
                    <tr>
                      <th>N. LOG</th>
                      <th>AÇÃO</th>
                      <th>USUÁRIO</th>
                      <th>CATEGORIA</th>
                      <th>DATA e HORA</th>
                    </tr>
                  </thead>
                  <tbody class="logs">


                  </tbody>
                </table>

              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  </div>

  <?php require './assets/includes/modals/modalCasoMunicipios.php'; ?>
  <?php require './assets/includes/modals/modalNovoCaso.php'; ?>
  <?php require './assets/includes/modals/modalRelatar.php'; ?>
  <?php require './assets/includes/modals/modalNovoFuncionario.php'; ?>


  <script src="./pugins/jquery.js"></script>

  <script src="./pugins/highchart/highcharts.js"></script>
  <script src="./pugins/highchart/highcharts-3d.js"></script>

  <script type="text/javascript" src="./charts/loader.js"></script>

  <script src="./pugins/chart/chart.min.js"></script>
  <script src="./pugins/chart/Chart.bundle.min.js"></script>




  <script src="./assets/vendor/bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
  <script src="./assets/vendor/bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>


  <script src="./assets/js/main.js"></script>
  <script src="./assets/js/funcionarios.js"></script>
  <script src="./assets/js/casos.js"></script>
  <script src="./assets/js/logs.js"></script>
  <script src="./assets/js/contadores.js"></script>

  <?php require './graficos/casosHome.php'; ?>

  <script>
    var chart = Highcharts.chart('graficoColuna2', {

      title: {
        text: 'Casos gerais',
        align: 'left',
        x: 20,
        y: 5,
        style: {
          color: '#41CD7D',
          fontSize: '1.5em',
          fontFamily: 'sans-serif'
        }
      },
      xAxis: {
        categories: headers
      },
      credits: {
        enabled: false
      },

      series: [{
        type: 'column',
        colorByPoint: true,
        data: dados_todos,
        showInLegend: true,
        name: 'casos estudados'
      }]

    });
  </script>

  <script type="text/javascript">
    // Load the Visualization API and the corechart package.
    google.charts.load('current', {
      'packages': ['corechart']
    });

    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawChart);

    // Callback that creates and populates a data table,
    // instantiates the pie chart, passes in the data and
    // draws it.
    function drawChart() {

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
      var chart = new google.visualization.PieChart(document.getElementById('graficoPizza'));
      chart.draw(data, options);
    }
  </script>


  <?php require './graficos/./casosMorte.php'; ?>
  <?php require './graficos/casos.php'; ?>
  <!-- 
  <script src="assets/vendor/aos/aos.js"></script> -->

  <script>
    const labs = [
      <?= $casos->casosMunicipios($BD) ?>
    ]
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: ['VIANA', 'BELAS', 'TALATONA', 'KISSAMA', 'CAZENGA', 'ICOLO E BENGO', 'KILAMBA-KIAXI', 'CACUACO', 'LUANDA'],
        datasets: [{
          label: 'CASOS A NÍVEL DE MUNICÍPIOS',
          data: [<?= $casos->casosMunicipios($BD) ?>],
          backgroundColor: [
            'rgba(52, 168, 83, 0.2)',
            'rgba(52, 168, 83, 0.2)',
            'rgba(52, 168, 83, 0.2)',
            'rgba(52, 168, 83, 0.2)',
            'rgba(52, 168, 83, 0.2)',
            'rgba(52, 168, 83, 0.2)',
            'rgba(52, 168, 83, 0.2)',
            'rgba(52, 168, 83, 0.2)',
            'rgba(52, 168, 83, 0.2)',

          ],
          borderColor: [
            'rgb(52, 168, 83)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)',
            'rgba(255, 159, 225, 1)',
            'rgba(255, 159, 0, 1)',
            'rgba(255, 0, 64, 1)',
          ],
          borderWidth: 4
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

  <script>
    const ctx1 = document.getElementById('myChartMunicipios').getContext('2d');
    const linksM = document.querySelectorAll('.graficos-modal')

    linksM.forEach((e) => {
      e.addEventListener('click', () => {
        switch (e.id) {
          case 'viana':

            const myChart1 = new Chart(ctx1, {
              type: 'bar',
              data: {
                labels: ['INSIDÊNCIA', 'PREVALÊNCIAS'],
                datasets: [{
                  label: 'Insidências  prevalências em Viana',
                  data: [<?= $casos->insidenciasPrevalencia1($BD) ?>],
                  backgroundColor: [
                    'rgb(52, 168, 83, 0.2)',
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
            break;

          case 'belas':

            const myChart2 = new Chart(ctx1, {
              type: 'bar',
              data: {
                labels: ['INSIDÊNCIA', 'PREVALÊNCIAS'],
                datasets: [{
                  label: 'Insidências  prevalências em Viana',
                  data: [<?= $casos->insidenciasPrevalencia2($BD) ?>],
                  backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
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
                    'rgba(255, 99, 132, 1)',
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
            break;

          case 'cazenga':

            const myChart3 = new Chart(ctx1, {
              type: 'bar',
              data: {
                labels: ['INSIDÊNCIA', 'PREVALÊNCIAS'],
                datasets: [{
                  label: 'Insidências  prevalências em Viana',
                  data: [<?= $casos->insidenciasPrevalencia5($BD) ?>],
                  backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
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
                    'rgba(255, 99, 132, 1)',
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
            break;

          case 'cacuaco':

            const myChart4 = new Chart(ctx1, {
              type: 'bar',
              data: {
                labels: ['INSIDÊNCIA', 'PREVALÊNCIAS'],
                datasets: [{
                  label: 'Insidências  prevalências em Viana',
                  data: [<?= $casos->insidenciasPrevalencia7($BD) ?>],
                  backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
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
                    'rgba(255, 99, 132, 1)',
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
            break;

          case 'kk':

            const myChart5 = new Chart(ctx1, {
              type: 'bar',
              data: {
                labels: ['INSIDÊNCIA', 'PREVALÊNCIAS'],
                datasets: [{
                  label: 'Insidências  prevalências em Viana',
                  data: [<?= $casos->insidenciasPrevalencia8($BD) ?>],
                  backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
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
                    'rgba(255, 99, 132, 1)',
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
            break;

          case 'kissama':

            const myChart6 = new Chart(ctx1, {
              type: 'bar',
              data: {
                labels: ['INSIDÊNCIA', 'PREVALÊNCIAS'],
                datasets: [{
                  label: 'Insidências  prevalências em Viana',
                  data: [<?= $casos->insidenciasPrevalencia4($BD) ?>],
                  backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
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
                    'rgba(255, 99, 132, 1)',
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
            break;

          case 'luanda':

            const myChart7 = new Chart(ctx1, {
              type: 'bar',
              data: {
                labels: ['INSIDÊNCIA', 'PREVALÊNCIAS'],
                datasets: [{
                  label: 'Insidências  prevalências em Viana',
                  data: [<?= $casos->insidenciasPrevalencia9($BD) ?>],
                  backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
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
                    'rgba(255, 99, 132, 1)',
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
            break;

          case 'talatona':


            const myChart8 = new Chart(ctx1, {
              type: 'bar',
              data: {
                labels: ['INSIDÊNCIA', 'PREVALÊNCIAS'],
                datasets: [{
                  label: 'Insidências  prevalências em Viana',
                  data: [<?= $casos->insidenciasPrevalencia3($BD) ?>],
                  backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
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
                    'rgba(255, 99, 132, 1)',
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
            break;

          case 'icolo':

            const myChart9 = new Chart(ctx1, {
              type: 'bar',
              data: {
                labels: ['INSIDÊNCIA', 'PREVALÊNCIAS'],
                datasets: [{
                  label: 'Insidências  prevalências em Viana',
                  data: [<?= $casos->insidenciasPrevalencia6($BD) ?>],
                  backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
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
                    'rgba(255, 99, 132, 1)',
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
            break;

        }

      })
    })
  </script>
</body>

</html>