<?php
/* 
  * ARQUIVO: casos.php
  * FUNÇÃO: FAZER O CRUD DOS CASOS ESTUDADOS
  * OBS : NÃO ALTERA QUAISQUER COISA SEM TERESNOÇÃO DO RESULTADO
 */
class Casos
{
  private $genero, $fase, $idade, $id_nacionalidade, $id_localidade, $estado, $table = 'casos';
  private $dia, $mes, $ano;
  public $erros = null;
  public $bairros, $morada, $nome;

  # GETTS AND SETTRS


  public function setNome($n)
  {
    $this->nome = $n;
  }
  public function setMorada($n)
  {
    $this->morada = $n;
  }
  public function setBairro($n)
  {
    $this->bairros = $n;
  }
  public function setGenero($d)
  {
    $this->genero = $d;
  }
  public function setFase($d)
  {
    $this->fase = $d;
  }
  public function setIdade($d)
  {
    $this->idade = $d;
  }
  public function setIdNacionalidade($d)
  {
    $this->id_nacionalidade = $d;
  }
  public function setIdLocalidade($d)
  {
    $this->id_localidade = $d;
  }
  public function setEstado($d)
  {
    $this->estado = $d;
  }

  public function setDia($d)
  {
    $this->dia = $d;
  }
  public function setMes($d)
  {
    $this->mes = $d;
  }
  public function setAno($d)
  {
    $this->me = $d;
  }


  ## GETTRS
  public function getGenero()
  {
    return $this->genero;
  }
  public function getFase()
  {
    return $this->fase;
  }
  public function getIdade()
  {
    return $this->idade;
  }
  public function getIdNacionalidade()
  {
    return $this->id_nacionalidade;
  }
  public function getIdLocalidade()
  {
    return $this->id_localidade;
  }

  public function getIdcasos()
  {
    return $this->idcasoss;
  }

  public function getEstado()
  {
    return $this->estado;
  }
  public function getDia()
  {
    return $this->dia;
  }
  public function getMes()
  {
    return $this->mes;
  }
  public function getAno()
  {
    return  $this->me;
  }

  public function getBairro()
  {
    return $this->bairros;
  }

  public function getNome()
  {
    return $this->nome;
  }
  public function getMorada()
  {
    return $this->morada;
  }
  # Validar fase

  public function faseValidate($data)
  {
    if (is_null($data) || ltrim(empty($data)) || $data == "Fase") {
      $this->erros = 'Informe uma fase válida.';
    }
  }

  # veridica localidae
  public function verficaLocalidade()
  {
    // session_start();
    if ($_SESSION['id_localidade'] != $this->getIdLocalidade()) {
      $this->erros = 'Não  pode cadastrar caso numa localidade diferente da sua.';
    }
  }

  # Validar nacionalidade

  public function nacionalidadeValidate($data)
  {
    if (is_null($data) || ltrim(empty($data)) || $data == "Nacionalidade") {
      $this->erros = 'Informe uma Nacionalidade válida.';
    }
  }
  # Validar genro

  public function generoValidate($data)
  {
    if (is_null($data) || ltrim(empty($data)) || $data == "Genero") {
      $this->erros = 'Informe um Genero válido.';
    }
  }

  public function localValidate($data)
  {
    if (is_null($data) || ltrim(empty($data)) || $data == "Localidade") {
      $this->erros = 'Informe uma Localidade válida.';
    }
  }
  public function estadoValidate($data)
  {
    if (is_null($data) || ltrim(empty($data)) || $data == "Estado") {
      $this->erros = 'Informe um Estado válido.';
    }
  }
  public function diaValidate($data)
  {
    if (is_null($data) || ltrim(empty($data)) || $data == "Dia") {
      $this->erros = 'Informe um Dia válido.';
    }
  }
  public function mesValidate($data)
  {
    if (is_null($data) || ltrim(empty($data)) || $data == "Mês") {
      $this->erros = 'Informe um Mês válido.';
    }
  }
  public function anoValidate($data)
  {
    if (is_null($data) || ltrim(empty($data)) || $data == "Ano") {
      $this->erros = 'Informe um Ano válido.';
    }
  }

  public function nomeValidate($data)
  {
    if (!preg_match("/^[a-zA-ZáÁéÉíÍóÓúÚàÀèÈìÌòÒùÙãÃõÕâÂêÊîÎôÔûÛçÇ ]*$/", $data) || ltrim(strlen($data) < 8) || $data ==  "" || $data == null || empty($data)) {
      $this->erros = 'O nome inserido não é válido.';
    }
  }


  # ### SAVE TO DATA BASE 

