<?php
require_once './../classes/Twitter.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 本当だったら$_POSTバリデーションしないといけないけどしてないんですよね。。。
    $twitterPoster = new Twitter();
    $twitterPoster->tweet($_POST['tweet']);
    http_response_code(200);
}
