# Laravel Task Manager

Docker環境で動作するLaravelを使用したタスク管理アプリケーションです。

## 機能

- タスクの追加
- タスクの一覧表示
- タスクの削除（論理削除）
- Tailwind CSSによるスタイリング

## 技術スタック

- **Backend**: Laravel 10.x, PHP 8.1
- **Frontend**: Tailwind CSS, Vite
- **Database**: MariaDB
- **Environment**: Docker, Docker Compose

## セットアップ

1. リポジトリをクローン
```bash
git clone https://github.com/bunta-yamasaki-epkotsoftware/test-todolist.git
```

2. Docker環境を起動
```bash
docker-compose up -d
```

3. 依存関係をインストール
```bash
docker exec -it myapp-php composer install
docker exec -it myapp-php npm install
```

4. データベースマイグレーション
```bash
docker exec -it myapp-php php artisan migrate
```

5. アプリケーションにアクセス
```
http://localhost:81
```

