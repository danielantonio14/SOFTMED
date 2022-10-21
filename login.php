<?php
session_start();
if (isset($_SESSION['idfuncionarios']) && $_SESSION['idfuncionarios'] >= 1) {
  header('location:./');
}
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

  <link rel="stylesheet" href="./assets/css/padrao.css">


  <title>LOGIN | SOFTMED</title>

  <style>
    body {
      background: url(./assets/images/./12.jpg);
      background-position: center center;
      background-size: cover;
      background-repeat: repeat-y;
      /* filter: blur(1px); */

    }

    .login {

      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }

    .login .caixa {
      width: 400px;
      background: none;
    }
  </style>
</head>

<body>

  <div class="container rounded rounded-6">
    <div class="card text-white fundo-rgb-preto border-0 d-flex justify-content-center align-content-center align-items-center login rounded rounded-5">
      <div class="card-body bg-grey caixa rounded rounded-6">
        <div class="card-header bg-transparent">
          <h4 class="card-title text-muted bg-transparent"><b>LOGIN</b></h4>
        </div>
        <form action="" id="form_login">
          <div class="mb-3">
            <label for="email" class="form-label text-muted">E-MAIL</label>
            <input type="mail" name="email_login" id="email_login" class="form-control rounded-0 form-control-lg" placeholder="seuemail@provedor.com" aria-describedby="helpId" required>
          </div>
          <div class="mb-3">
            <label for="senha" class="form-label text-muted">PALAVRA-PASSE</label>
            <input type="password" class="form-control rounded form-control-lg" name="senha_login" id="senha_login" placeholder="******************" required>
          </div>

          <div class="text-center">

            <small class="response mb-3 mb-3 d-block"></small>

            <button type="reset" class="btn btn-sm bg-dark text-white" id="btn-reset">Limpo</button>
            <button type="submit" class="btn btn-sm btn-success text-white">Entrar</button>
            <input type="hidden" name="acao" value="login">

          </div>
        </form>
      </div>
    </div>
  </div>




  <script src="./pugins/jquery.js"></script>
  <script src="./assets/vendor/bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
  <script src="./assets/vendor/bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>

  <script>
    $(document).ready(function() {
      $("#btn-reset").click()
      $("#form_login").submit((e) => {
        e.preventDefault()

        $.ajax({
          url: './assets/./controllers/./login.php',
          method: 'POST',
          data: $('#form_login').serialize(),
          beforeSend: () => {
            $('.response').html('<img src="./assets/./images/./ajax-loader.gif">')
          },
          error: () => {
            $('.response').html('<div class="alert alert-danger">Algo deu errado.</div>')
          },
          success: (response) => {
            if (response == 200) {
              $('.response').html('<div class="alert alert-success">Login efetuado, aguarde...</div>')
              setTimeout(() => {
                location.href = "./"
              }, 3000)
            } else {
              $('.response').html('<div class="alert alert-danger">' + response + '</d>')
            }
          }
        })
      })
    })
  </script>


</body>

</html>