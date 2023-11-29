<?php
require_once './../constants.php';

class Database
{
    private string $host;        // Dockerコンテナ内でのMySQLのホスト名（コンテナ名）
    private string $dbname;      // MySQLで作成したデータベース名
    private string $username;    // MySQLで作成したユーザー名
    private string $password;    // MySQLで設定したパスワード
    private  $isConnected;       // 接続を保持するために使用

    public function __construct()
    {
        $this->host = DB_HOST;
        $this->dbname = DB_NAME;
        $this->username = DB_USER;
        $this->password = DB_PASS;
    }

    /**
     * データベースに接続する
     * @return PDO|null  データベース接続オブジェクトまたはnull
     * @throws Exception データベースに接続できなかった場合に例外をスローする
     */
    public function connect(): ?PDO
    {
        try {
            $this->isConnected = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
            $this->isConnected->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->isConnected;
        } catch (PDOException $e) {
            throw new Exception("データベースに接続できませんでした: " . $e->getMessage());
        }
    }

    /**
     * データベース接続を閉じる
     */
    public function disconnect(): void
    {
        $this->isConnected = null;
    }
}
