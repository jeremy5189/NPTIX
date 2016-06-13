# NPTIX
NPTIX 簡易活動報名選位系統

## Install
    git clone git@github.com:jeremy5189/NPTIX.git
    cd NPTIX
    composer install
    cp .env.example .env
    php artisan migrate
    php artisan serve

## 編輯 .env 可修改各種系統設定

- 寄件者 Email 及名稱
- 後台帳號密碼
- 系統顯示名稱
- 開始報名時間 timestamp
- 允許下載 DB 之 IP (限一個)
- DB 路徑
- DB 名稱
- Log 路徑
- Log 名稱
- 報名人數限制
- 允許或拒絕報名
