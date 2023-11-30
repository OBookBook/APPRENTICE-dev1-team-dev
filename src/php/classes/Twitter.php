<?php
require './../../../vendor/autoload.php';

// require_once './../constants.php';

use Abraham\TwitterOAuth\TwitterOAuth;
use Abraham\TwitterOAuth\TwitterOAuthException;

/**
 * Twitter APIとやり取りしてツイートを投稿するためのクラスです。
 */
class Twitter
{
    private string $api_key;
    private string $api_key_secret;
    private string $access_token;
    private string $access_token_secret;
    private TwitterOAuth $twitterClient;

    public function __construct()
    {
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../../../");
        $dotenv->load();

        $this->api_key = $_ENV['X_API_KEY'];
        $this->api_key_secret = $_ENV['API_KEY_SECRET'];
        $this->access_token = $_ENV['ACCESS_TOKEN'];
        $this->access_token_secret = $_ENV['ACCESS_TOKEN_SECRET'];

        $this->twitterClient = new TwitterOAuth($this->api_key, $this->api_key_secret, $this->access_token, $this->access_token_secret);
        $this->twitterClient->setApiVersion('2');
    }

    /**
     * ツイートを投稿します。
     *
     * @param string $tweetMessage ツイートするメッセージ。
     * @return void
     */
    public function tweet(string $tweetMessage): void
    {
        try {
            $this->twitterClient->post('tweets', ['text' => $tweetMessage], true);
        } catch (TwitterOAuthException $e) {
            echo 'エラー: ' . $e->getMessage();
            echo 'エラーコード: ' . $this->twitterClient->getLastHttpCode();
        }
    }
}
