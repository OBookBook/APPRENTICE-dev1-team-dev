<?php
require_once './../constants.php';
require_once './../classes/Database.php';

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
    // TODO: ダミーデータを作成してai_commentに挿入する 実装次第chatGPTのoutputに変更
    $dummyAIComment = 'AIによるコメントはまだ利用できません。';
    $db = new Database();
    $conn = $db->connect();

    $stmt = $conn->prepare("INSERT INTO reports (user_id, reflection_comment, ai_comment, submitted_date, study_hours) VALUES (:userId, :reflectionComment, :aiComment, CURDATE(), :studyHours)");
    $stmt->bindParam(':userId', $userId);
    $stmt->bindParam(':reflectionComment', $reflectionComment);
    $stmt->bindParam(':aiComment', $dummyAIComment);
    $stmt->bindParam(':studyHours', $studyHours);
    $stmt->execute();

    $db->disconnect();
}
