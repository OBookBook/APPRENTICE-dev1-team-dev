<?php

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
            require_once(__DIR__ . '/../functions/ConnectionToSql.php');
            $connectionToSql = new ConnectionToSql();
            $dbh = $connectionToSql->connectSql();
            // 仮に user_id が 1 のユーザーとして実装
            $userId = 1;
            // クエリの実行
            $query = "SELECT user_name FROM users WHERE user_id = $userId";
            $stmt = $dbh->query($query);
            // 表示処理
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              echo $row["user_name"];
            }
            // 接続を閉じる
            $dbh = null;
            ?>
          </div>
        </div>
      </div>
    </header>

  <?php
}
  ?>