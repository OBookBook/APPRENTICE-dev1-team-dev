<?php

function connectSql()
{
  $dbHost = 'mysql';
  $dbUser = 'db_user';
  $dbPassword = 'keep_up';
  $dbDatabase = 'daily_report';
  $dbn = "mysql:host=$dbHost;dbname=$dbDatabase";

  try {
    $dbh = new PDO($dbn, $dbUser, $dbPassword);
    return $dbh;
  } catch (PDOException $e) {
    echo "データベースの接続に失敗しました" . $e->getMessage();
    die();
  }
}
