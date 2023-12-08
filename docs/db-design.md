# ER 図

![er_diagram](https://github.com/OBookBook/APPRENTICE-dev1-team-dev/assets/130152109/d0094a49-a21b-4c29-bd51-58b3ea72080d)

# テーブル定義

## users テーブル

```shell
mysql> DESCRIBE users;
+-----------------+--------------+------+-----+---------+----------------+
| Field           | Type         | Null | Key | Default | Extra          |
+-----------------+--------------+------+-----+---------+----------------+
| user_id         | bigint       | NO   | PRI | NULL    | auto_increment |
| user_name       | varchar(255) | NO   | UNI | NULL    |                |
| password        | varchar(30)  | NO   |     | NULL    |                |
| twitter_api_key | varchar(255) | YES  |     | NULL    |                |
+-----------------+--------------+------+-----+---------+----------------+
4 rows in set (0.00 sec)
```

## tasks テーブル

```shell
mysql> DESCRIBE tasks;
+-------------------+--------------+------+-----+---------+----------------+
| Field             | Type         | Null | Key | Default | Extra          |
+-------------------+--------------+------+-----+---------+----------------+
| task_id           | bigint       | NO   | PRI | NULL    | auto_increment |
| user_id           | bigint       | NO   | MUL | NULL    |                |
| task_name         | varchar(255) | NO   |     | NULL    |                |
| execution_date    | date         | NO   |     | NULL    |                |
| completion_status | tinyint      | YES  |     | NULL    |                |
| display_order     | int          | NO   |     | NULL    |                |
+-------------------+--------------+------+-----+---------+----------------+
6 rows in set (0.00 sec)
```

## reports テーブル

```shell
mysql> DESCRIBE reports;
+--------------------+--------+------+-----+---------+----------------+
| Field              | Type   | Null | Key | Default | Extra          |
+--------------------+--------+------+-----+---------+----------------+
| report_id          | bigint | NO   | PRI | NULL    | auto_increment |
| user_id            | bigint | NO   | MUL | NULL    |                |
| reflection_comment | text   | NO   |     | NULL    |                |
| ai_comment         | text   | NO   |     | NULL    |                |
| submitted_date     | date   | NO   |     | NULL    |                |
| study_hours        | time   | NO   |     | NULL    |                |
+--------------------+--------+------+-----+---------+----------------+
6 rows in set (0.06 sec)
```

## task_history テーブル

```shell
mysql> DESCRIBE task_history;
+-------------------+--------------+------+-----+---------+----------------+
| Field             | Type         | Null | Key | Default | Extra          |
+-------------------+--------------+------+-----+---------+----------------+
| task_history_id   | bigint       | NO   | PRI | NULL    | auto_increment |
| report_id         | bigint       | NO   | MUL | NULL    |                |
| task_name         | varchar(255) | NO   |     | NULL    |                |
| completion_status | tinyint      | NO   |     | NULL    |                |
+-------------------+--------------+------+-----+---------+----------------+
4 rows in set (0.01 sec)
```
