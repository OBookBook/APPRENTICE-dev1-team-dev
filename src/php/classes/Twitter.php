<?php
require './../../../vendor/autoload.php';
require_once './../constants.php';

use Abraham\TwitterOAuth\TwitterOAuth;
use Abraham\TwitterOAuth\TwitterOAuthException;

/**
 * Twitter APIとやり取りしてツイートを投稿するためのクラスです。
 */
class Twitter
{
    private string $api_key = API_KEY;
    private string $api_key_secret = API_KEY_SECRET;
    private string $access_token = ACCESS_TOKEN;
    private string $access_token_secret = ACCESS_TOKEN_SECRET;
    private TwitterOAuth $twitterClient;

    public function __construct()
    {
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
