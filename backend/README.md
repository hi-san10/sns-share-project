# sns-share

## Twitter風SNSアプリ

## 環境構築

### 動作環境
- Firebase
- Node.js v22
- yarn
- Node.jsバージョン確認
    node -v

### Node.jsインストール

    [https://nodejs.org/ja/download](https://nodejs.org/ja/download)

### GitHubからプロジェクトをクローン

    git clone git@github.com:hi-san10/sns-share-project.git

### Firebaseプロジェクト作成

1. Firebaseコンソールにアクセスし新しいプロジェクトを作成

    [https://firebase.google.com/?hl=ja](https://firebase.google.com/?hl=ja)

2. プロジェクトの設定→サービスアカウントから新しい秘密鍵を作成

3. serviceAccountKey.jsonをダウンロードしプロジェクト内に配置

    backend/src/storage/app/firebase/serviceAccountKey.json

4. プロジェクトの設定→WEBアプリを追加しFirebase SDKをインストール

    frontendディレクトリで  npm install firebase

5. Authenticationからログイン方法をメール/パスワードに設定

### Nuxt開発環境

1. 依存関係をインストール

    frontendディレクトリで  yarn install

2. firebase.client.ts.exampleファイルからfirebase.client.tsを作成し、環境変数を変更

    cp plugins/firebase.client.ts.example plugins/firebase.client.ts

2. .envを作成し、Laravel側のURLを設定

    touch .env

    NUXT_PUBLIC_API_BASE=http://localhost:80    を設定

3. 開発サーバ起動

    yarn dev -o

    ctl+cで終了

### Laravel環境構築

1. Dockerビルドし、composerで依存関係をインストール
    *MYSQLは、OSによって起動しない場合があるのでそれぞれのPCに合わせて docker-compose.yml ファイルを編集してください。

    docker-compose up -d --build

    docker-compose exec php bash

    composer install

2. env.exampleファイルから.envを作成し、docker-compose.ymlに応じて環境変数を変更

    cp .env.example .env

    秘密鍵のパスを設定
        FIREBASE_CREDENTIALS=backend/src/storage/app/firebase/serviceAccountKey.json

    php artisan config:clear で.env情報を更新

3. php artisan key:generate

4. php artisan migrate

## 使用技術

・PHP 8.3

・Laravel 8.83

・MYSQL 8.0

## ER図

![Image](https://github.com/user-attachments/assets/0e404d50-696c-48d1-92aa-2500f00605bf)

## テーブル仕様書
![Image](https://github.com/user-attachments/assets/7bd2af84-d7fa-4d8c-9e5d-578bbf3c0d4f)

## URL

・アプリケーション(Nuxt開発環境):[http//localhost:3000](http//localhost/3000)

・アプリケーション(Laravel開発環境):[http//localhost/](http//localhost/)

・phpMyAdmin:[http//localhost:8080](http/localhost:8080)
