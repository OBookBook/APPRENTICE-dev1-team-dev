<?php

// OpenAI APIキー
$apiKey = '';

// OpenAIのエンドポイント
// $apiEndpoint = 'https://api.openai.com/v1/chat/completions';
$apiEndpoint = 'https://api.openai.com/v1/engines/text-davinci-001/completions';

// リクエストデータ
$data = array(
    'prompt' => '5文字以内で元気がでる言葉を下さい',
    'max_tokens' => 30
);

// JSON形式に変換
$postData = json_encode($data);

// cURLリクエストの作成
$ch = curl_init($apiEndpoint);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Authorization: Bearer ' . $apiKey
));

// APIリクエストの送信
$response = curl_exec($ch);
curl_close($ch);

// レスポンスの表示
echo $response;
