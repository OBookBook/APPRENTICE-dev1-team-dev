<?php

require_once './../classes/ImageSaver.php';

$imageSaver = new ImageSaver();
$imgData = $_POST['imgData'];
$filename = $imageSaver->saveImage($imgData);

// Todo $_POST['imgData'];からコメントを取得して、twitterAPIでつぶやく
http_response_code(200);
$response = ['message' => '画像を保存しました', 'filename' => $filename];

echo json_encode($response);
