# 家計簿アプリのAPIサーバー

## 概要
Laravelで構築したAPIサーバー

## DB

### データベース
share_spend_db

### テーブル
- app_users
  | カラム名 | 型      | 備考     |
  | -------- | ------- | -------- |
  | id       | Integer | PK       |
  | name     | String  | NOT NULL |
  | password | String  | NOT NULL |
- types(timestamps)
  | カラム名 | 型      | 備考 |
  | -------- | ------- | ---- |
  | id       | Integer | PK   |
  | type     | String  | FK   |
- costs(timestamps)
  | カラム名        | 型      | 備考              |
  | --------------- | ------- | ----------------- |
  | id              | Integer | PK                |
  | user_id         | Integer | FK(app_users.id)  |
  | type_id         | Integer | FK(types.id)      |
  | name            | String  | NOT NULL          |
  | cost            | Integer | NOT NULL          |
  | is_half_billing | Boolean | True:半額請求対象 |
  | is_full_billing | Boolean | True:全額請求対象 |
- fixed_costs(timestamps)
  | カラム名 | 型      | 備考         |
  | -------- | ------- | ------------ |
  | id       | Integer | PK           |
  | cost_id  | Integer | FK(costs.id) |
  | end_date | Date    | NULLABLE     |

## API
ベースエンドポイント:/api
| エンドポイント                    | メソッド | 機能                     |
| --------------------------------- | -------- | ------------------------ |
| /register                         | POST     | ユーザー登録             |
| /login                            | POST     | ログイン                 |
| /types                            | GET      | 全費用種別取得           |
| /types/create                     | POST     | 費用種別登録             |
| /types/updete/{typeId}            | PUT      | 費用種別更新             |
| /types/delete/{typeId}            | DELETE   | 費用種別削除             |
| /costs                            | GET      | 全支出取得               |
| /costs/{userId}?year={}&month={}  | GET      | ユーザー別の支出一覧取得 |
| /costs/all?year={}&month={}       | GET      | 月別支出一覧取得         |
| /costs/type?year={}&month={}      | GET      | 種別毎の月別支出一覧取得 |
| /costs/create                     | POST     | 支出登録                 |
| /costs/updete/{costId}            | PUT      | 支出更新                 |
| /costs/delete/{costId}            | DELETE   | 支出削除                 |
| /fixed-costs                      | GET      | 全固定費取得             |
| /fixed-costs/create               | POST     | 固定費用登録             |
| /fixed-costs/update/{fixedCostId} | PUT      | 固定費用更新             |
| /fixed-costs/delete/{fixedCostId} | DELETE   | 固定費用削除             |
| /billing-amount?year={}&month={}  | GET      | 請求金額取得             |
