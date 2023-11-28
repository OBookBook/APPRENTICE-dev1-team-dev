<?php
require_once(__DIR__ . '/header.php');
require_once(__DIR__ . '/footer.php');
getHeader();
?>

<main>
    <h1>デイリポ！</h1>

    <?php
    require_once './../classes/Database.php';

    $database = new Database();
    $conn = $database->connect();
    if ($conn) {
        echo "データベースに接続しました。";
        echo "接続が成功したらクエリを実行したり他の処理を行います";

        $database->disconnect();
    } else {
    }
    ?>

    <h3>実績 ※ </h3>
    <div id="js-capture">
        <h1>📅 日付:11 月 26 日(日)</h1>
        <p>⌚ 学習時間 10 時間</p>
        <ul>
            <li>✅ AtCoder Problems ABC317 : C 問題 (完了)</li>
            <li>✅ QUEST 24 : ブラウザの仕組みを説明できる(advanced) (完了)</li>
            <li>✅ 技術記事 : Web ブラウザの仕組み (提出完了)</li>
            <li>✅ 提出クエスト : React+TypeScript 実装 (完了)</li>
            <li>✅ チーム開発準備 Docker : Xdebug 環境構築 (完了)</li>
            <li>✅ 本 : これからはじめる React 実践入門</li>
            <p>【明日】AtCoder、チーム開発実装!!</p>
        </ul>
        <div id="js-capture-btn">
            <button onclick="screenshot()">スクリーンショットを取得</button>
        </div>
    </div>

</main>

<?php getFooter(); ?>
