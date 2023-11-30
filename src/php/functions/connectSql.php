<?php

require __DIR__ . '/../../../vendor/autoload.php';

function connectSql()
{
  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../../../");
  $dotenv->load();

  $dbHost = $_ENV['MYSQL_HOST'];
  $dbUser = $_ENV['MYSQL_USER'];
  $dbPassword = $_ENV['MYSQL_ROOT_PASSWORD'];
  $dbDatabase = $_ENV['MYSQL_DATABASE'];
  $dbn = "mysql:host=$dbHost;dbname=$dbDatabase";

  try {
    $dbh = new PDO($dbn, $dbUser, $dbPassword);
    return $dbh;
  } catch (PDOException $e) {
    echo "データベースの接続に失敗しました" . $e->getMessage();
    die();
  }
}
