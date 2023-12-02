<?php
require './../../../vendor/autoload.php';

/**
 * OpenAIを使用してテキスト生成を行うクラス
 */
class ChatGPT
{
    /** @var string OpenAI APIキー */
    private string $apiKey;

    /** @var string OpenAIのエンドポイント */
    private string $apiEndpoint;

    public function __construct()
    {
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../../../");
        $dotenv->load();

        $this->apiKey = $_ENV['OPEN_AI_API_KEY'];
        $this->apiEndpoint = $_ENV['OPEN_AI_API_ENDPOINT'];
    }

    /**
     * テキスト生成メソッド
     *
     * @param string $prompt テキスト生成のためのプロンプト
     * @param int $maxTokens 最大トークン数
     * @return string 生成されたテキスト
     */
    public function generateText($prompt)
    {
        // リクエストデータ
        $data = array(
            'prompt' => $prompt,
            'max_tokens' => 30
        );

        // JSON形式に変換
        $postData = json_encode($data);

        // cURLリクエストの作成
        $ch = curl_init($this->apiEndpoint);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->apiKey
        ));

        // APIリクエストの送信
        $response = curl_exec($ch);
        curl_close($ch);

        echo ($response);

        // レスポンスのデコード
        $responseData = json_decode($response, true);

        // テキスト部分を取得
        $text = $responseData['choices'][0]['text'];

        return $text;
    }
}
