<?php
require './../../../vendor/autoload.php';

class Database
{
    private string $host;        // Dockerコンテナ内でのMySQLのホスト名（コンテナ名）
    private string $dbname;      // MySQLで作成したデータベース名
    private string $username;    // MySQLで作成したユーザー名
    private string $password;    // MySQLで設定したパスワード
    private  $isConnected;       // 接続を保持するために使用

    public function __construct()
    {
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../../../");
        $dotenv->load();

        $this->host = $_ENV['MYSQL_HOST'];
        $this->dbname = $_ENV['MYSQL_DATABASE'];
        $this->username = $_ENV['MYSQL_USER'];
        $this->password = $_ENV['MYSQL_ROOT_PASSWORD'];
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
