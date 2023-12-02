<?php

class ConnectionToSql
{
  private $dbHost;
  private $dbUser;
  private $dbPassword;
  private $dbDatabase;

  public function __construct()
  {
    require __DIR__ . '/../../../vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../../../");
    $dotenv->load();

    $this->dbHost = $_ENV['MYSQL_HOST'];
    $this->dbUser = $_ENV['MYSQL_USER'];
    $this->dbPassword = $_ENV['MYSQL_ROOT_PASSWORD'];
    $this->dbDatabase = $_ENV['MYSQL_DATABASE'];
  }

  public function connectSql()
  {
    $dbn = "mysql:host={$this->dbHost};dbname={$this->dbDatabase}";
    try {
      $dbh = new PDO($dbn, $this->dbUser, $this->dbPassword);
      return $dbh;
    } catch (PDOException $e) {
      echo "データベースの接続に失敗しました" . $e->getMessage();
      die();
    }
  }
}
