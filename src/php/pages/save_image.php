<?php

require_once './../classes/ImageSaver.php';

$imageSaver = new ImageSaver();
$imgData = $_POST['imgData'];
$filename = $imageSaver->saveImage($imgData);

http_response_code(200);
$response = ['message' => '画像を保存しました', 'filename' => $filename];

echo json_encode($response);
