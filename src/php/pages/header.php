<?php

namespace PHP\PAGES\HEADER;

use mysqli;
use RuntimeException;
use PDO;

phpinfo();
function getHeader()
{
?>

  <!DOCTYPE html>
  <html lang="ja">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>デイリポ</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../../css/style.css">
  </head>

  <body>
    <header>
      <h1><a href="index.php"><img src="../../img/logo.png" alt="デイリポ"></a></h1>
      <div class="header-right">
        <nav>
          <ul>
            <li><a href="#">アカウント設定</a></li>
            <li><a href="#">ログアウト</a></li>
          </ul>
        </nav>
        <div class="user-wrapper">
          <span class="material-symbols-outlined">
            person
          </span>
          <div>
            <?php
            $dbHost = 'db';
            $dbUsername = 'db_user';
            $dbPassword = 'keep_up';
            $dbDatabase = 'daily_report';
            echo $dbHost . $dbUsername . $dbPassword . $dbDatabase;
            $mysqli = new PDO('db', 'db_user', 'keep_up');
            // $mysqli = new mysqli('db', 'db_user', 'keep_up', 'daily_report');
            // if ($mysqli->connect_error) {
            //   throw new RuntimeException('MySQL接続エラー:' . $mysqli->connect_error);
            // }
            // $dsn      = 'mysql:dbname=db_name;host=localhost';
            // $user     = 'user_name';
            // $password = 'password';

            // // DBへ接続
            // try {
            //   $dbh = new PDO($dbHost, $dbUsername, $dbPassword);

            //   // クエリの実行
            //   $query = "SELECT * FROM TABLE_NAME";
            //   $stmt = $dbh->query($query);

            //   // 表示処理
            //   while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            //     echo $row["name"];
            //   }
            // } catch (PDOException $e) {
            //   print("データベースの接続に失敗しました" . $e->getMessage());
            //   die();
            // }

            // // 接続を閉じる
            // $dbh = null;
            ?>
          </div>
        </div>
      </div>
    </header>

  <?php
}
getHeader();
  ?>