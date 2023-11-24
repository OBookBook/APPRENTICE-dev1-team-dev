# Web 開発 デイリポへようこそ!!

## 環境構築

### Docker ファイルがあるプロジェクトへ移動

1. Docker を起動し、コンテナを作成するコマンドです。

```shell
docker-compose up -d
```

### web サーバが が正常に動いているか確認

2. 以下の URL でアクセスできます：[http://localhost:9080/src/pages/](http://localhost:9080/src/pages/)

### phpMyAdmin が正常に動いているか確認

3. 以下の URL でアクセスできます：[http://localhost:9090/](http://localhost:9090/)

### Docker コンテナにログイン

4. Docker コンテナに入るコマンドです。

```shell
docker container exec -it php bash
```

### Composer で パッケージ をダウンロード

5. Composer を使用してパッケージをインストールするコマンドです。

```shell
composer install
```

### 静的解析(PHP_CodeSniffer)ツールの使用方法

6. index.php を PSR-12 に従って静的解析するコマンドです。

```shell
./vendor/bin/phpcs --standard=PSR12 ./index.php
```