  public function save($BD)
  {

    try {

      $query = "INSERT INTO {$this->table} (genero, idade, id_fase, id_estado, id_nacionalidade, id_localidade, id_funcionario, bairro, dia, mes, ano, nome, morada)
        VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)";
      $inserir = $BD->prepare($query);
      $inserir->bindValue(1, $this->getGenero());
      $inserir->bindValue(2, $this->getIdade());
      $inserir->bindValue(3, $this->getFase());
      $inserir->bindValue(4, $this->getEstado());
      $inserir->bindValue(5, $this->getIdNacionalidade());
      $inserir->bindValue(6, $this->getIdLocalidade());
      $inserir->bindValue(7, $_SESSION['idfuncionarios']);
      $inserir->bindValue(8, $this->getBairro());
      $inserir->bindValue(9, date('d'));
      $inserir->bindValue(10, date('m'));
      $inserir->bindValue(11, date('Y'));
      $inserir->bindValue(12, $this->getNome());
      $inserir->bindValue(13, $this->getMorada());

      $BD->query("SET FOREIGN_KEY_CHECKS = 0");
      if ($_SESSION['id_tipo_funcionario'] != 2) {
        $this->erros = 'Apenas Analistas podem realizar esta operação.';
      }
      if ($this->erros == null) {

        $inserir->execute();

        $BD->query("SET FOREIGN_KEY_CHECKS = 1");
        print 200;
      } else {
        print $this->erros;
      }
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  # ### VIW LIST
  public function index($BD)
  {
    session_start();
    try {
      $query = $BD->query("SELECT *FROM {$this->table}
      INNER JOIN fases ON fases.idfases = casos.id_fase
      INNER JOIN estados ON estados.idestados = casos.id_estado
      ORDER BY idcasos DESC LIMIT 0, 30
      ");
      while ($casos = $query->fetch()) :
        if ($_SESSION['idfuncionarios'] == $casos->id_funcionario) {

          if ($casos->id_estado == 3) {
?>
            <tr class="row-user<?= $casos->idcasos ?> alert-danger">
              <td><?= $casos->nome ?></td>

              <td><?= $casos->designacao_fase ?></td>
              <td><?= $casos->idade ?></td>
              <td scope="row"><?= $casos->genero ?></td>
              <td><?php if ($casos->id_estado > 3) {
                    print 'Recuperado';
                  } else {
                    print $casos->designacao_estado;
                  } ?>
              </td>
              <td><?= $casos->morada ?></td>
              <td><?= $casos->dia ?>/<?= $casos->mes ?>/<?= $casos->ano ?></td>
              <td>

                <div class="dropup">
                  <a class="btn border-0 btn-md dropdown-toggle text-dark" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                  </a>

                  <ul class="dropdown-menu rounded-0" aria-labelledby="dropdownMenuLink">
                    <li>
                      <a class="dropdown-item ae" href="#" id="<?= $casos->idcasos ?>" title="3">
                        <i class=" bi bi-pen"></i> Mudar para Morto
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item ae" href="#" id="<?= $casos->idcasos ?>" title="2">
                        <i class=" bi bi-pen"></i> Mudar para Risco
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item ae" href="#" id="<?= $casos->idcasos ?>" title="1">
                        <i class=" bi bi-pen"></i> Mudar para Activo
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item ae" href="#" id="<?= $casos->idcasos ?>" title="4">
                        <i class=" bi bi-pen"></i> Mudar para Recuperado
                      </a>
                    </li>

                  </ul>
                </div>
              </td>
            </tr>
          <?php

          } elseif ($casos->id_estado > 3) {
          ?>
            <tr class="row-user<?= $casos->idcasos ?> alert-success">
              <td><?= $casos->nome ?></td>

              <td><?= $casos->designacao_fase ?></td>
              <td><?= $casos->idade ?></td>
              <td scope="row"><?= $casos->genero ?></td>
              <td><?php if ($casos->id_estado > 3) {
                    print 'Recuperado';
                  } else {
                    print $casos->designacao_estado;
                  } ?>
              </td>
              <td><?= $casos->morada ?></td>
              <td><?= $casos->dia ?>/<?= $casos->mes ?>/<?= $casos->ano ?></td>
              <td>

                <div class="dropup">
                  <a class="btn border-0 btn-md dropdown-toggle text-dark" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                  </a>

                  <ul class="dropdown-menu rounded-0" aria-labelledby="dropdownMenuLink">
                    <li>
                      <a class="dropdown-item ae" href="#" id="<?= $casos->idcasos ?>" title="3">
                        <i class=" bi bi-pen"></i> Mudar para Morto
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item ae" href="#" id="<?= $casos->idcasos ?>" title="2">
                        <i class=" bi bi-pen"></i> Mudar para Risco
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item ae" href="#" id="<?= $casos->idcasos ?>" title="1">
                        <i class=" bi bi-pen"></i> Mudar para Activo
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item ae" href="#" id="<?= $casos->idcasos ?>" title="4">
                        <i class=" bi bi-pen"></i> Mudar para Recuperado
                      </a>
                    </li>

                  </ul>
                </div>
              </td>
            </tr>

          <?php
          } elseif ($casos->id_estado == 2) {
          ?>
            <tr class="row-user<?= $casos->idcasos ?> alert-warning">
              <td><?= $casos->nome ?></td>

              <td><?= $casos->designacao_fase ?></td>
              <td><?= $casos->idade ?></td>
              <td scope="row"><?= $casos->genero ?></td>
              <td><?php if ($casos->id_estado > 3) {
                    print 'Recuperado';
                  } else {
                    print $casos->designacao_estado;
                  } ?>
              </td>
              <td><?= $casos->morada ?></td>
              <td><?= $casos->dia ?>/<?= $casos->mes ?>/<?= $casos->ano ?></td>
              <td>

                <div class="dropup">
                  <a class="btn border-0 btn-md dropdown-toggle text-dark" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                  </a>

                  <ul class="dropdown-menu rounded-0" aria-labelledby="dropdownMenuLink">
                    <li>
                      <a class="dropdown-item ae" href="#" id="<?= $casos->idcasos ?>" title="3">
                        <i class=" bi bi-pen"></i> Mudar para Morto
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item ae" href="#" id="<?= $casos->idcasos ?>" title="2">
                        <i class=" bi bi-pen"></i> Mudar para Risco
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item ae" href="#" id="<?= $casos->idcasos ?>" title="1">
                        <i class=" bi bi-pen"></i> Mudar para Activo
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item ae" href="#" id="<?= $casos->idcasos ?>" title="4">
                        <i class=" bi bi-pen"></i> Mudar para Recuperado
                      </a>
                    </li>

                  </ul>
                </div>
              </td>
            </tr>

          <?php
          } else {
          ?>

            <tr class="row-user<?= $casos->idcasos ?>">

              <td><?= $casos->nome ?></td>

              <td><?= $casos->designacao_fase ?></td>
              <td><?= $casos->idade ?></td>
              <td scope="row"><?= $casos->genero ?></td>
              <td><?php if ($casos->id_estado > 3) {
                    print 'Recuperado';
                  } else {
                    print $casos->designacao_estado;
                  } ?>
              </td>
              <td><?= $casos->morada ?></td>
              <td><?= $casos->dia ?>/<?= $casos->mes ?>/<?= $casos->ano ?></td>
              <td>

                <div class="dropup">
                  <a class="btn border-0 btn-md dropdown-toggle text-dark" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                  </a>

                  <ul class="dropdown-menu rounded-0" aria-labelledby="dropdownMenuLink">
                    <li>
                      <a class="dropdown-item ae" href="#" id="<?= $casos->idcasos ?>" title="3">
                        <i class=" bi bi-pen"></i> Mudar para Morto
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item ae" href="#" id="<?= $casos->idcasos ?>" title="2">
                        <i class=" bi bi-pen"></i> Mudar para Risco
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item ae" href="#" id="<?= $casos->idcasos ?>" title="1">
                        <i class=" bi bi-pen"></i> Mudar para Activo
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item ae" href="#" id="<?= $casos->idcasos ?>" title="4">
                        <i class=" bi bi-pen"></i> Mudar para Recuperado
                      </a>
                    </li>

                  </ul>
                </div>
              </td>
            </tr>
      <?php }
        }
      endwhile;
    } catch (PDOException $e) {
      print $e->getMessage();
    }
  }

  # ## DELTE USER IN BD
  public function delete($BD, $id)
  {
    $query = $BD->query("DELETE FROM {$this->table} WHERE idcasoss = '$id'");
    $send_log = $BD->query("INSERT INTO logs (designacao_log, id_funcionario, id_tipo_funcionario)
  VALUES('Remoção de Funcionários na BD', '" . $_SESSION['idfuncionarios'] . "', '" . $_SESSION['id_tipo_funcionario'] . "')");
  }

  # ## FIND USER
  public function find($BD, $query)
  {
    $query = $BD->query("SELECT *FROM {$this->table}  
    INNER JOIN tipo_casoss
    ON casoss.id_tipo_casos = tipo_casoss.idtipo_casoss 
    WHERE nome_casos LIKE '%$query%'");

    while ($casos = $query->fetch()) :
      if ($query->rowCount() <= 0) {
        print '<div class="text-danger text-center">Sem resultados</div>';
      }
      ?>
      <tr class="row-user<?= $casos->idcasoss ?>">
        <td><?= $casos->idcasoss ?></td>
        <td scope="row"><?= $casos->genero_casos ?></td>
        <td><?= $casos->fase ?></td>
        <td><?= $casos->idade ?></td>
        <td><?= $casos->designacao_tipo ?></td>
        <td>
          <div class="dropup">
            <a class="btn border-0 btn-md dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">

            </a>

            <ul class="dropdown-menu rounded-0" aria-labelledby="dropdownMenuLink">
              <li>
                <a class="dropdown-item" href="#">
                  <i class="bi bi-pen"></i> Editar
                </a>
              </li>
              <li>
                <a class="dropdown-item delete-user" href="#" id="<?= $casos->idcasoss ?>">
                  <i class="bi bi-pen"></i> Remover
                </a>
              </li>

            </ul>
          </div>
        </td>
      </tr>
    <?php endwhile; ?>


  <?php
  }

  ## graficos in pagge casos
  public function graficos($BD)
  {
    $query_1 = $BD->query("SELECT *FROM casos INNER JOIN fases ON fases.idfases = casos.id_fase WHERE fases.idfases = 1");
    $num = $query_1->rowCount();

    $query_2 = $BD->query("SELECT *FROM casos INNER JOIN fases ON fases.idfases = casos.id_fase WHERE  fases.idfases = 2");
    $num2 = $query_2->rowCount();

    $query_3 = $BD->query("SELECT *FROM casos INNER JOIN fases ON fases.idfases = casos.id_fase WHERE  fases.idfases = 3");
    $num3 = $query_3->rowCount();

    $query_4 = $BD->query("SELECT *FROM casos INNER JOIN fases ON fases.idfases = casos.id_fase WHERE  fases.idfases = 4");
    $num4 = $query_4->rowCount();

    $query_5 = $BD->query("SELECT *FROM casos INNER JOIN fases ON fases.idfases = casos.id_fase WHERE  fases.idfases = 5");
    $num5 = $query_5->rowCount();


    $dados = "";
    //while ($caso = $query_1->fetch()) {

  ?>
    ['<?= $query_1->fetch()->designacao_fase; ?>', <?= $num ?>],
    ['<?= $query_2->fetch()->designacao_fase; ?>', <?= $num2 ?>],
    ['<?= $query_3->fetch()->designacao_fase; ?>', <?= $num3 ?>],
    ['<?= $query_4->fetch()->designacao_fase; ?>', <?= $num4 ?>],
    ['<?= $query_5->fetch()->designacao_fase; ?>', <?= $num5 ?>],
  <?php
    //  }
    print($dados);
  }


  ## graficos in pagge casos
  public function graficosMulheres($BD)
  {
    $query_criancas_mulher = $BD->query("SELECT *FROM casos INNER JOIN fases ON fases.idfases = casos.id_fase WHERE fases.idfases = 1 AND casos.genero = 'Femenino'");
    $num_crianca_mulher = $query_criancas_mulher->rowCount();

    $query_adolescente_mulher = $BD->query("SELECT *FROM casos INNER JOIN fases ON fases.idfases = casos.id_fase WHERE  fases.idfases = 2 AND casos.genero = 'Femenino'");
    $num_adolescente_mulher = $query_adolescente_mulher->rowCount();

    $query_jovens_mulher = $BD->query("SELECT *FROM casos INNER JOIN fases ON fases.idfases = casos.id_fase WHERE  fases.idfases = 3 AND casos.genero = 'Femenino'");
    $num_jovens_mulher = $query_jovens_mulher->rowCount();

    $query_adultos_mulher = $BD->query("SELECT *FROM casos INNER JOIN fases ON fases.idfases = casos.id_fase WHERE  fases.idfases = 4 AND casos.genero = 'Femenino'");
    $num_adultos_mulher = $query_adultos_mulher->rowCount();

    $query_idosos_mulher = $BD->query("SELECT *FROM casos INNER JOIN fases ON fases.idfases = casos.id_fase WHERE  fases.idfases = 5 AND casos.genero = 'Femenino'");
    $num_idosos_mulher = $query_idosos_mulher->rowCount();

    $criancas_mulheres = array(
      'Crianças' => $num_crianca_mulher,
      'Adolescentes' => $num_adolescente_mulher,
      'Jovens' => $num_jovens_mulher,
      'Adultos' => $num_adultos_mulher,
      'Idosos' => $num_idosos_mulher,
    );

    echo implode(',', $criancas_mulheres);
    // foreach ($criancas_mulheres as $key => $value) {
    //   echo "'" . $key . "'," . $value;
    // }
  }

  # ## HOMEns
  public function graficosHomens($BD)
  {
    $query_criancas_homem = $BD->query("SELECT *FROM casos INNER JOIN fases ON fases.idfases = casos.id_fase WHERE fases.idfases = 1 AND casos.genero = 'Masculino'");
    $num_crianca_homem = $query_criancas_homem->rowCount();

    $query_adolescente_homem = $BD->query("SELECT *FROM casos INNER JOIN fases ON fases.idfases = casos.id_fase WHERE  fases.idfases = 2 AND casos.genero = 'Masculino'");
    $num_adolescente_homem = $query_adolescente_homem->rowCount();

    $query_jovens_homem = $BD->query("SELECT *FROM casos INNER JOIN fases ON fases.idfases = casos.id_fase WHERE  fases.idfases = 3 AND casos.genero = 'Masculino'");
    $num_jovens_homem = $query_jovens_homem->rowCount();

    $query_adultos_homem = $BD->query("SELECT *FROM casos INNER JOIN fases ON fases.idfases = casos.id_fase WHERE  fases.idfases = 4 AND casos.genero = 'Masculino'");
    $num_adultos_homem = $query_adultos_homem->rowCount();

    $query_idosos_homem = $BD->query("SELECT *FROM casos INNER JOIN fases ON fases.idfases = casos.id_fase WHERE  fases.idfases = 5 AND casos.genero = 'Masculino'");
    $num_idosos_homem = $query_idosos_homem->rowCount();

    $criancas_homens = array(
      'Crianças' => $num_crianca_homem,
      'Adolescentes' => $num_adolescente_homem,
      'Jovens' => $num_jovens_homem,
      'Adultos' => $num_adultos_homem,
      'Idosos' => $num_idosos_homem,
    );

    echo implode(',', $criancas_homens);
  }
  # ## Grafico Geral
  public function graficosGeral($BD)
  {
    $query_criancas_homem = $BD->query("SELECT *FROM casos INNER JOIN fases ON fases.idfases = casos.id_fase WHERE fases.idfases = 1");
    $num_crianca_homem = $query_criancas_homem->rowCount();

    $query_adolescente_homem = $BD->query("SELECT *FROM casos INNER JOIN fases ON fases.idfases = casos.id_fase WHERE  fases.idfases = 2");
    $num_adolescente_homem = $query_adolescente_homem->rowCount();

    $query_jovens_homem = $BD->query("SELECT *FROM casos INNER JOIN fases ON fases.idfases = casos.id_fase WHERE  fases.idfases = 3");
    $num_jovens_homem = $query_jovens_homem->rowCount();

    $query_adultos_homem = $BD->query("SELECT *FROM casos INNER JOIN fases ON fases.idfases = casos.id_fase WHERE  fases.idfases = 4");
    $num_adultos_homem = $query_adultos_homem->rowCount();

    $query_idosos_homem = $BD->query("SELECT *FROM casos INNER JOIN fases ON fases.idfases = casos.id_fase WHERE  fases.idfases = 5");
    $num_idosos_homem = $query_idosos_homem->rowCount();

    $criancas_homens = array(
      'Crianças' => $num_crianca_homem,
      'Adolescentes' => $num_adolescente_homem,
      'Jovens' => $num_jovens_homem,
      'Adultos' => $num_adultos_homem,
      'Idosos' => $num_idosos_homem,
    );

    echo implode(',', $criancas_homens);
  }

  # ## PREVALÊNCIAS 
  public function prevalencia($BD)
  {

    # Todos casos
    $casos = $BD->query("SELECT idcasos FROM {$this->table}")->rowCount();

    # Casos ACtivos
    $casosActivos = $BD->query("SELECT idcasos FROM  {$this->table} WHERE id_estado =1")->rowCount(); ?>
    <small>
      IE = <?= $casos ?> => Indivíduos Estudados [<b><?= ($casosActivos * 100) / $casosActivos ?> %</b>]
      <br>
      IA = <?= $casosActivos ?> => Individuos Afetados [<b><?= number_format(($casosActivos * 100) / $casos, 2) ?> %</b>]
      <br>
      PV => Prevalência
    </small>
    <div class="text-center">
      PV = (IA/IE)
      <br>
      PV = (<?= ($casosActivos) . ' /' . $casos ?>)
      <br>
      PV = <?= number_format((($casosActivos) / $casos), 2) ?> <br>
      PV = (<?= number_format((($casosActivos / $casos) / (100)), 5) ?> %)
    </div>
  <?php
  }

  # ## INSIDENCIAS
  public function insidencia($BD)
  {

    # Todos casos
    $casos = $BD->query("SELECT idcasos FROM {$this->table}")->rowCount();

    # Casos ACtivos
    $casosActivos = $BD->query("SELECT idcasos FROM  {$this->table} WHERE id_estado =2")->rowCount(); ?>
    <small>
      IE = <?= $casos ?> => Indivíduos Estudados [<b><?= ($casosActivos * 100) / $casosActivos ?> %</b>]
      <br>
      IR = <?= $casosActivos ?> => Indivíduos em Risco [<b><?= number_format(($casosActivos * 100) / $casos, 2) ?> %</b>]
      <br>
      IC => Insidência
    </small>
    <div class="text-center">
      IC = (IR/IE)
      <br>
      IC = (<?= ($casosActivos) . ' /' . $casos ?>)
      <br>
      IC = <?= number_format((($casosActivos) / $casos), 2) ?> <br>
      IC = (<?= number_format((($casosActivos / $casos) / (100)), 5) ?> %)
    </div>
  <?php
  }
  # ## PREVALÊNCIAS  & INSIDÊNCIAS
  public function insidenciaPrevalencia($BD)
  {

    # Todos casos
    $casos = $BD->query("SELECT idcasos FROM {$this->table}")->rowCount();

    # Casos ACtivos
    $casosActivos = $BD->query("SELECT idcasos FROM  {$this->table} WHERE id_estado =2")->rowCount();
    $casosActivo = $BD->query("SELECT idcasos FROM  {$this->table} WHERE id_estado =1")->rowCount();
    $prevalencia = $casosActivo / $casos;
    $incedencia = $casosActivos / $casos; ?>
    ['INSIDÊNCIAS', <?= $incedencia ?>],
    ['PREVALÊNCIAS', <?= $prevalencia ?>]
    <?php
  }

  # Mostrar casos de Municipios
  public function casosMunicipios($BD)
  {

    # SELEÇÃO DOS MUNICIPIOS

    $casos_viana = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_localidade = 1")->rowCount();
    $casos_belas = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_localidade = 2")->rowCount();
    $casos_talatona = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_localidade = 3")->rowCount();
    $casos_kissama = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_localidade = 4")->rowCount();
    $casos_casenga = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_localidade = 5")->rowCount();
    $casos_icolo = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_localidade = 6")->rowCount();
    $casos_cacuaco = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_localidade = 7")->rowCount();
    $casos_kk = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_localidade = 8")->rowCount();
    $casos_luanda = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_localidade = 9")->rowCount();
    $municipios = array(
      '1' => $casos_viana,
      '2' => $casos_belas,
      '3' => $casos_talatona,
      '4' => $casos_kissama,
      '5' => $casos_casenga,
      '6' => $casos_icolo,
      '7' => $casos_cacuaco,
      '8' => $casos_kk,
      '9' => $casos_luanda
    );
    echo implode(',', $municipios);
  }

  # INsidencias e prevalencias nos municipios
  public function insidenciasPrevalencia1($BD)
  {

    #viana

    // conta quantos casos foram estudados em viana

    $casos_viana = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_localidade = 1")->rowCount();
    $casos_ativos_viana = $BD->query("SELECT *FROM  {$this->table} WHERE id_estado =1 AND id_localidade = 1")->rowCount();
    $casos_riscos_viana = $BD->query("SELECT  *FROM  {$this->table} WHERE id_estado =2  AND id_localidade = 1")->rowCount();
    # Prevaleência
    $prevalencia = ($casos_ativos_viana / $casos_viana);
    $incedencia = ($casos_riscos_viana / $casos_viana);


    $c = array(
      '1' => ($incedencia),
      '2' => ($prevalencia)
    );
    echo implode(',', $c);
  }
  public function insidenciasPrevalencia2($BD)
  {

    $casos_belas = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_localidade = 2")->rowCount();

    $casos_ativos_belas = $BD->query("SELECT *FROM  {$this->table} WHERE id_estado =1 AND id_localidade = 2")->rowCount();
    $casos_riscos_belas = $BD->query("SELECT  *FROM  {$this->table} WHERE id_estado =2  AND id_localidade = 2")->rowCount();
    # Prevaleência
    $prevalencia = ($casos_ativos_belas / $casos_belas);
    $incedencia = ($casos_riscos_belas / $casos_belas);


    $c = array(
      '1' => ($incedencia),
      '2' => ($prevalencia)
    );
    echo implode(',', $c);
  }
  public function insidenciasPrevalencia5($BD)
  {

    $casos_cazenga = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_localidade = 5")->rowCount();

    $casos_ativos_cazenga = $BD->query("SELECT *FROM  {$this->table} WHERE id_estado =1 AND id_localidade = 5")->rowCount();
    $casos_riscos_cazenga = $BD->query("SELECT  *FROM  {$this->table} WHERE id_estado =2  AND id_localidade = 5")->rowCount();
    # Prevaleência
    $prevalencia = ($casos_ativos_cazenga / $casos_cazenga);
    $incedencia = ($casos_riscos_cazenga / $casos_cazenga);


    $c = array(
      '1' => ($incedencia),
      '2' => ($prevalencia)
    );
    echo implode(',', $c);
  }
  public function insidenciasPrevalencia7($BD)
  {
    $casos_cacuaco = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_localidade = 7")->rowCount();

    $casos_ativos_cacuaco = $BD->query("SELECT *FROM  {$this->table} WHERE id_estado =1 AND id_localidade = 7")->rowCount();
    $casos_riscos_cacuaco = $BD->query("SELECT  *FROM  {$this->table} WHERE id_estado =2  AND id_localidade = 7")->rowCount();
    # Prevaleência
    $prevalencia = ($casos_ativos_cacuaco / $casos_cacuaco);
    $incedencia = ($casos_riscos_cacuaco / $casos_cacuaco);

    $c = array(
      '1' => ($incedencia),
      '2' => ($prevalencia)
    );
    echo implode(',', $c);
  }

  public function insidenciasPrevalencia8($BD)
  {
    $casos_kk = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_localidade = 8")->rowCount();

    $casos_ativos_kk = $BD->query("SELECT *FROM  {$this->table} WHERE id_estado =1 AND id_localidade = 8")->rowCount();
    $casos_riscos_kk = $BD->query("SELECT  *FROM  {$this->table} WHERE id_estado =2  AND id_localidade = 8")->rowCount();
    # Prevaleência
    $prevalencia = ($casos_ativos_kk / $casos_kk);
    $incedencia = ($casos_riscos_kk / $casos_kk);

    $c = array(
      '1' => ($incedencia),
      '2' => ($prevalencia)
    );
    echo implode(',', $c);
  }
  public function insidenciasPrevalencia4($BD)
  {
    $casos_kissama = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_localidade = 4")->rowCount();

    $casos_ativos_kissama = $BD->query("SELECT *FROM  {$this->table} WHERE id_estado =1 AND id_localidade = 4")->rowCount();
    $casos_riscos_kissama = $BD->query("SELECT  *FROM  {$this->table} WHERE id_estado =2  AND id_localidade = 4")->rowCount();
    # Prevaleência
    $prevalencia = ($casos_ativos_kissama / $casos_kissama);
    $incedencia = ($casos_riscos_kissama / $casos_kissama);

    $c = array(
      '1' => ($incedencia),
      '2' => ($prevalencia)
    );
    echo implode(',', $c);
  }
  public function insidenciasPrevalencia9($BD)
  {
    $casos_luanda = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_localidade = 9")->rowCount();

    $casos_ativos_luanda = $BD->query("SELECT *FROM  {$this->table} WHERE id_estado =1 AND id_localidade = 9")->rowCount();
    $casos_riscos_luanda = $BD->query("SELECT  *FROM  {$this->table} WHERE id_estado =2  AND id_localidade = 9")->rowCount();
    # Prevaleência
    $prevalencia = ($casos_ativos_luanda / $casos_luanda);
    $incedencia = ($casos_riscos_luanda / $casos_luanda);

    $c = array(
      '1' => ($incedencia),
      '2' => ($prevalencia)
    );
    echo implode(',', $c);
  }
  public function insidenciasPrevalencia3($BD)
  {
    $casos_talatona = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_localidade = 3")->rowCount();

    $casos_ativos_talatona = $BD->query("SELECT *FROM  {$this->table} WHERE id_estado =1 AND id_localidade = 3")->rowCount();
    $casos_riscos_talatona = $BD->query("SELECT  *FROM  {$this->table} WHERE id_estado =2  AND id_localidade = 3")->rowCount();
    # Prevaleência
    $prevalencia = ($casos_ativos_talatona / $casos_talatona);
    $incedencia = ($casos_riscos_talatona / $casos_talatona);

    $c = array(
      '1' => ($incedencia),
      '2' => ($prevalencia)
    );
    echo implode(',', $c);
  }
  public function insidenciasPrevalencia6($BD)
  {
    $casos_IB = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_localidade = 6")->rowCount();

    $casos_ativos_IB = $BD->query("SELECT *FROM  {$this->table} WHERE id_estado =1 AND id_localidade = 6")->rowCount();
    $casos_riscos_IB = $BD->query("SELECT  *FROM  {$this->table} WHERE id_estado =2  AND id_localidade = 6")->rowCount();
    # Prevaleência
    $prevalencia = ($casos_ativos_IB / $casos_IB);
    $incedencia = ($casos_riscos_IB / $casos_IB);

    $c = array(
      '1' => ($incedencia),
      '2' => ($prevalencia)
    );
    echo implode(',', $c);
  }

  # MOSTRAR CASOS DE MORTES
  public function casosMortes($BD)
  {
    try {
      $sql = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 3");

      # contagem de casos de morte
      $luanda = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 3 AND casos.id_localidade = 9 AND bairro = 'Rangel'")->rowCount();
      $luanda2 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 3 AND casos.id_localidade = 9 AND bairro = 'Sambizanga'")->rowCount();
      $kk = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 3 AND casos.id_localidade = 8 AND bairro = 'Golf'")->rowCount();
      $kk2 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 3 AND casos.id_localidade = 8 AND bairro = 'Palanca'")->rowCount();
      $cacuaco = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 3 AND casos.id_localidade = 7 AND bairro = 'Kikolo'")->rowCount();
      $cacuaco2 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 3 AND casos.id_localidade = 7 AND bairro = 'Sequele'")->rowCount();
      $ib = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 3 AND casos.id_localidade = 6 AND bairro = 'Catete'")->rowCount();
      $ib2 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 3 AND casos.id_localidade = 6 AND bairro = 'Bela-vista'")->rowCount();
      $cazenga = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 3 AND casos.id_localidade = 5 AND bairro = 'Hoji ya Henda'")->rowCount();
      $cazenga2 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 3 AND casos.id_localidade = 5 AND bairro = 'Tala Hadi'")->rowCount();
      $kissama = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 3 AND casos.id_localidade = 4 AND bairro = 'Muxima'")->rowCount();
      $kissama2 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 3 AND casos.id_localidade = 4 AND bairro = 'Cabo-ledo'")->rowCount();
      $talatona = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 3 AND casos.id_localidade = 3 AND bairro = 'Benfica'")->rowCount();
      $talatona2 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 3 AND casos.id_localidade = 3 AND bairro = 'camama'")->rowCount();
      $belas = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 3 AND casos.id_localidade = 2 AND bairro = 'Ramiros'")->rowCount();
      $belas2 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 3 AND casos.id_localidade = 2 AND bairro = 'Kilamba'")->rowCount();
      $viana = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 3 AND casos.id_localidade = 1 AND bairro = 'Zango'")->rowCount();
      $viana2 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 3 AND casos.id_localidade = 1 AND bairro = 'Estalagem'")->rowCount();



      while ($casos = $sql->fetch()) {

        if ($_SESSION['idfuncionarios'] == $casos->id_funcionario) {
    ?>

          <tr>
            <td>Viana</td>
            <td>Zango</td>
            <td><?= $viana ?></td>
          </tr>
          <tr>
            <td>Viana</td>
            <td>Estalagem</td>
            <td><?= $viana2 ?></td>
          </tr>
          <tr>
            <td>Luanda</td>
            <td>Sambizanga</td>
            <td><?= $luanda2 ?></td>
          </tr>
          <tr>
            <td>Luanda</td>
            <td>Rangel</td>
            <td><?= $luanda ?></td>
          </tr>
          <tr>
            <td>Belas</td>
            <td>Ramiros</td>
            <td><?= $belas ?></td>
          </tr>
          <tr>
            <td>Belas</td>
            <td>Kilamba</td>
            <td><?= $belas2 ?></td>

          </tr>
          <tr>
            <td>Talatona</td>
            <td>Benfica</td>
            <td><?= $talatona ?></td>

          </tr>
          <tr>
            <td>Talatona</td>
            <td>Camama</td>
            <td><?= $talatona2 ?></td>

          </tr>

          <tr>
            <td>Kissama</td>
            <td>Muxima</td>
            <td><?= $kissama ?></td>

          </tr>
          <tr>
            <td>Kissama</td>
            <td>Cabo-ledo</td>
            <td><?= $kissama2 ?></td>

          </tr>

          <tr>
            <td>Cacuaco</td>
            <td>Kikolo</td>
            <td><?= $cacuaco ?></td>

          </tr>
          <tr>
            <td>Cacuaco</td>
            <td>Sequele</td>
            <td><?= $cacuaco2 ?></td>

          </tr>
          <tr>
            <td>Ico. Bengo</td>
            <td>Catete</td>
            <td><?= $ib ?></td>

          </tr>
          <tr>
            <td>Ico. Bengo</td>
            <td>Bela vista</td>
            <td><?= $ib2 ?></td>

          </tr>
          <tr>
            <td>K. Kiaxi</td>
            <td>Golf</td>
            <td><?= $kk ?></td>

          </tr>
          <tr>
            <td>K. Kiaxi</td>
            <td>Palanca</td>
            <td><?= $kk2 ?></td>

          </tr>

          <tr>
            <td>Cazenga</td>
            <td>Hoji ya Henda</td>
            <td><?= $cazenga ?></td>

          </tr>
          <tr>
            <td>Cazenga</td>
            <td>Tala Hadi</td>
            <td><?= $cazenga2 ?></td>

          </tr>

    <?php
          break;
        }
      }
    } catch (PDOException $err) {
    }
  }

  # Graficos Mortes
  public function graficosMorte($BD)
  {
    $luanda = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 3 AND casos.id_localidade = 9")->rowCount();
    $kk = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 3 AND casos.id_localidade = 8 ")->rowCount();
    $cacuaco = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 3 AND casos.id_localidade = 7")->rowCount();
    $ib = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 3 AND casos.id_localidade = 6")->rowCount();
    $cazenga = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 3 AND casos.id_localidade = 5")->rowCount();
    $kissama = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 3 AND casos.id_localidade = 4")->rowCount();
    $talatona = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 3 AND casos.id_localidade = 3")->rowCount();
    $belas = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 3 AND casos.id_localidade = 2")->rowCount();
    $viana = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 3 AND casos.id_localidade = 1 ")->rowCount();

    $c = array(
      '9' => $luanda,
      '8' => $kk,
      '7' => $cacuaco,
      '6' => $ib,
      '5' => $cazenga,
      '4' => $kissama,
      '3' => $talatona,
      '2' => $belas,
      '1' => $viana,
    );
    echo implode(',', $c);
  }

  ### CONTAR TOTAL CASOS LUANDA DE MORTES
  public function countMortes($BD)
  {
    $luanda = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 3 AND casos.id_localidade = 9")->rowCount();
    $kk = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 3 AND casos.id_localidade = 8 ")->rowCount();
    $cacuaco = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 3 AND casos.id_localidade = 7")->rowCount();
    $ib = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 3 AND casos.id_localidade = 6")->rowCount();
    $cazenga = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 3 AND casos.id_localidade = 5")->rowCount();
    $kissama = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 3 AND casos.id_localidade = 4")->rowCount();
    $talatona = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 3 AND casos.id_localidade = 3")->rowCount();
    $belas = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 3 AND casos.id_localidade = 2")->rowCount();
    $viana = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 3 AND casos.id_localidade = 1 ")->rowCount();
    $total = ($luanda + $kk + $cacuaco + $ib + $cazenga + $kissama + $talatona + $belas + $viana);
    print $total;
  }
  /* INSIDENCIAS e PREVALENCIAS A NIVEL DE DISTRITO */
  public function piDistrito($BD)
  {
    # contagem de casos de morte LUANDA
    $luandaCasos1 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_localidade = 9  AND bairro = 'Rangel'")->rowCount();
    $luandaCasos2 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_localidade = 9  AND bairro = 'Sambizanga'")->rowCount();

    $luandaAtivo1 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 1 AND casos.id_localidade = 9 AND bairro = 'Rangel'")->rowCount();
    $luandaAtivo2 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 1 AND casos.id_localidade = 9 AND bairro = 'Sambizanga'")->rowCount();

    $luandaRisco1 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 2 AND casos.id_localidade = 9 AND bairro = 'Rangel'")->rowCount();
    $luandaRisco2 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 2 AND casos.id_localidade = 9 AND bairro = 'Sambizanga'")->rowCount();

    $luandaI1 = ($luandaRisco1 / $luandaCasos1);
    $luandaI2 = ($luandaRisco1 / $luandaCasos2);

    $luandaP1 = ($luandaAtivo1 / $luandaCasos1);
    $luandaP2 = ($luandaAtivo1 / $luandaCasos2);

    ### TALATONA
    # contagem de casos de morte
    $talatonaCasos1 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_localidade = 3  AND bairro = 'Benfica'")->rowCount();
    $talatonaCasos2 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_localidade = 3  AND bairro = 'Camama'")->rowCount();

    $talatonaAtivo1 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 1 AND casos.id_localidade = 3 AND bairro = 'Benfica'")->rowCount();
    $talatonaAtivo2 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 1 AND casos.id_localidade = 3 AND bairro = 'Camama'")->rowCount();

    $talatonaRisco1 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 2 AND casos.id_localidade = 3 AND bairro = 'Benfica'")->rowCount();
    $talatonaRisco2 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 2 AND casos.id_localidade = 3 AND bairro = 'Camama'")->rowCount();

    $talatonaI1 = ($talatonaRisco1 / $talatonaCasos1);
    $talatonaI2 = ($talatonaRisco1 / $talatonaCasos2);

    $talatonaP1 = ($talatonaAtivo1 / $talatonaCasos1);
    $talatonaP2 = ($talatonaAtivo1 / $talatonaCasos2);

    ### BELAS
    # contagem de casos de morte
    $belasCasos1 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_localidade = 2  AND bairro = 'Kilamba'")->rowCount();
    $belasCasos2 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_localidade = 2  AND bairro = 'Ramiros'")->rowCount();

    $belasAtivo1 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 1 AND casos.id_localidade = 2 AND bairro = 'Kilamba'")->rowCount();
    $belasAtivo2 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 1 AND casos.id_localidade = 2 AND bairro = 'Ramiros'")->rowCount();

    $belasRisco1 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 2 AND casos.id_localidade = 2 AND bairro = 'Kilamba'")->rowCount();
    $belasRisco2 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 2 AND casos.id_localidade = 2 AND bairro = 'Ramiros'")->rowCount();

    $belasI1 = ($belasRisco1 / $belasCasos1);
    $belasI2 = ($belasRisco1 / $belasCasos2);

    $belasP1 = ($belasAtivo1 / $belasCasos1);
    $belasP2 = ($belasAtivo1 / $belasCasos2);

    ### VIANA
    # contagem de casos de morte
    $vianaCasos1 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_localidade = 1  AND bairro = 'Estalagem'")->rowCount();
    $vianaCasos2 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_localidade = 1  AND bairro = 'Zango'")->rowCount();

    $vianaAtivo1 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 1 AND casos.id_localidade = 1 AND bairro = 'Estalagem'")->rowCount();
    $vianaAtivo2 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 1 AND casos.id_localidade = 1 AND bairro = 'Zango'")->rowCount();

    $vianaRisco1 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 2 AND casos.id_localidade = 1 AND bairro = 'Estalagem'")->rowCount();
    $vianaRisco2 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 2 AND casos.id_localidade = 1 AND bairro = 'Zango'")->rowCount();

    $vianaI1 = ($vianaRisco1 / $vianaCasos1);
    $vianaI2 = ($vianaRisco1 / $vianaCasos2);

    $vianaP1 = ($vianaAtivo1 / $vianaCasos1);
    $vianaP2 = ($vianaAtivo1 / $vianaCasos2);

    ### CAZENGA
    # contagem de casos de morte
    $cazengaCasos1 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_localidade = 5  AND bairro = 'Hoji ya Henda'")->rowCount();
    $cazengaCasos2 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_localidade = 5  AND bairro = 'Tala Hadi'")->rowCount();

    $cazengaAtivo1 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 1 AND casos.id_localidade = 5 AND bairro = 'Hoji ya Henda'")->rowCount();
    $cazengaAtivo2 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 1 AND casos.id_localidade = 5 AND bairro = 'Tala Hadi'")->rowCount();

    $cazengaRisco1 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 2 AND casos.id_localidade = 5 AND bairro = 'Hoji ya Henda'")->rowCount();
    $cazengaRisco2 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 2 AND casos.id_localidade = 5 AND bairro = 'Tala Hadi'")->rowCount();

    $cazengaI1 = ($cazengaRisco1 / $cazengaCasos1);
    $cazengaI2 = ($cazengaRisco1 / $cazengaCasos2);

    $cazengaP1 = ($cazengaAtivo1 / $cazengaCasos1);
    $cazengaP2 = ($cazengaAtivo1 / $cazengaCasos2);

    ### CACUACO
    # contagem de casos de morte
    $cacuacoCasos1 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_localidade = 7  AND bairro = 'Kikolo'")->rowCount();
    $cacuacoCasos2 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_localidade = 7  AND bairro = 'Sequele'")->rowCount();

    $cacuacoAtivo1 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 1 AND casos.id_localidade = 7 AND bairro = 'Kikolo'")->rowCount();
    $cacuacoAtivo2 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 1 AND casos.id_localidade = 7 AND bairro = 'Sequele'")->rowCount();

    $cacuacoRisco1 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 2 AND casos.id_localidade = 7 AND bairro = 'Kikolo'")->rowCount();
    $cacuacoRisco2 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 2 AND casos.id_localidade = 7 AND bairro = 'Sequele'")->rowCount();

    $cacuacoI1 = ($cacuacoRisco1 / $cacuacoCasos1);
    $cacuacoI2 = ($cacuacoRisco1 / $cacuacoCasos2);

    $cacuacoP1 = ($cacuacoAtivo1 / $cacuacoCasos1);
    $cacuacoP2 = ($cacuacoAtivo1 / $cacuacoCasos2);

    ### KK
    # contagem de casos de morte
    $kkCasos1 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_localidade = 8  AND bairro = 'Golf'")->rowCount();
    $kkCasos2 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_localidade = 8  AND bairro = 'Palanca'")->rowCount();

    $kkAtivo1 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 1 AND casos.id_localidade = 8 AND bairro = 'Golf'")->rowCount();
    $kkAtivo2 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 1 AND casos.id_localidade = 8 AND bairro = 'Palanca'")->rowCount();

    $kkRisco1 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 2 AND casos.id_localidade = 8 AND bairro = 'Golf'")->rowCount();
    $kkRisco2 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 2 AND casos.id_localidade = 8 AND bairro = 'Palanca'")->rowCount();

    $kkI1 = ($kkRisco1 / $kkCasos1);
    $kkI2 = ($kkRisco1 / $kkCasos2);

    $kkP1 = ($kkAtivo1 / $kkCasos1);
    $kkP2 = ($kkAtivo1 / $kkCasos2);

    ### Kissama
    # contagem de casos de morte
    $kissamaCasos1 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_localidade = 4  AND bairro = 'Cabo-ledo'")->rowCount();
    $kissamaCasos2 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_localidade = 4  AND bairro = 'Muxima'")->rowCount();

    $kissamaAtivo1 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 1 AND casos.id_localidade = 4 AND bairro = 'Cabo-ledo'")->rowCount();
    $kissamaAtivo2 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 1 AND casos.id_localidade = 4 AND bairro = 'Muxima'")->rowCount();

    $kissamaRisco1 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 2 AND casos.id_localidade = 4 AND bairro = 'Cabo-ledo'")->rowCount();
    $kissamaRisco2 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 2 AND casos.id_localidade = 4 AND bairro = 'Muxima'")->rowCount();

    $kissamaI1 = ($kissamaRisco1 / $kissamaCasos1);
    $kissamaI2 = ($kissamaRisco1 / $kissamaCasos2);

    $kissamaP1 = ($kissamaAtivo1 / $kissamaCasos1);
    $kissamaP2 = ($kissamaAtivo1 / $kissamaCasos2);

    ### ICOLO E BENGO
    # contagem de casos de morte
    $ibCasos1 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_localidade = 6  AND bairro = 'Catete'")->rowCount();
    $ibCasos2 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_localidade = 6  AND bairro = 'Bela-vista'")->rowCount();

    $ibAtivo1 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 1 AND casos.id_localidade = 6 AND bairro = 'Catete'")->rowCount();
    $ibAtivo2 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 1 AND casos.id_localidade = 6 AND bairro = 'Bela-vista'")->rowCount();

    $ibRisco1 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 2 AND casos.id_localidade = 6 AND bairro = 'Catete'")->rowCount();
    $ibRisco2 = $BD->query("SELECT *FROM casos INNER JOIN localidades ON localidades.idlocalidades = casos.id_localidade WHERE casos.id_estado = 2 AND casos.id_localidade = 6 AND bairro = 'Bela-vista'")->rowCount();

    $ibI1 = ($ibRisco1 / $ibCasos1);
    $ibI2 = ($ibRisco1 / $ibCasos2);

    $ibP1 = ($ibAtivo1 / $ibCasos1);
    $ibP2 = ($ibAtivo1 / $ibCasos2);


    ?>

    <!-- LINHA LUANDA 1 -->
    <tr>
      <td>Lunda</td>
      <td>Rangel</td>
      <td><?= $luandaAtivo1 ?></td>
      <td><?= $luandaRisco1 ?></td>
      <td><?= $luandaI1 ?></td>
      <td><?= $luandaP1 ?></td>
    </tr>

    <!-- LINHA LUANDA 2 -->
    <tr>
      <td>Luanda</td>
      <td>Sambizanga</td>
      <td><?= $luandaAtivo2 ?></td>
      <td><?= $luandaRisco2 ?></td>
      <td><?= $luandaI2 ?></td>
      <td><?= $luandaP2 ?></td>
    </tr>

    <!-- LINHA CAMAMA 1 -->
    <tr>
      <td>Talatona</td>
      <td>Benfica</td>
      <td><?= $talatonaAtivo1 ?></td>
      <td><?= $talatonaRisco1 ?></td>
      <td><?= $talatonaI1 ?></td>
      <td><?= $talatonaP1 ?></td>
    </tr>

    <!-- LINHA CAMAMA 2 -->
    <tr>
      <td>Talatona</td>
      <td>Camama</td>
      <td><?= $talatonaAtivo2 ?></td>
      <td><?= $talatonaRisco2 ?></td>
      <td><?= $talatonaI2 ?></td>
      <td><?= $talatonaP2 ?></td>
    </tr>

    <!-- LINHA BELAS 1 -->
    <tr>
      <td>Belas</td>
      <td>Kilamba</td>
      <td><?= $belasAtivo1 ?></td>
      <td><?= $belasRisco1 ?></td>
      <td><?= $belasI1 ?></td>
      <td><?= $belasP1 ?></td>
    </tr>

    <!-- LINHA BELAS 2 -->
    <tr>
      <td>Belas</td>
      <td>Ramiros</td>
      <td><?= $belasAtivo2 ?></td>
      <td><?= $belasRisco2 ?></td>
      <td><?= $belasI2 ?></td>
      <td><?= $belasP2 ?></td>
    </tr>


    <!-- LINHA VIANA 1 -->
    <tr>
      <td>Viana</td>
      <td>Estalagem</td>
      <td><?= $vianaAtivo1 ?></td>
      <td><?= $vianaRisco1 ?></td>
      <td><?= $vianaI1 ?></td>
      <td><?= $vianaP1 ?></td>
    </tr>

    <!-- LINHA VIANA 2 -->
    <tr>
      <td>Viana</td>
      <td>Estalagem</td>
      <td><?= $vianaAtivo2 ?></td>
      <td><?= $vianaRisco2 ?></td>
      <td><?= $vianaI2 ?></td>
      <td><?= $vianaP2 ?></td>
    </tr>

    <!-- LINHA LUANDA 1 -->
    <tr>
      <td>Cazenga</td>
      <td>Hoji ya Henda</td>
      <td><?= $cazengaAtivo1 ?></td>
      <td><?= $cazengaRisco1 ?></td>
      <td><?= $cazengaI1 ?></td>
      <td><?= $cazengaP1 ?></td>
    </tr>

    <!-- LINHA LUANDA 2 -->
    <tr>
      <td>Cazenga</td>
      <td>Tala Hadi</td>
      <td><?= $cazengaAtivo2 ?></td>
      <td><?= $cazengaRisco2 ?></td>
      <td><?= $cazengaI2 ?></td>
      <td><?= $cazengaP2 ?></td>
    </tr>

    <!-- LINHA LUANDA 1 -->
    <tr>
      <td>Cacuaco</td>
      <td>Kikolo</td>
      <td><?= $cacuacoAtivo1 ?></td>
      <td><?= $cacuacoRisco1 ?></td>
      <td><?= $cacuacoI1 ?></td>
      <td><?= $cacuacoP1 ?></td>
    </tr>

    <!-- LINHA LUANDA 2 -->
    <tr>
      <td>Cacuaco</td>
      <td>Sequele</td>
      <td><?= $cacuacoAtivo2 ?></td>
      <td><?= $cacuacoRisco2 ?></td>
      <td><?= $cacuacoI2 ?></td>
      <td><?= $cacuacoP2 ?></td>
    </tr>

    <tr>
      <td>Kilamba Kiaxi</td>
      <td>Golf</td>
      <td><?= $kkAtivo1 ?></td>
      <td><?= $kkRisco1 ?></td>
      <td><?= $kkI1 ?></td>
      <td><?= $kkP1 ?></td>
    </tr>

    <!-- LINHA LUANDA 2 -->
    <tr>
      <td>Kilamba Kiaxi</td>
      <td>Palanca</td>
      <td><?= $kkAtivo2 ?></td>
      <td><?= $kkRisco2 ?></td>
      <td><?= $kkI2 ?></td>
      <td><?= $kkP2 ?></td>
    </tr>

    <tr>
      <td>Kissama</td>
      <td>Cabo-ledo</td>
      <td><?= $kissamaAtivo1 ?></td>
      <td><?= $kissamaRisco1 ?></td>
      <td><?= $kissamaI1 ?></td>
      <td><?= $kissamaP1 ?></td>
    </tr>

    <!-- LINHA LUANDA 2 -->
    <tr>
      <td>Kissama</td>
      <td>Muxima</td>
      <td><?= $kissamaAtivo2 ?></td>
      <td><?= $kissamaRisco2 ?></td>
      <td><?= $kissamaI2 ?></td>
      <td><?= $kissamaP2 ?></td>
    </tr>

    <tr>
      <td>Icolo Bengo</td>
      <td>Catete</td>
      <td><?= $ibAtivo1 ?></td>
      <td><?= $ibRisco1 ?></td>
      <td><?= $ibI1 ?></td>
      <td><?= $ibP1 ?></td>
    </tr>

    <!-- LINHA LUANDA 2 -->
    <tr>
      <td>Icolo Bengo</td>
      <td>Bela-vista</td>
      <td><?= $ibAtivo2 ?></td>
      <td><?= $ibRisco2 ?></td>
      <td><?= $ibI2 ?></td>
      <td><?= $ibP2 ?></td>
    </tr>
    <?php


  }




  ## FINDE PACIENT 
  # ### VIW LIST
  public function findPaciente($BD, $query)
  {
    session_start();
    try {
      $query = $BD->query("SELECT *FROM {$this->table}
      INNER JOIN fases ON fases.idfases = casos.id_fase
      INNER JOIN estados ON estados.idestados = casos.id_estado
       WHERE  nome = '$query'
  
      ");
      while ($casos = $query->fetch()) :
        if ($_SESSION['idfuncionarios'] == $casos->id_funcionario) {

          if ($casos->id_estado == 3) {
    ?>
            <tr class="row-user<?= $casos->idcasos ?> alert-danger">
              <td><?= $casos->nome ?></td>

              <td><?= $casos->designacao_fase ?></td>
              <td><?= $casos->idade ?></td>
              <td scope="row"><?= $casos->genero ?></td>
              <td><?php if ($casos->id_estado > 3) {
                    print 'Recuperado';
                  } else {
                    print $casos->designacao_estado;
                  } ?>
              </td>
              <td><?= $casos->morada ?></td>
              <td><?= $casos->dia ?>/<?= $casos->mes ?>/<?= $casos->ano ?></td>
              <td>

                <div class="dropup">
                  <a class="btn border-0 btn-md dropdown-toggle text-dark" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                  </a>

                  <ul class="dropdown-menu rounded-0" aria-labelledby="dropdownMenuLink">
                    <li>
                      <a class="dropdown-item ae" href="#" id="<?= $casos->idcasos ?>" title="3">
                        <i class=" bi bi-pen"></i> Mudar para Morto
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item ae" href="#" id="<?= $casos->idcasos ?>" title="2">
                        <i class=" bi bi-pen"></i> Mudar para Risco
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item ae" href="#" id="<?= $casos->idcasos ?>" title="1">
                        <i class=" bi bi-pen"></i> Mudar para Activo
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item ae" href="#" id="<?= $casos->idcasos ?>" title="4">
                        <i class=" bi bi-pen"></i> Mudar para Recuperado
                      </a>
                    </li>

                  </ul>
                </div>
              </td>
            </tr>
          <?php

          } elseif ($casos->id_estado > 3) {
          ?>
            <tr class="row-user<?= $casos->idcasos ?> alert-success">
              <td><?= $casos->nome ?></td>

              <td><?= $casos->designacao_fase ?></td>
              <td><?= $casos->idade ?></td>
              <td scope="row"><?= $casos->genero ?></td>
              <td><?php if ($casos->id_estado > 3) {
                    print 'Recuperado';
                  } else {
                    print $casos->designacao_estado;
                  } ?>
              </td>
              <td><?= $casos->morada ?></td>
              <td><?= $casos->dia ?>/<?= $casos->mes ?>/<?= $casos->ano ?></td>
              <td>

                <div class="dropup">
                  <a class="btn border-0 btn-md dropdown-toggle text-dark" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                  </a>

                  <ul class="dropdown-menu rounded-0" aria-labelledby="dropdownMenuLink">
                    <li>
                      <a class="dropdown-item ae" href="#" id="<?= $casos->idcasos ?>" title="3">
                        <i class=" bi bi-pen"></i> Mudar para Morto
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item ae" href="#" id="<?= $casos->idcasos ?>" title="2">
                        <i class=" bi bi-pen"></i> Mudar para Risco
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item ae" href="#" id="<?= $casos->idcasos ?>" title="1">
                        <i class=" bi bi-pen"></i> Mudar para Activo
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item ae" href="#" id="<?= $casos->idcasos ?>" title="4">
                        <i class=" bi bi-pen"></i> Mudar para Recuperado
                      </a>
                    </li>

                  </ul>
                </div>
              </td>
            </tr>

          <?php
          } elseif ($casos->id_estado == 2) {
          ?>
            <tr class="row-user<?= $casos->idcasos ?> alert-warning">
              <td><?= $casos->nome ?></td>

              <td><?= $casos->designacao_fase ?></td>
              <td><?= $casos->idade ?></td>
              <td scope="row"><?= $casos->genero ?></td>
              <td><?php if ($casos->id_estado > 3) {
                    print 'Recuperado';
                  } else {
                    print $casos->designacao_estado;
                  } ?>
              </td>
              <td><?= $casos->morada ?></td>
              <td><?= $casos->dia ?>/<?= $casos->mes ?>/<?= $casos->ano ?></td>
              <td>

                <div class="dropup">
                  <a class="btn border-0 btn-md dropdown-toggle text-dark" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                  </a>

                  <ul class="dropdown-menu rounded-0" aria-labelledby="dropdownMenuLink">
                    <li>
                      <a class="dropdown-item ae" href="#" id="<?= $casos->idcasos ?>" title="3">
                        <i class=" bi bi-pen"></i> Mudar para Morto
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item ae" href="#" id="<?= $casos->idcasos ?>" title="2">
                        <i class=" bi bi-pen"></i> Mudar para Risco
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item ae" href="#" id="<?= $casos->idcasos ?>" title="1">
                        <i class=" bi bi-pen"></i> Mudar para Activo
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item ae" href="#" id="<?= $casos->idcasos ?>" title="4">
                        <i class=" bi bi-pen"></i> Mudar para Recuperado
                      </a>
                    </li>

                  </ul>
                </div>
              </td>
            </tr>

          <?php
          } else {
          ?>

            <tr class="row-user<?= $casos->idcasos ?>">

              <td><?= $casos->nome ?></td>

              <td><?= $casos->designacao_fase ?></td>
              <td><?= $casos->idade ?></td>
              <td scope="row"><?= $casos->genero ?></td>
              <td><?php if ($casos->id_estado > 3) {
                    print 'Recuperado';
                  } else {
                    print $casos->designacao_estado;
                  } ?>
              </td>
              <td><?= $casos->morada ?></td>
              <td><?= $casos->dia ?>/<?= $casos->mes ?>/<?= $casos->ano ?></td>
              <td>

                <div class="dropup">
                  <a class="btn border-0 btn-md dropdown-toggle text-dark" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                  </a>

                  <ul class="dropdown-menu rounded-0" aria-labelledby="dropdownMenuLink">
                    <li>
                      <a class="dropdown-item ae" href="#" id="<?= $casos->idcasos ?>" title="3">
                        <i class=" bi bi-pen"></i> Mudar para Morto
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item ae" href="#" id="<?= $casos->idcasos ?>" title="2">
                        <i class=" bi bi-pen"></i> Mudar para Risco
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item ae" href="#" id="<?= $casos->idcasos ?>" title="1">
                        <i class=" bi bi-pen"></i> Mudar para Activo
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item ae" href="#" id="<?= $casos->idcasos ?>" title="4">
                        <i class=" bi bi-pen"></i> Mudar para Recuperado
                      </a>
                    </li>

                  </ul>
                </div>
              </td>
            </tr>
  <?php }
        }
      endwhile;
    } catch (PDOException $e) {
      print $e->getMessage();
    }
  }
}



/* 
    # INSTANCIA DDa CLASS
 */

$casos = new Casos;


// SAVE TO BD

if (isset($_POST['acao']) && $_POST['acao'] == 'save') {
  session_start();
  require '../../env.php';

  $datas = array(
    'genero'         => htmlspecialchars(filter_input(INPUT_POST, 'genero')),
    'idade'          => htmlspecialchars(filter_input(INPUT_POST, 'idade')),
    'fase'           => htmlspecialchars(filter_input(INPUT_POST, 'fase')),
    'localidade'     => htmlspecialchars(filter_input(INPUT_POST, 'localidade')),
    'nacionalidade'  => htmlspecialchars(filter_input(INPUT_POST, 'nacionalidade')),
    'estado'         => htmlspecialchars(filter_input(INPUT_POST, 'estado')),
    'bairro'         => htmlspecialchars(filter_input(INPUT_POST, 'bairro')),
    'nome'            => htmlspecialchars(filter_input(INPUT_POST, 'nome')),
    'morada'            => htmlspecialchars(filter_input(INPUT_POST, 'morada')),

  );


  $casos->setGenero($datas['genero']);
  $casos->setFase($datas['fase']);
  $casos->setIdade($datas['idade']);
  $casos->setIdNacionalidade($datas['nacionalidade']);
  $casos->setEstado($datas['estado']);
  $casos->setIdLocalidade($datas['localidade']);
  $casos->setBairro($datas['bairro']);
  $casos->setNome($datas['nome']);
  $casos->setMorada($datas['morada']);

  /*  $casos->setDia($datas['dia']);
  $casos->setMes($datas['mes']);
  $casos->setAno($datas['ano']); */

  sleep(1.5);
  $casos->faseValidate($casos->getFase());
  $casos->generoValidate($casos->getGenero());
  $casos->estadoValidate($casos->getEstado());
  $casos->faseValidate($casos->getFase());
  $casos->localValidate($casos->getIdLocalidade());
  $casos->nacionalidadeValidate($casos->getIdNacionalidade());
  $casos->verficaLocalidade();
  $casos->nomeValidate($casos->getNome());
  /* $casos->diaValidate($casos->getDia());
  $casos->mesValidate($casos->getMes());
  $casos->anoValidate($casos->getAno()); */
  $send_log = $BD->query("INSERT INTO logs (designacao_log, id_funcionario, id_tipo_funcionario)
  VALUES('Registro de novo caso', '" . $_SESSION['idfuncionarios'] . "', '" . $_SESSION['id_tipo_funcionario'] . "')");
  $casos->save($BD);
}

// DELETE IN BD
if (isset($_GET['acao']) && $_GET['acao'] == 'delete') {
  session_start();
  require '../../env.php';

  $send_log = $BD->query("INSERT INTO logs (designacao_log, id_funcionario, id_tipo_funcionario)
  VALUES('Remoção de Funcionários na BD', '" . $_SESSION['idfuncionarios'] . "', '" . $_SESSION['id_tipo_funcionario'] . "')");
  $id = filter_input(INPUT_GET, 'id_user', FILTER_VALIDATE_INT);
  $casos->delete($BD, $id);
}

// GET PREVALENCIA
if (isset($_GET['acao']) && $_GET['acao'] == 'PI') {
  require '../../env.php';
  $casos->prevalencia($BD);
}

// GET Insidencia
if (isset($_GET['acao']) && $_GET['acao'] == 'II') {
  require '../../env.php';
  $casos->insidencia($BD);
}


//GRAFIC
if (isset($_GET['acao']) && $_GET['acao'] == 'grafico') {
  require '../../env.php';
  $casos->graficos($BD);
}
//GRAFIC
if (isset($_GET['acao']) && $_GET['acao'] == 'preve') {
  require '../../env.php';
  $casos->insidenciaPrevalencia($BD);
}
//VIEW
if (isset($_GET['acao']) && $_GET['acao'] == 'view') {
  require '../../env.php';
  $casos->index($BD);
  ?>

  <script>
    $(document).ready(function() {

      // ALterar estado para ae
      $(".ae").click(function() {
        var id_estado = $(this).attr('title')

        $.ajax({
          url: './assets/controllers/casos.php?acao=editar&id_caso=' + $(this).attr('id') + '&id_estado=' + id_estado,

        })
      })

    })
  </script>
  <?php
}

## ALTERAR 
if (isset($_GET['acao']) && $_GET['acao'] == 'editar') {
  require '../../env.php';
  $idCaso = $_GET['id_caso'];
  $id_estado = $_GET['id_estado'];
  $BD->query("SET FOREIGN_KEY_CHECKS = 0");
  $BD->query("UPDATE casos SET id_estado = '$id_estado' WHERE idcasos = '$idCaso'");
  $BD->query("SET FOREIGN_KEY_CHECKS = 1");

  session_start();
  $send_log = $BD->query("INSERT INTO logs (designacao_log, id_funcionario, id_tipo_funcionario)
  VALUES('Alteração dos estados dos casos', '" . $_SESSION['idfuncionarios'] . "', '" . $_SESSION['id_tipo_funcionario'] . "')");
}
## PSQUISAR 

if (isset($_GET['acao']) && $_GET['acao'] == 'query') {
  session_start();
  require '../../env.php';
  $query = $_GET['query'];
  $casos->findPaciente($BD, $query);
  $send_log = $BD->query("INSERT INTO logs (designacao_log, id_funcionario, id_tipo_funcionario)
      VALUES('Filtragem de Pacientes', '" . $_SESSION['idfuncionarios'] . "', '" . $_SESSION['id_tipo_funcionario'] . "')");
}

# ## comentar 

if (isset($_POST['acao']) && $_POST['acao'] == 'coment') {
  session_start();

  require '../../env.php';
  $coment = nl2br(htmlentities(filter_input(INPUT_POST, 'comentario', FILTER_SANITIZE_STRING)));
  $localidade = nl2br(htmlentities(filter_input(INPUT_POST, 'local', FILTER_SANITIZE_STRING)));
  $funcionario = nl2br(htmlentities(filter_input(INPUT_POST, 'funcionario', FILTER_SANITIZE_NUMBER_INT)));

  ## Verifica se já existe um comentário
  $checkComent = $BD->query("SELECT *FROM comentarios WHERE id_funcionario = '$funcionario'");
  if ($checkComent->rowCount() > 0) {
    # ## ATUALIZa CASO Já EXISTE
    $send = $BD->query("UPDATE comentarios SET comentario = '$coment' WHERE id_funcionario = '$funcionario'");
  } else {

    $send = $BD->query("INSERT INTO comentarios (comentario, local, id_funcionario)
    VALUES('$coment','$localidade','$funcionario')");
  }

  if ($send) {
    ## ENVIANDO UM LOG OU HISTORICO
    $send_log = $BD->query("INSERT INTO logs (designacao_log, id_funcionario, id_tipo_funcionario)
      VALUES('Adição de descrição dos casos', '" . $_SESSION['idfuncionarios'] . "', '" . $_SESSION['id_tipo_funcionario'] . "')");
    print 200;
  }
}

# ## INFO CASPS

if (isset($_GET['acao']) && $_GET['acao'] == 'info') {
  session_start();
  require '../../env.php';
  $id_func = $_SESSION['idfuncionarios'];

  $info = $BD->query("SELECT *FROM funcionarios INNER JOIN comentarios ON funcionarios.idfuncionarios = comentarios.id_funcionario ORDER BY comentarios.idcomentarios DESC");
  while ($dados = $info->fetch()) { ?>
    <div class="card-text">
      <div class="text-lead shadow-lg p-4">
        <h4 class="card-title">Casos em <?= $dados->local ?></h4>
        <hr>
        <?= $dados->comentario ?>
      </div>
      <div class="alert alert-light">
        <p>
          POR: <b> <?= $dados->nome_funcionario ?> </b>.
          DATA: <b> <?= $dados->data ?> </b>.
        </p>

      </div>
    </div>
    <hr>
<?php
  }
}
