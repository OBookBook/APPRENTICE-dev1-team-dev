<?php
require_once './../classes/Database.php';
require_once './../classes/ChatGPT.php';

/**
 * データベース内のレポートの挿入および更新を処理します。
 */
class ReportInserter
{
    private $userId;
    private $reflectionComment;
    private $studyHours;
    private $submittedDate;
    private $db;
    private $conn;

    /**
     * ReportInserter コンストラクタ
     *
     * @param array $data ユーザーID、リフレクションコメント、勉強時間、提出日を含むデータ
     */
    public function __construct($data)
    {
        $this->userId = $data['userId'];
        $this->reflectionComment = $data['reflectionComment'];
        $this->studyHours = $data['studyHours'];
        $this->submittedDate = $data['submittedDate'];

        $this->db = new Database();
        $this->conn = $this->db->connect();
    }

    /**
     * レポートを保存し、今日のレポートが存在する場合は更新します。
     */
    public function saveReport()
    {
        try {
            $reports = $this->getTodaysReports();
            if (empty($reports)) {
                $aiComment = $this->generateAIComment($this->reflectionComment); // AIコメントの生成
                $this->insertIntoDatabase($aiComment); // 登録
            } else {
                $this->updateReportComments($reports[0]["report_id"], $this->reflectionComment); // 更新
            }
            http_response_code(200);
        } catch (Exception $e) {
            http_response_code(500);
            echo "エラー: " . $e->getMessage();
        }
    }
    /**
     * データベースに新しいレポートを挿入します。
     *
     * @param string $aiComment AIによって生成されたコメント
     */
    private function insertIntoDatabase($aiComment)
    {
        $stmt = $this->conn->prepare("INSERT INTO reports (user_id, reflection_comment, ai_comment, submitted_date, study_hours) VALUES (:userId, :reflectionComment, :aiComment, :submittedDate, :studyHours)");
        $stmt->bindParam(':userId', $this->userId);
        $stmt->bindParam(':reflectionComment', $this->reflectionComment);
        $stmt->bindParam(':aiComment', $aiComment);
        $stmt->bindParam(':submittedDate', $this->submittedDate);
        $stmt->bindParam(':studyHours', $this->studyHours);
        $stmt->execute();
    }

    /**
     * 今日のレポートをデータベースから取得します。
     *
     * @return array 今日のレポート
     */
    private function getTodaysReports()
    {
        $conn = $this->db->connect();

        $stmt = $conn->prepare("SELECT * FROM reports WHERE user_id = :userId AND submitted_date = :submittedDate");
        $stmt->bindParam(':userId', $this->userId);
        $stmt->bindParam(':submittedDate', $this->submittedDate);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->db->disconnect();

        return $result;
    }

    /**
     * レポートコメントをデータベースで更新します。
     *
     * @param int    $reportId          レポートID
     * @param string $reflectionComment リフレクションコメント
     */
    private function updateReportComments($reportId, $reflectionComment)
    {
        $aiComment = $this->generateAIComment($reflectionComment); // AIコメントの再生成

        $stmt = $this->conn->prepare("UPDATE reports SET reflection_comment = :reflectionComment, ai_comment = :aiComment WHERE report_id = :reportId");
        $stmt->bindParam(':reportId', $reportId);
        $stmt->bindParam(':reflectionComment', $reflectionComment);
        $stmt->bindParam(':aiComment', $aiComment);
        $stmt->execute();
        http_response_code(200);
    }

    /**
     * 提供されたコメントに基づいてAIコメントを生成します。
     *
     * @param string $comment 元のコメント
     *
     * @return string AIによって生成されたコメント
     */
    private function generateAIComment($comment)
    {
        $generator = new ChatGPT();
        $res = $generator->generateText($comment);
        $res_trimmed = trim($res);
        return preg_replace('/\s+/', ' ', $res_trimmed);
    }
}

$data = json_decode(file_get_contents('php://input'), true);

$reportInserter = new ReportInserter($data);
$reportInserter->saveReport();
