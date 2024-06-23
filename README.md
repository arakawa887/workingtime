# workingtime

概要説明
従業員のその日ごとの勤務時間及び休憩時間管理アプリ

![スクリーンショット 2024-06-19 211150](https://github.com/arakawa887/workingtime/assets/144455733/1e5b45f8-907a-4323-a9b5-f68229df5de2)

目的
人事評価のため

アプリケーションURL
http://localhost/register

他のリポジトリ
無し

機能一覧
ユーザー登録機能
ログイン機能
勤務時間登録機能
日付ごとのユーザーの勤務時間表示機能

使用技術
Laravel Framework 8.83.27

ER図
![スクリーンショット 2024-06-19 195515](https://github.com/arakawa887/workingtime/assets/144455733/d27d5c4d-4e91-48ee-8117-296c30f4a82d)


環境構築
mkdir workingtime
cd workingtime
mkdir docker src
$ touch docker-compose.yml
$ cd docker
$ mkdir mysql nginx php
$ mkdir mysql/data
$ touch mysql/my.cnf
$ touch nginx/default.conf
$ touch php/Dockerfile
$ touch php/php.ini
$ cd ../
$ docker-compose up -d --build
$ docker-compose exec php bash
# attend
# attend
