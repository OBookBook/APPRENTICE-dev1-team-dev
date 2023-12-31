FROM php:8.2-apache

# Xdebug 環境構築
RUN pecl install xdebug && \
  docker-php-ext-enable xdebug

# Docker 公式の Composer イメージ を使用
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Composer パッケージ管理する為の環境構築
RUN apt-get update && \
  apt-get install -y sudo git mariadb-client \
  && docker-php-ext-install pdo_mysql

# curl パッケージをインストールして有効化
RUN apt-get install -y libcurl4-openssl-dev && \
  docker-php-ext-install curl

# Composerの設定
RUN echo 'export PATH="$PATH:/root/.composer/vendor/bin"' >> /root/.bashrc
# Composerキャッシュのクリア
RUN composer global clear-cache

# php_codesniffer を使うための環境構築
RUN composer global require --no-interaction "squizlabs/php_codesniffer=*" && \
  composer require --dev --no-interaction squizlabs/php_codesniffer

# Node.js のインストール
RUN curl -fsSL https://deb.nodesource.com/setup_14.x | bash - && \
  apt-get install -y nodejs
