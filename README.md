# タスク管理アプリ デイリポ -daily report-

内定直結型エンジニア学習プログラム「アプレンティス」のチーム開発で作成した Web アプリケーションです。

![dairy_report_logo](https://github.com/OBookBook/APPRENTICE-dev1-team-dev/assets/134520812/c04a92a7-7259-4987-b491-7566d76927b9)

本アプリは、効率的なタスク管理をしたいアプレンティス生向けのプロダクトです。（アプレンティス生でなくても活用できます！）
タスクの管理をしながら、その達成率を可視化し、振り返りを行うことで、PDCA を回す助けになります。
また、アプレンティスの日報となる日々の実績を、テキストでのコピー、画像のダウンロード、 X（ 旧 Twitter ）への投稿の３つの方法でシェアすることができます。
一般のタスク管理アプリや日報アプリとは違い、これらの作業をまとめて管理して、成果を可視化することがができます。

[【働きながら学べる】エンジニア実習 アプレンティス](https://apprentice.jp/)

## 環境構築

### イメージのクローン

任意のディレクトリで以下のコマンドを実行し、本リポジトリをクローンします。

```
git clone https://github.com/OBookBook/APPRENTICE-dev1-team-dev.git
```

### Dockerfile の親ディレクトリ(APPRENTICE-dev1-team-dev)へ移動し、コンテナを起動

1. APPRENTICE-dev1-team-dev ディレクトリへ移動

```shell
cd APPRENTICE-dev1-team-dev
```

2. Docker を起動し、コンテナを作成

```shell
docker-compose up -d
```

### web サーバが が正常に動いているか確認

- 以下の URL でトップページにアクセスできます：[http://localhost:9080/src/php/pages/](http://localhost:9080/src/php/pages/)

### Docker コンテナにログイン

- Docker コンテナに入るコマンド

```shell
docker container exec -it php bash
```

### Composer で パッケージ をダウンロード

- Composer を使用してパッケージをインストールする

```shell
composer install
```

### コードの静的解析(PHP_CodeSniffer)ツールの使用方法

- PSR-12 に従って静的解析するコマンド

```shell
composer phpcs
```

## デイリポの使い方

※ 注意 ※
現時点で、デイリポにはログイン機能が実装されていません。
そのため、登録したタスクや振り返りメモはすべての人が閲覧できる状態です。
タスクの登録・削除などをお試しいただくのは構いませんが、節度のある利用をお願いいたします。
今後可能であれば、ログイン機能も実装し、個人でご利用いただけるようにしたいと思っています。

1. サーバーを起動し、以下の URL でアクセスできます：[http://localhost:9080/src/php/pages/]

ページを開くと、カレンダーには本日の日付がハイライトされ、下部には本日の日付のタスク一覧と、その達成率などが表示されます。
カレンダーには、その日のタスクの完了率が円グラフで表示されます。
日付をクリックすると、その日付に対応したタスク一覧と実績が下部に表示されます。

![スクリーンショット 2023-12-08 050919](https://github.com/OBookBook/APPRENTICE-dev1-team-dev/assets/134520812/1df17eed-b9f6-4116-aba7-a364f09d09ed)

2. 左下のタスク一覧の欄では、新しいタスクの登録、タスクの削除、完了のチェックを入れることができます。

![スクリーンショット 2023-12-08 050607](https://github.com/OBookBook/APPRENTICE-dev1-team-dev/assets/134520812/2dc3a1d3-df08-4534-bccb-f790fa6d6cf7)

3. 右下の欄には、タスクの完了・未完了が反映されている他、振り返りメモ入力欄と、入力したメモに対する ChatGPT のコメントが表示されます。
   （今後、使用する ChatGPT をもっと高性能のものに変更すれば、もっとステキなメッセージをもらえると思います！）

![スクリーンショット 2023-12-08 051930](https://github.com/OBookBook/APPRENTICE-dev1-team-dev/assets/134520812/3738647c-1585-4b38-ab37-0026afc5239d)
