# 模擬案件　フリーマーケット

##環境構築
###Docker ビルド

1. git clone git@github.com:keroyon-sgt/mock_free-market.git
2. docker-compose up -d --build

###Laravel 環境構築

1. docker-compose exec php bash
2. composer install
3. .env.example ファイルから.env を作成し、環境変数を変更  
   DB_DATABASE=laravel_db  
   DB_USERNAME=laravel_user  
   DB_PASSWORD=laravel_pass  
   MAIL_FROM_ADDRESS=from@example.com  
   MAIL_FROM_NAME="COACHTECH Free Market"

4. php artisan key:generate
5. php artisan migrate
6. php artisan db:seed
7. src\public\img にある画像ファイル 1 ～ 10.jpg、unknown.jpg を src\storage\app\public に移動またはコピー

##使用技術  
・php 8.0  
・Laravel 8.x  
・MySQL 8.0  

##ER 図

![Image](https://github.com/user-attachments/assets/d55820f4-1a72-4cfd-8fc6-1fee94b513f0)

##URL  
・開発環境：http://localhost  
・phpMyAdmin：http://localhost:8080  
・MailHog：http://localhost:8025  
