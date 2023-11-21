USE daily_report;
-- usersテーブルのテストデータ挿入
INSERT INTO users (user_name, password, twitter_api_key) VALUES
('user1', 'password1', 'twitter_key_1'),
('user2', 'password2', 'twitter_key_2'),
('user3', 'password3', 'twitter_key_3');

-- tasksテーブルのテストデータ挿入
INSERT INTO tasks (user_id, task_name, execution_date, completion_status, display_order) VALUES
(1, 'Task 1', '2023-11-20', 1, 1),
(1, 'Task 2', '2023-11-21', 0, 2),
(2, 'Task 3', '2023-11-22', 1, 1),
(2, 'Task 4', '2023-11-23', 0, 2),
(3, 'Task 5', '2023-11-24', 1, 1),
(3, 'Task 6', '2023-11-25', 0, 2),
(1, 'Task 7', '2023-11-26', 1, 3),
(2, 'Task 8', '2023-11-27', 0, 3);

-- reportsテーブルのテストデータ挿入
INSERT INTO reports (user_id, reflection_comment, ai_comment, submitted_date) VALUES
(1, 'Reflection 1', 'AI Comment 1', '2023-11-20'),
(1, 'Reflection 2', 'AI Comment 2', '2023-11-21'),
(2, 'Reflection 3', 'AI Comment 3', '2023-11-22'),
(2, 'Reflection 4', 'AI Comment 4', '2023-11-23'),
(3, 'Reflection 5', 'AI Comment 5', '2023-11-24'),
(3, 'Reflection 6', 'AI Comment 6', '2023-11-25'),
(1, 'Reflection 7', 'AI Comment 7', '2023-11-26'),
(2, 'Reflection 8', 'AI Comment 8', '2023-11-27');

-- task_historyテーブルのテストデータ挿入
INSERT INTO task_history (report_id, task_name, completion_status) VALUES
(1, 'Task 1', 1),
(1, 'Task 2', 0),
(2, 'Task 3', 1),
(2, 'Task 4', 0),
(3, 'Task 5', 1),
(3, 'Task 6', 0),
(1, 'Task 7', 1),
(2, 'Task 8', 0);
