<?php
//arquivo que abre a conexão com o banco
class conexao
{
  public $username, $servername, $password, $ligar; // pega os requisitos para a conexão
  public function conexao()
  {
    try {

      //atribui ou guardar as credecnias do banco numa variavel
      $this->username = 'root';
      $this->servername = 'localhost';
      $this->password = '';
      // tenta realizar a conexão
      $this->ligar = new PDO("mysql:host=" . $this->servername . ";dbname=softmed", $this->username, $this->password);
      $this->ligar->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
      $this->ligar->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      //echo "Sucesso na conexão";
    } catch (PDOException $e) {
      echo "Erro na conexão: " . $e->getMessage();
      // falha de conexão
    }
  }
}

// cria um objecto
$query = new conexao;
$query->conexao();
// cria uníca instância para as requisições
$BD = $query->ligar;
