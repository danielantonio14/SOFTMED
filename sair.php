<?php

if (isset($_GET['logout']) && $_GET['logout'] == 'yes') {
  session_start();
  require './env.php';
  $send_log = $BD->query("INSERT INTO logs (designacao_log, id_funcionario, id_tipo_funcionario)
      VALUES('Logout ao sitema', '" . $_SESSION['idfuncionarios'] . "', '" . $_SESSION['id_tipo_funcionario'] . "')");
  session_unset();
  session_destroy();
  ## ENVIANDO UM LOG OU HISTORICO

  header('location:./login.php');
} else {
  header('location:./');
}
