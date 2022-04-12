# ticket tracking system

# Table of Contents
- [背景知識](#背景知識)
- [安裝](#安裝)
- [如何使用](#如何使用)
    - [登入](#登入)
    - [新建一筆](#新建一筆)
    - [編輯](#編輯)
    - [結案](#結案)
- [Maintainers](#maintainers)

## 背景知識
這個專案用來追蹤 ticket 的進度  
目前有這些 ticket：  
1. Bug
2. Feature request
3. Test case

會有四種身分的角色  
1. Admin：管理所有使用者
2. PM：建立或編輯 Feature request
3. QA：建立或編輯 Bug 與 Test case，並且可以結案 Test case
4. RD：可以結案 Bug 與 Feature request

## 安裝
### 一般安裝，例如在 linux 環境中安裝
執行 git clone 後，請先在 `.env` 修改資料庫連線資訊
```dotenv
DB_HOST=127.0.0.1   # 資料庫的位址
DB_PORT=3306        # 資料庫的 port
DB_DATABASE=ticket  # 資料庫名稱
DB_USERNAME=root    # 使用者名稱
DB_PASSWORD=123456  # 使用者密碼
```

接著在專案目錄下執行下列指令安裝
```shell
# 安裝 packages
$ composer install

# 執行資料庫遷移
$ php artisan migrate
```

### 使用 docker compose
執行 git clone 後，請先在 `.env` 修改資料庫連線資訊
```dotenv
DB_HOST=mysql       # 資料庫的位址，使用 docker 安裝時請保持 `mysql`
DB_PORT=3306        # 資料庫的 port
DB_DATABASE=ticket  # 資料庫名稱
DB_USERNAME=root    # 使用者名稱
DB_PASSWORD=123456  # 使用者密碼
```

接著在專案目錄下執行下列指令安裝
```shell
# 執行 docker compose 來 pull image
docker compose up -d

# 安裝 packages
$ docker compose exec ticket composer install

# 執行資料庫遷移
$ docker compose exec ticket php artisan migrate

# 將網址加入 hosts
echo "127.0.0.1 ticket.test" >> /etc/hosts
```

# 如何使用
## 登入
進入系統前須先登入，目前已有的預設帳號如下：
1. Email: admin@example.com, Password: adminadmin123。身分是 admin
2. Email: pm@example.com, Password: pmpmpm123。身分是 pm
3. Email: qa@example.com, Password: qaqaqa123。身分是 qa
4. Email: rd@example.com, Password: rdrdrd123。身分是 rd

請於登入畫面中輸入 email 與 password  
![login](resources/images/ticket1.png)
登入後會導向首頁
![index](resources/images/ticket2.png)

## 進入 ticket tracking system
於首頁上方導覽列，點擊"Ticket"，即可進入 ticket tracking system  
於系統首頁可看到所有的 tickets，以下為範例資料：  
![ticket3.png](ticket3.png)

## 新建一筆
於 ticket tracking system 首頁，點擊"新建一筆"按鈕即可進入資料表單頁面  
只有`QA`才能夠新增`type`是`BUG`與`TEST_CASE`的 ticket  
只有`PM`才能夠新增`type`是`FEATURE_REQUEAT`的 ticket

![ticket4.png](ticket4.png)
新增完成後將返回 ticket tracking system 首頁  
且 tickets 清單將多出新的一筆資料

## 編輯
於 ticket tracking system 首頁，每一筆資料後方都有一個編輯按鈕  
每一個角色都可以進入編輯頁  
只有`QA`才能夠在編輯`type`是`BUG`與`TEST_CASE`的 ticket 時按下送出  
只有`PM`才能夠在編輯`FEATURE_REQUEAT`的 ticket 時按下送出  

![ticket5.png](ticket5.png)
編輯完成後將返回 ticket tracking system 首頁  
且 tickets 清單將呈現編輯完成的資料

## 結案
於 ticket tracking system 首頁 
登入的角色為`QA`時，`type`是`TEST_CASE`的 ticket 後方會出現結案按鈕  
登入的角色為`RD`時，`type`是`BUG`與`FEATURE_REQUEAT`的 ticket 後方會出現結案按鈕  

![ticket6.png](ticket6.png)
按下結案後將返回 ticket tracking system 首頁  
且 tickets 清單將呈現已結案的資料

## Maintainers
[@thinklikes](https://github.com/thinklikes).
