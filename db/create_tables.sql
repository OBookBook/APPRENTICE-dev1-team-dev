USE daily_report;

-- ユーザーテーブル
CREATE TABLE users (
    user_id            BIGINT (20)              PRIMARY KEY  AUTO_INCREMENT,
    user_name          VARCHAR(255)             NOT NULL    UNIQUE,
    password           VARCHAR(30)              NOT NULL,
    twitter_api_key    VARCHAR(255)
)   ENGINE=InnoDB      DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_0900_ai_ci;

-- タスクテーブル
CREATE TABLE tasks (
    task_id            BIGINT (20)              PRIMARY KEY  AUTO_INCREMENT,
    user_id            BIGINT (20)              NOT NULL,
    task_name          VARCHAR(255)             NOT NULL,
    execution_date     DATE                     NOT NULL,
    completion_status  TINYINT                  CHECK (completion_status IN (0, 1)),
    display_order      INT                      NOT NULL,
                       FOREIGN KEY (user_id)    REFERENCES users(user_id)
)   ENGINE=InnoDB      DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_0900_ai_ci;

-- 日報テーブル
CREATE TABLE reports (
    report_id          BIGINT (20)              PRIMARY KEY  AUTO_INCREMENT,
    user_id            BIGINT (20)              NOT NULL,
    reflection_comment TEXT                     NOT NULL,
    ai_comment         TEXT                     NOT NULL,
    submitted_date     DATE                     NOT NULL,
    study_hours        TIME                     NOT NULL,
                       FOREIGN KEY (user_id)    REFERENCES   users(user_id)
)   ENGINE=InnoDB      DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_0900_ai_ci;

-- タスク履歴
CREATE TABLE task_history (
    task_history_id    BIGINT (20)              PRIMARY KEY  AUTO_INCREMENT,
    report_id          BIGINT (20)              NOT NULL,
    task_name          VARCHAR(255)             NOT NULL,
    completion_status  TINYINT                  NOT NULL     CHECK (completion_status IN (0, 1)),
                       FOREIGN KEY (report_id)  REFERENCES reports(report_id)
)   ENGINE=InnoDB      DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_0900_ai_ci;
