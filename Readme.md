# Rese
飲食店予約サービス
模擬案件。AWS EC2、S3、RDSを使用してデプロイ

![スクリーンショット 2023-03-06 22 22 23](https://user-images.githubusercontent.com/115058763/223122347-c32f2ce5-57eb-4403-bb9f-14aba4eec551.png)


## 作成した目的
模擬案件課題提出の為

## アプリケーションURL
http://13.231.94.69:8000/

## 機能一覧
- 会員登録（メール認証）
- ログイン・ログアウト
- ユーザー飲食店お気に入り・予約追加・削除
- エリア・ジャンル・店名検索
- 飲食店詳細・予約画面表示
- 予約変更、削除
- ユーザー管理（店舗代表者管理）
- 店舗管理（店舗情報作成、更新、予約確認）
- メール送信機能
- QRコード表示
- Stripeによる決済機能

## 使用技術
- Laravel 9.52.4
- Laravel/breeze 1.19.2
- stripe-php 10.8.0
- simple-qrcode 4.2.0
- Docker 20.10.17, build 100c701
- docker-compose 1.22.0
- 

## テーブル設計
![スクリーンショット 2023-03-06 22 18 11](https://user-images.githubusercontent.com/115058763/223122228-27bc3dc3-c7b9-4b2b-adbd-a1b1b5bfb1f1.png)

## ER図
![resetable drawio](https://user-images.githubusercontent.com/115058763/223122554-a659b214-bad4-4a34-855d-bdf4e0eb34de.png)