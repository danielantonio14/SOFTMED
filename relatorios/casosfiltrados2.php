<?php
require '../env.php';
require '../pugins/dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();

$options->set('isRemoteEnabled', true);

$dompdf = new DOMPDF($options);

// A few settings
$image = './insignia.png';

// Read image path, convert to base64 encoding
$imageData = base64_encode(file_get_contents($image));

// Format the image SRC:  data:{mime};base64,{data};
$src = 'data:' . mime_content_type($image) . ';base64,' . $imageData;


#================= APRESENTAR TODOS OS ALUNOS ==============================
if (isset($_GET['CASE'])) {

  $l = $_GET['localidade'];
  $f = $_GET['fase'];
  $e = $_GET['estado'];
  $g = $_GET['genero'];
}

$thead2 = "";
$contar = "";

// Carrega seu HTML
$query = $BD->query("SELECT *FROM casos
  INNER JOIN fases ON fases.idfases = casos.id_fase
  INNER JOIN estados ON estados.idestados = casos.id_estado
  INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade
  WHERE casos.id_localidade = '$l' AND casos.genero = '$g' AND casos.id_estado = '$e' AND casos.id_fase = '$f'
  ORDER BY idcasos DESC");

$contar = $query->rowCount();

if ($contar > 0) {
  while ($caso = $query->fetch()) :
    $thead2 .= "<tr>";
    $thead2 .= '<td>' . $caso->idcasos . '</td>';

    $thead2 .= '<td>' . $caso->nome . '</td>';
    $thead2 .= '<td>' . $caso->idade . '</td>';
    $thead2 .= '<td>' . $caso->morada . '</td>';
    $thead2 .= '<td>' . $caso->designacao_estado . '</td>';

    $municipio = $caso->designacao_localidade;
    $estado = $caso->designacao_estado;

    if ($caso->dia <= 9) {
      $caso->dia = '0' . $caso->dia;
    }

    if ($caso->mes <= 9) {
      $caso->mes = '0' . $caso->mes;
    }

    $thead2 .= '<td>' . $caso->dia  . '-' . $caso->mes . '-' . $caso->ano . '</td>';
    $thead2 .= "</tr>";

  endwhile;

  $thead =
    '
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href=".././assets/./vendor/./bootstrap-5.1.3-dist/./css/./bootstrap.min.css">

    <link rel="stylesheet" href="../assets/css/padrao.css">

    <title>SOFT-MED | Software para analista</title>
    <style>
    body{
      background:#fbfbfb; padding:1px;}
    table{
      background:#f6f9fc;
      border:2px #ddd solid;
      }
    
      table tr th{
        padding:4px;
        background: #444;
        color: #fff;
        font-family: sans-serif;
        border:1px solid #444;
        text-transform:uppercase
      }
      table tr td{
        padding:3px;
        background: #f7f7f7;
        color: #444;
        font-family: sans-serif;
        border-bottom:1px solid #444;
        text-align:center
      }
      h1,h2{text-align:center; font-family:sans-serif}
      h1{ color: #253D4B !important;}
      h2{ color: #41CD7D;}
      h2 b{ color: #444; font-size:12px}
      div.flex{
        display:flex !important;
        justify-content:center;
        items-align:center;

      }
      img{
        max-width:100%;
        width:70px;
        height:70px;
        padding:2px
      }
      h4 span{
        font-family:sans-serif;
        display:block
        }
    </style>
  </head>

  <body class="fundo">
    <div class="card-body">
    <center>
      <img src="' . $src . '">
      <h4>
        <span>REPÚBLICA DE ANGOLA</span>       
        <span>MINISTÉRIO DA SAÚDE</span>
        <span>GOVERNO PROVICIAL DE LUANDA</span>
      </h4>
      
      
      
 
    <h1>SOFTMED</h1>
    <h2>RELATÓRIO DE TODOS OS CASOS DE ' . strtoupper($estado) . 'S A NÍVEL DE ' . strtoupper($municipio) . ' <br> <b>total de registros(' . $contar . ')</b> </h2>
    <div class="flex">
      <table class="table table-sm table-inverse table-hover  border-0 cor-2">
        <thead class="thead-inverse fundo-rgb-preto border-0">
          <tr>
            <th>Nº</th>

            <th>nome</th>
            <th>Idade</th>
            <th>Morada</th>
            <th>Estado do caso</th>
   
            <th>Data de estudo</th>
          </tr>
        </thead>
        <tbody class="row-case">
          ' . $thead2 . '
        </tbody>
      </table>
      </div>
    </div>
   </center>


     <script src="../assets/vendor/bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
     <script src="../assets/vendor/bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>

     </body>
     </html>

  ';
} else {

  $thead = "<h1>SEM RESULTADOS DE PESQUISA</h1>";
}

$dompdf->loadhtml($thead);
$dompdf->setPaper('A4', 'portaitil');
# outr ORIEnTAÇÃO (PORTAITIL)

//Renderizar o html
$dompdf->render();

//Exibibir a página
$dompdf->stream(
  "Relatórios de Casos de Malária .pdf",
  array(
    "Attachment" => false //Para realizar o download somente alterar para true
  )

);
