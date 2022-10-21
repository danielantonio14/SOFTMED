<?php

session_start();

if (isset($_GET['acao']) && $_GET['acao'] == 'logs') {

    require '../../env.php';
    $logs = $BD->query("SELECT *FROM logs INNER JOIN funcionarios ON funcionarios.idfuncionarios = logs.id_funcionario
INNER JOIN tipo_funcionarios ON tipo_funcionarios.idtipo_funcionarios = funcionarios.id_tipo_funcionario ORDER BY logs.idlogs DESC");
    while ($log = $logs->fetch()) : ?>

      <tr>
        <td scope="row"><?= $log->idlogs ?></td>
        <td><?= $log->designacao_log ?></td>
        <td><?= $log->nome_funcionario ?></td>
        <td><?= $log->designacao_tipo ?></td>
        <td><?= $log->data ?></td>
      </tr>

<?php endwhile;
  }

