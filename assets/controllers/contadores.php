<?php
require '../../env.php';

function contar($BD)
{
  if (isset($_GET['table'])) {
    $table = filter_input(INPUT_GET, 'table');
    switch ($table) {
      case 'funcionarios':
        $query = $BD->query("SELECT *FROM casos WHERE id_estado = 2");
        print $query->rowCount();
        break;
      case 'casos':
        $query = $BD->query("SELECT *FROM {$table}");
        print $query->rowCount();
        break;
      case 'funcionario_analista':
        $query = $BD->query("SELECT *FROM casos WHERE id_estado = 3");
        print $query->rowCount();
        break;
      case 'casos_ativos':
        $query = $BD->query("SELECT *FROM casos WHERE id_estado = 1");
        print $query->rowCount();
        break;

      default:
        $query = $BD->query("SELECT *FROM casos WHERE id_estado = 4");
        print $query->rowCount();
        break;
    }
  } elseif ($_GET['t']) {
    $t = $_GET['t'];

    switch ($t) {
      case '1':
        $query = $BD->query("SELECT *FROM casos WHERE id_localidade = '1'");
        print $query->rowCount();
        break;

      case '2':
        $query = $BD->query("SELECT *FROM casos WHERE id_localidade = '2'");
        print $query->rowCount();
        break;

      case '5':
        $query = $BD->query("SELECT *FROM casos WHERE id_localidade = '5'");
        print $query->rowCount();
        break;

      case '7':
        $query = $BD->query("SELECT *FROM casos WHERE id_localidade = '7'");
        print $query->rowCount();
        break;

      case '4':
        $query = $BD->query("SELECT *FROM casos WHERE id_localidade = '4'");
        print $query->rowCount();
        break;

      case '8':
        $query = $BD->query("SELECT *FROM casos WHERE id_localidade = '8'");
        print $query->rowCount();
        break;

      case '3':
        $query = $BD->query("SELECT *FROM casos WHERE id_localidade = '3'");
        print $query->rowCount();
        break;

      case '9':
        $query = $BD->query("SELECT *FROM casos WHERE id_localidade = '9'");
        print $query->rowCount();
        break;

      case '6':
        $query = $BD->query("SELECT *FROM casos WHERE id_localidade = '6'");
        print $query->rowCount();
        break;
    }
  }
}

contar($BD);
