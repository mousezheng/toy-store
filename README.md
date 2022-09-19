# toy-store

一个基于 RESTFUL 的键值管理工具。

## 环境

- php 7+
- symfony 5

## 使用方法

下载源码

```shell
git clone https://github.com/mousezheng/toy-store.git
```

安装依赖

```shell
composer install
```

配置数据库，测试使用 sqlite 在 .env 中添加(使用 sqllite 需要在对应目录创建文件)

```php
DATABASE_URL=sqlite:///%kernel.project_dir%/var/data.db
#DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7
```

创建数据库测试

```php
php bin/console doctrine:database:create
```

创建表

```php
php bin/console doctrine:migrations:migrate
```

运行

```shell
symfony server:start
```

## 短连接相关API

| 接口名|url | 请求方法 | 参数|
|--|--|--|--|
|存储链接|/url/save |POST |{"url":"","type":"link/img/file/other","redirect":"301/302"}|
|删除链接|/url/toy/1|POST|URL 后缀|
|获取链接|/url/toy/1|GET|URL 后缀|
|重定向链接|/url/redirect/1|GET|URL 后缀|

## 微信相关API

| 接口名|url | 请求方法 | 参数|返回信息|
|--|--|--|--|--|
|保存微信用户信息|/weixin/saveUserInfo |POST |{"openId":"OPENID","nickName":"NICKNAME","gender":1,"city":"CITY","province":"PROVINCE","country":"COUNTRY","avatarUrl":"https://ipsky.oss-cn-shanghai.aliyuncs.com/User/202009/08/RBPMNltXYYV0T/1599555445000185962324ly1fy3oxwy3j1j20u00u0dim.jpg","language":"en","unionId":"UNIONID"}|{"code":0,"message":"success.","data":3}|
|获取微信用户信息 |/weixin/getUserInfo |GET| openId=openid|{"code":0,"message":"success.","data":{"id":3,"avatarUrl":"https://ipsky.oss-cn-shanghai.aliyuncs.com/User/202009/08/RBPMNltXYYV0T/1599555445000185962324ly1fy3oxwy3j1j20u00u0dim.jpg","city":"CITY","country":"COUNTRY","gender":1,"language":"en","nickName":"NICKNAME","province":"PROVINCE","openId":"OPENID"}}|
|获取session|/weixin/getSessionByCode|GET|code=code|{"openid":"OPENID","session_key":"OPENID"} |
