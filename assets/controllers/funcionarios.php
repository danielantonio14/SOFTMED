<?php
/* 
  * ARQUIVO: funcionários.php
  * FUNÇÃO: FAZER O CRUD DOS FUNCIONÁRIOS
  * OBS : NÃO ALTERA QUAISQUER COISA SEM TERESNOÇÃO DO RESULTADO
 */
class Funcionarios
{
  private $nome, $email, $telefone, $id_localidade, $id_tipo_funcionario, $idfuncionarios, $table = 'funcionarios';
  private $foto;
  public $erros = null;

  # GETTS AND SETTRS

  public function setNome($d)
  {
    $this->nome = $d;
  }
  public function setEmail($d)
  {
    $this->email = $d;
  }
  public function setTelefone($d)
  {
    $this->telefone = $d;
  }
  public function setTipoFuncionario($d)
  {
    $this->id_tipo_funcionario = $d;
  }
  public function setSenha($d)
  {
    $this->id_localidade = $d;
  }

  public function setFoto($d)
  {
    $this->foto = $d;
  }

  public function setIdLocalidade($d)
  {
    $this->id_localidade = $d;
  }



  ## GETTRS
  public function getNome()
  {
    return $this->nome;
  }
  public function getEmail()
  {
    return $this->email;
  }
  public function getTelefone()
  {
    return $this->telefone;
  }
  public function getTipoFuncionario()
  {
    return $this->id_tipo_funcionario;
  }
  public function getSenha()
  {
    return $this->id_localidade;
  }

  public function getIdFuncionario()
  {
    return $this->idfuncionarios;
  }

  public function getFoto()
  {
    return $this->foto;
  }

  public function getIdLocalidade()
  {
    return $this->id_localidade;
  }

  ### VALIDATE DATA

  public function checkLogin($BD)
  {
    $check = $BD->query("SELECT *FROM {$this->table} WHERE email = '" . $this->getEmail() . "'");
    if ($check->rowCount() > 0) {
      $this->erros = 'O email inserido já está cadastrado.';
    }
  }

  public function nomeValidate($data)
  {
    if (!preg_match("/^[a-zA-ZáÁéÉíÍóÓúÚàÀèÈìÌòÒùÙãÃõÕâÂêÊîÎôÔûÛçÇ ]*$/", $data) || ltrim(strlen($data) < 8) || $data ==  "" || $data == null || empty($data)) {
      $this->erros = 'O nome inserido não é válido.';
    }
  }


  # Validar Número de telefone

  public function telefoneValidate($data)
  {
    if (!is_numeric($data) || !preg_match("/^[0-9]*$/", $data) || 9 > strlen($data) || 9 < strlen($data) || $data[0] != 9) {
      $this->erros = 'Número de  telefone inválido.';
    }
  }


  # Validar Categoria

  public function categoriaValidate($data)
  {
    if (is_null($data) || ltrim(empty($data)) || $data == "Categoria") {
      $this->erros = 'Informe a Categoria.';
    }
  }

  # Validdar E-mail

  public function emailValidate($data)
  {
    if (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
      $this->erros = 'O E-mail inserido não é válido';
    }
  }

  # FOTO

  public function uploadFoto($BD, $id)
  {
    session_start();
    if (isset($_SESSION['idfuncionarios']) && isset($_SESSION['id_tipo_funcionario'])) {
      if ($_SESSION['idfuncionarios'] == $id) {
        $arquivo = array(
          'arquivo'  => $this->getFoto()['name'],
          'temporal' => $this->getFoto()['tmp_name'],
          'tipo' => strtolower($this->getFoto()['type']),
          'formato'  => strtolower(pathinfo($this->getFoto()['name'], PATHINFO_EXTENSION)),
          'nome' => time() . '.' . strtolower(pathinfo($this->getFoto()['name'], PATHINFO_EXTENSION)),
          'diretorio' => '../images/funcionarios/'
        );

        $formatos_permitidos = array('image/jpg', 'image/png', 'image/jpeg', 'image/gif');

        # =========================== VERIFICA OS FORMATOS PERMITIDOS =====================
        if (in_array($arquivo['tipo'], $formatos_permitidos)) {

          # ========================= VERIFICA O DIRECTORIO =====================
          if (is_dir($arquivo['diretorio'])) {

            # ===================================== TENTA O UPLOAD ==================
            if (move_uploaded_file($arquivo['temporal'], $arquivo['diretorio'] . $arquivo['nome'])) {
              $this->foto = $arquivo['nome'];
            } else {
              $this->erros = 'Falha no upload da imagem.';
            }
          } else {
            mkdir($arquivo['diretorio']);
            move_uploaded_file($arquivo['temporal'], $arquivo['diretorio'] . $arquivo['nome']);
            $this->foto = $arquivo['nome'];
          }
        } else {
          $this->foto = null;
          $this->erros = 'Formato .' . $arquivo['formato'] . ' não é válido.';
        }

        // SAVE IN BD 
        if ($this->erros == null) {
          $f = $this->getFoto();
          $BD->query("UPDATE {$this->table} SET caminho_foto = '$f' WHERE idfuncionarios = '$id'");
          echo 200;
        } else {
          echo $this->erros;
        }
      }
    }
  }


