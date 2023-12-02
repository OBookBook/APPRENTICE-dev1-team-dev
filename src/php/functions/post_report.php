<?php
require_once './../classes/Database.php';
require_once './../classes/ChatGPT.php';

$data = json_decode(file_get_contents('php://input'), true);
$userId = $data['userId'];
$reflectionComment = $data['reflectionComment'];
$studyHours = $data['studyHours'];

try {
    insertReport($userId, $reflectionComment, $studyHours);
    http_response_code(200);
} catch (Exception $e) {
    http_response_code(500);
    echo "エラー: " . $e->getMessage();
}

function insertReport($userId, $reflectionComment, $studyHours)
{
    $db = new Database();
    $conn = $db->connect();

    $generator = new ChatGPT();
    $res = $generator->generateText($reflectionComment);
    $res_trimed = trim($res);
    $aiComment = preg_replace('/\s+/', ' ', $res_trimed);

    // $aiComment = "ダミー";

    $stmt = $conn->prepare("INSERT INTO reports (user_id, reflection_comment, ai_comment, submitted_date, study_hours) VALUES (:userId, :reflectionComment, :aiComment, CURDATE(), :studyHours)");
    $stmt->bindParam(':userId', $userId);
    $stmt->bindParam(':reflectionComment', $reflectionComment);
    $stmt->bindParam(':aiComment', $aiComment);
    $stmt->bindParam(':studyHours', $studyHours);
    $stmt->execute();

    $db->disconnect();
}
