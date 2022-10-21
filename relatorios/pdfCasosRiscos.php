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
if (isset($_GET['tipo_casos']) && $_GET['tipo_casos'] != 0) {
  $f = $_GET['tipo_casos'];
  $estado = $_GET['tipo'];
  $thead2 = "";
  $contar = "";

  // Carrega seu HTML
  $query = $BD->query("SELECT *FROM casos
      INNER JOIN fases ON fases.idfases = casos.id_fase
      INNER JOIN estados ON estados.idestados = casos.id_estado
      WHERE casos.id_estado = '$f'
      ORDER BY idcasos DESC");
  $contar = $query->rowCount();
  while ($caso = $query->fetch()) :
    $thead2 .= "<tr>";
    $thead2 .= '<td>' . $caso->idcasos . '</td>';

    $thead2 .= '<td>' . $caso->nome . '</td>';
    $thead2 .= '<td>' . $caso->designacao_fase . '</td>';
    $thead2 .= '<td>' . $caso->idade . '</td>';
    $thead2 .= '<td>' . $caso->genero . '</td>';
    $thead2 .= '<td>' . $caso->morada . '</td>';
    if ($caso->id_estado == 4) {
      $thead2 .= '<td>Recuperado</td>';
    } else {
      $thead2 .= '<td>' . $caso->designacao_estado . '</td>';
    }
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
      display:flex;
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
    <div class="cad-body">
    <center>
    <img src="' . $src . '">
      <h4>
        <span>REPÚBLICA DE ANGOLA</span>       
        <span>MINISTÉRIO DA SAÚDE</span>
        <span>GOVERNO PROVICIAL DE LUANDA</span>
      </h4>
    <h1>SOFTMED</h1>
    <h2>RELATÓRIO DE TODOS OS CASOS EM ESTADO ' . $estado . '.<br> <b>total de registros(' . $contar . ')</b> </h2>
      <table class="table table-sm table-inverse table-hover  border-0 cor-2">
        <thead class="thead-inverse fundo-rgb-preto border-0">
          <tr>
            <th>Nº</th>
            <th>Nome</th>
            
            <th>Fase</th>
            <th>Idade</th>
            <th>Genero</th>
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



     <script src="../assets/vendor/bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
     <script src="../assets/vendor/bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>

     </body>
     </html>


  ';



  $dompdf->loadhtml($thead);
  $dompdf->setPaper('A4', 'landscape');


  //Renderizar o html
  $dompdf->render();

  //Exibibir a página
  $dompdf->stream(
    "Relatórios de Casos de Malária .pdf",
    array(
      "Attachment" => false //Para realizar o download somente alterar para true
    )
  );
}