  # ### SAVE TO DATA BASE 

  public function save($BD)
  {
    try {
      $query = "INSERT INTO {$this->table} (nome_funcionario,	email,	telefone,	senha,	id_tipo_funcionario, id_localidade)
      VALUES(?,?,?,?,?,?)";
      $inserir = $BD->prepare($query);
      $inserir->bindValue(1, $this->getNome());
      $inserir->bindValue(2, $this->getEmail());
      $inserir->bindValue(3, $this->getTelefone());
      $inserir->bindValue(4, $this->getSenha());
      $inserir->bindValue(5, $this->getTipoFuncionario());
      $inserir->bindValue(6, $this->getIdLocalidade());
      // $inserir->bindValue(6, $this->getFoto());

      if (isset($_SESSION['idfuncionarios']) && isset($_SESSION['id_tipo_funcionario'])) {
        if ($_SESSION['id_tipo_funcionario'] != 1) {
          $this->erros = 'Somente admnistradores podem realizar está operação';
        }
      }
      if ($this->erros == null) {
        $inserir->execute();
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
    try {
      $query = $BD->query("SELECT *FROM {$this->table} 
       INNER JOIN tipo_funcionarios
       ON funcionarios.id_tipo_funcionario = tipo_funcionarios.idtipo_funcionarios
      ORDER BY nome_funcionario
      ");
      while ($funcionario = $query->fetch()) : ?>
        <tr class="border-success row-user<?= $funcionario->idfuncionarios ?>">
          <td><?= $funcionario->idfuncionarios ?></td>
          <td scope="row"><?= $funcionario->nome_funcionario ?></td>
          <td><?= $funcionario->email ?></td>
          <td><?= $funcionario->telefone ?></td>
          <td><?= $funcionario->designacao_tipo ?></td>
          <td>
            <div class="dropup">
              <a class="btn border-0 btn-md dropdown-toggle text-dark" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">

              </a>

              <ul class="dropdown-menu rounded-0" aria-labelledby="dropdownMenuLink">

                <li>
                  <a class="dropdown-item" href="#">
                    <i class="bi-pen"></i> Editar
                  </a>
                </li>
                <li>
                  <a class="dropdown-item delete-user" href="#" id="<?= $funcionario->idfuncionarios ?>">
                    <i class="bi-trash3"></i> Remover
                  </a>
                  <?php

                  if ($funcionario->id_tipo_funcionario > 1 && $funcionario->permissao == 0) { ?>

                <li class="">
                  <a class="dropdown-item permission-user" href="#" title="<?= $funcionario->permissao ?>" id="<?= $funcionario->idfuncionarios ?>">
                    <i class="bi-unlock"></i> Adicionar Permissão
                  </a>
                </li>
              <?php } else if ($funcionario->id_tipo_funcionario > 1 && $funcionario->permissao == 1) { ?>

                <li>
                  <a class="dropdown-item permission-user" href="#" title="<?= $funcionario->permissao ?>" id="<?= $funcionario->idfuncionarios ?>">
                    <i class="bi-lock"></i> Remover Permissão
                  </a>
                </li>
              <?php } ?>



              <li>
                <a data-bs-toggle="modal" href="#modalAddFoto" role=" button" title="<?= $funcionario->idfuncionarios ?>" class="dropdown-item" onclick="adionarFoto(<?= $funcionario->idfuncionarios ?>)">
                  <i class=" bi-camera"></i> Adicionar Foto
                </a>
              </li>

              </ul>
            </div>
          </td>
        </tr>
      <?php endwhile;
    } catch (PDOException $e) {
      print $e->getMessage();
    }
  }

  # ## DELTE USER IN BD
  public function delete($BD, $id)
  {
    session_start();
    if (isset($_SESSION['idfuncionarios']) && isset($_SESSION['id_tipo_funcionario']) && $_SESSION['id_tipo_funcionario'] == 1) {
      if ($_SESSION['idfuncionarios'] == $id) {
        $BD->query("DELETE FROM {$this->table} WHERE idfuncionarios = '$id'");
        $foto = $BD->query("SELECT caminho_foto FROM {$this->table} WHERE  idfuncionarios = '$id'")->fetch()->caminho_foto;
        unlink('../images/./funcionarios/' . $foto);
        session_destroy();
        header('location:./login.php');
        echo '<script>window.location.href="./sair.php"</script>';
      } else {

        $BD->query("DELETE FROM {$this->table} WHERE idfuncionarios = '$id'");
        $foto = $BD->query("SELECT caminho_foto FROM {$this->table} WHERE  idfuncionarios = '$id'")->fetch()->caminho_foto;
        header('location:./login.php');
      }
    } else {
      print 201;
    }
  }

  # ## PERMISSÃO
  public function permissao($BD, $status, $id)
  {
    $BD->query("UPDATE {$this->table} SET permissao = '$status' WHERE idfuncionarios = '$id'");
  }

  # ## FIND USER
  public function find($BD, $query)
  {
    $query = $BD->query("SELECT *FROM {$this->table}  
    INNER JOIN tipo_funcionarios
    ON funcionarios.id_tipo_funcionario = tipo_funcionarios.idtipo_funcionarios 
    WHERE funcionarios.nome_funcionario LIKE '%$query%' OR funcionarios.telefone LIKE '%$query%'
    ORDER BY nome_funcionario
    ");
    if ($query->rowCount() <= 0) {
      print '<div class="text-danger text-center"><b>Sem resultados de pesquisa.</b> </div>';
    }
    while ($funcionario = $query->fetch()) :

      ?>
      <tr class="row-user<?= $funcionario->idfuncionarios ?>">
        <td><?= $funcionario->idfuncionarios ?></td>
        <td scope="row"><?= $funcionario->nome_funcionario ?></td>
        <td><?= $funcionario->email ?></td>
        <td><?= $funcionario->telefone ?></td>
        <td><?= $funcionario->designacao_tipo ?></td>
        <td>
          <div class="dropup">
            <a class="btn border-0 btn-md dropdown-toggle text-dark" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">

            </a>

            <ul class="dropdown-menu rounded-0" aria-labelledby="dropdownMenuLink">

              <li>
                <a class="dropdown-item" href="#">
                  <i class="bi-pen"></i> Editar
                </a>
              </li>
              <li>
                <a class="dropdown-item delete-user" href="#" id="<?= $funcionario->idfuncionarios ?>">
                  <i class="bi-trash3"></i> Remover
                </a>
                <?php

                if ($funcionario->id_tipo_funcionario > 1 && $funcionario->permissao == 0) { ?>

              <li class="">
                <a class="dropdown-item permission-user" href="#" title="<?= $funcionario->permissao ?>" id="<?= $funcionario->idfuncionarios ?>">
                  <i class="bi-unlock"></i> Adicionar Permissão
                </a>
              </li>
            <?php } else if ($funcionario->id_tipo_funcionario > 1 && $funcionario->permissao == 1) { ?>

              <li>
                <a class="dropdown-item permission-user" href="#" title="<?= $funcionario->permissao ?>" id="<?= $funcionario->idfuncionarios ?>">
                  <i class="bi-lock"></i> Remover Permissão
                </a>
              </li>
            <?php } ?>



            <li>
              <a data-bs-toggle="modal" href="#modalAddFoto" role=" button" title="<?= $funcionario->idfuncionarios ?>" class="dropdown-item" onclick="adionarFoto(<?= $funcionario->idfuncionarios ?>)">
                <i class=" bi-camera"></i> Adicionar Foto
              </a>
            </li>

            </ul>
          </div>
        </td>
      </tr>
    <?php endwhile; ?>


  <?php
  }

  ## VER DADOS NO PERFIL ADM
  public function show($BD)
  {

    try {
      if (isset($_SESSION['idfuncionarios'])) {
        $this->idfuncionarios = $_SESSION['idfuncionarios'];
      }
      $SELECT = "SELECT *FROM {$this->table} INNER JOIN localidades ON funcionarios.id_localidade = localidades.idlocalidades WHERE idfuncionarios =  '" . $this->getIdFuncionario() . "'";
      $query = $BD->query($SELECT)->fetch();
      $this->nome = $query->nome_funcionario;
      $this->id_tipo_funcionario = $query->id_tipo_funcionario;
      $this->id_localidade = $query->designacao_localidade;
      if ($this->getTipoFuncionario() == 1) {
        $this->id_tipo_funcionario = 'Administrador';
      } else {
        $this->id_tipo_funcionario = 'Analista clínico';
      }

      if (empty($query->caminho_foto)) {
        $this->foto = './assets/./images/adm.png';
      } else {
        $this->foto = './assets/./images/funcionarios/' . $query->caminho_foto;
      }
    } catch (PDOException $th) {
      //throw $th;
    }
  }
}



/* 
    # INSTANCIA DDa CLASS
 */

$funcionario = new Funcionarios;

// SAVE TO BD

if (isset($_POST['acao']) && $_POST['acao'] == 'save') {
  session_start();
  require '../../env.php';

  $datas = array(
    'nome'         => htmlspecialchars(filter_input(INPUT_POST, 'nome')),
    'telefone'     => htmlspecialchars(filter_input(INPUT_POST, 'telefone')),
    'email'        => htmlspecialchars(filter_input(INPUT_POST, 'email')),
    'senha'        => md5(filter_input(INPUT_POST, 'senha')),
    'categoria'    => htmlspecialchars(filter_input(INPUT_POST, 'tipo_funcionario')),
    'localidades'    => htmlspecialchars(filter_input(INPUT_POST, 'loc'))
  );


  $funcionario->setNome($datas['nome']);
  $funcionario->setEmail($datas['email']);
  $funcionario->setTelefone($datas['telefone']);
  $funcionario->setTipoFuncionario($datas['categoria']);
  $funcionario->setSenha($datas['senha']);
  $funcionario->setIdLocalidade($datas['localidades']);

  $funcionario->nomeValidate($datas['nome']);
  $funcionario->emailValidate($datas['email']);
  $funcionario->telefoneValidate($datas['telefone']);
  $funcionario->checkLogin($BD);

  $funcionario->categoriaValidate($datas['categoria']);

  sleep(1.5);
  $funcionario->save($BD);
  $BD->query("INSERT INTO logs (designacao_log, id_funcionario, id_tipo_funcionario)
  VALUES('Cadastrou-se usuário na BD.', '" . $_SESSION['idfuncionarios'] . "', '" . $_SESSION['id_tipo_funcionario'] . "')");
}

// DELETE IN BD
if (isset($_GET['acao']) && $_GET['acao'] == 'delete') {
  session_start();
  require '../../env.php';
  $id = filter_input(INPUT_GET, 'id_user', FILTER_VALIDATE_INT);
  $funcionario->delete($BD, $id);

  $BD->query("INSERT INTO logs (designacao_log, id_funcionario, id_tipo_funcionario)
  VALUES('Remoção de usuário.', '" . $_SESSION['idfuncionarios'] . "', '" . $_SESSION['id_tipo_funcionario'] . "')");
}
// ADD PERMISSION
if (isset($_GET['acao']) && $_GET['acao'] == 'permision') {
  session_start();
  require '../../env.php';
  $id = filter_input(INPUT_GET, 'query', FILTER_VALIDATE_INT);
  $status = filter_input(INPUT_GET, 'status', FILTER_VALIDATE_INT);
  if ($status <= 0) {
    $status = 1;
    $BD->query("INSERT INTO logs (designacao_log, id_funcionario, id_tipo_funcionario)
  VALUES('Adição de permissão de usuário.', '" . $_SESSION['idfuncionarios'] . "', '" . $_SESSION['id_tipo_funcionario'] . "')");
  } else {
    $status = 0;
    $BD->query("INSERT INTO logs (designacao_log, id_funcionario, id_tipo_funcionario)
  VALUES('Remoção de permissão de usuário.', '" . $_SESSION['idfuncionarios'] . "', '" . $_SESSION['id_tipo_funcionario'] . "')");
  }
  $funcionario->permissao($BD, $status, $id);
}

// SAVE IMG IN BD
if (isset($_POST['acao']) && $_POST['acao'] == 'foto') {
  session_start();
  require '../../env.php';
  $funcionario->setFoto($_FILES['foto_usuario']);
  $id = $_POST['id_funcionario'];
  $funcionario->uploadFoto($BD, $id);
  $send_log = $BD->query("INSERT INTO logs (designacao_log, id_funcionario, id_tipo_funcionario)
  VALUES('Foto do funcionário adicionado', '" . $_SESSION['idfuncionarios'] . "', '" . $_SESSION['id_tipo_funcionario'] . "')");
}

// FIND IN BD
if (isset($_GET['acao']) && $_GET['acao'] == 'query') {
  session_start();
  require '../../env.php';
  $query = filter_input(INPUT_GET, 'query');

  $funcionario->find($BD, $query); ?>
  <script>
    $(document).ready(function() {
      // 2 - DELETE
      $('.delete-user').click(function(e) {
        e.preventDefault()
        $.ajax({
          url: './assets/controllers/funcionarios.php?acao=delete&id_user=' + $(this).attr('id'),
          success: (data) => {
            $('.row-user' + $(this).attr('id'))
              .addClass('alert-danger')
              .fadeOut('3500')
          }

        })
      })

    })
  </script>
<?php

  $BD->query("INSERT INTO logs (designacao_log, id_funcionario, id_tipo_funcionario)
  VALUES('Filtragem de funcionários.', '" . $_SESSION['idfuncionarios'] . "', '" . $_SESSION['id_tipo_funcionario'] . "')");
}
