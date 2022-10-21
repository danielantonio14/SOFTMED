<?php
session_start();
class Login
{

  private $senha, $id;
  private $login;
  private $table = 'funcionarios';
  public $erros = null;

  public function setSenha($n)
  {
    $this->senha = $n;
  }
  public function setLogin($n)
  {
    $this->login = $n;
  }

  public function getSenha()
  {
    return $this->senha;
  }
  public function getEmail()
  {
    return $this->login;
  }
  public function getId()
  {
    return $this->id;
  }

  # VALIDADE SENHA 

  public function vSenha()
  {
    if ($this->getSenha() == "" || empty($this->getSenha()) || ltrim(strlen($this->getSenha()) <= 0)) {
      $this->erros = "Senha incorreta.";
    }
  }

  # CHECK LOGIN OR MAIL
  # CHECK LOGIN OR MAIL

  public function chekLoginOrMail($BD)
  {
    $checkMail = "SELECT email FROM {$this->table} WHERE email = '" . $this->getEmail() . "'";
    $checkPass = "SELECT senha FROM {$this->table} WHERE senha= '" . $this->getSenha() . "'";

    try {

      $query_email = $BD->query($checkMail);
      $row = $query_email->rowCount();

      if ($row > 0) { // verifica email

        $query_pass = $BD->query($checkPass);
        $row = $query_pass->rowCount();

        if ($row > 0) { // verifica senha

          // VERIFICA A PERMISAO e TIPO USUARIO
          $checkUsuarioTipo = $BD->query("SELECT id_tipo_funcionario FROM {$this->table} WHERE email = '" . $this->getEmail() . "'");
          $checkPermission = $BD->query("SELECT permissao FROM {$this->table} WHERE email = '" . $this->getEmail() . "'");
          if ($checkUsuarioTipo->fetch()->id_tipo_funcionario > 1) {

            if ($checkPermission->fetch()->permissao <= 0) {
              $this->erros = 'Acesso negado.<br>Não tem permissão para acessar o sistema.';
            } else {

              print 200;
            }
          } else {
            print 200;
          }
        } else {
          $this->erros = 'A senha inserida esta incorreta.';
        }
      } else {
        $this->erros = 'O e-mail inserido está incorreto.';
      }
    } catch (PDOException $e) {
      print $e->getMessage();
    }
  }

  # CRIANDO LOGIN
  public function createLogin($BD)
  {
    # verfifica se existe algum erro

    if ($this->erros == null) {

      // CRIANDO UMA SESSÃO

      $session = $BD->query("SELECT idfuncionarios FROM {$this->table} WHERE email = '" . $this->getEmail() . "'");
      $sessionN = $BD->query("SELECT id_tipo_funcionario FROM {$this->table} WHERE email = '" . $this->getEmail() . "'");
      $sessionL = $BD->query("SELECT id_localidade FROM {$this->table} WHERE email = '" . $this->getEmail() . "'");
      $_SESSION['idfuncionarios'] = $session->fetch()->idfuncionarios;
      $_SESSION['id_tipo_funcionario'] = $sessionN->fetch()->id_tipo_funcionario;
      $_SESSION['id_localidade'] = $sessionL->fetch()->id_localidade;
      $this->id = $_SESSION['idfuncionarios'];

      ## ENVIANDO UM LOG OU HISTORICO
      $send_log = $BD->query("INSERT INTO logs (designacao_log, id_funcionario, id_tipo_funcionario)
      VALUES('Acesso ao sitema', '" . $_SESSION['idfuncionarios'] . "', '" . $_SESSION['id_tipo_funcionario'] . "')");
    } else {
      print $this->erros;
    }
  }
}

# INSTANCIA

if (isset($_POST['acao']) && $_POST['acao'] == 'login') {

  $login = new Login;

  require '../../env.php';

  $login->setLogin(filter_input(INPUT_POST, 'email_login', FILTER_SANITIZE_EMAIL));
  $login->setSenha(md5(filter_input(INPUT_POST, 'senha_login')));

  sleep(1.5);
  $login->chekLoginOrMail($BD);
  $login->vSenha();
  $login->createLogin($BD);
}

if (isset($_GET['logout'])) {
  session_start();
  session_destroy();
  header('location:../login.php');
}
