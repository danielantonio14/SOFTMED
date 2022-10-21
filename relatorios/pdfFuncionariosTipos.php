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
if (isset($_GET['tipo_func']) && $_GET['tipo_func'] != null) {

  $tipo = $_GET['tipo_func'];
  $cargo = $_GET['tipo'];
  $thead2 = "";
  $contar = "";

  // Carrega seu HTML
  $query = $BD->query("SELECT *FROM funcionarios 
    INNER JOIN tipo_funcionarios
    ON funcionarios.id_tipo_funcionario = tipo_funcionarios.idtipo_funcionarios
    WHERE  funcionarios.id_tipo_funcionario = '$tipo'
    ORDER BY nome_funcionario");
  $contar = $query->rowCount();
  while ($funcionario = $query->fetch()) :
    $thead2 .= "<tr>";
    $thead2 .=   '<td>' . $funcionario->idfuncionarios . '</td>';
    $thead2 .= '<td>' . $funcionario->nome_funcionario . '</td>';
    $thead2 .= '<td>' . $funcionario->email . '</td>';
    $thead2 .= '<td>' . $funcionario->telefone . '</td>';
    $thead2 .= '<td>' . $funcionario->designacao_tipo . '</td>';
    $thead2 .= '<td>' . $funcionario->data_registro . '</td>';
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
    <h2>RELATÓRIO DE TODOS OS FUNCIONÁRIOS ' . strtoupper($cargo) . ' NO SISTEMA.<br> <b>total de registros(' . $contar . ')</b> </h2>
      <table class="table table-striped sm bordered hover|inverse table-inverse" border="1" cellspacing="0">
        <thead class="thead-invese">
          <tr>
            <th>#ID</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Categoria</th>
            <th>Data resgistro</th>
          </tr>
        </thead>
        <tbody id="data-view">
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
  $dompdf->setPaper('A4', 'portaitil');


  //Renderizar o html
  $dompdf->render();

  //Exibibir a página
  $dompdf->stream(
    "Relatórios de funcionários inscritos.pdf",
    array(
      "Attachment" => false //Para realizar o download somente alterar para true
    )
  );
}
