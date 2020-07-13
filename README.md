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

创建数据库

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

| 借口名|url | 请求方法 | 参数|
|--|--|--|--|
|存储链接|/url/save |POST |{"url":"","type":"link/img/file/other","redirect":"301/302"}|
|删除链接|/url/toy/1|POST|URL 后缀|
|获取链接|/url/toy/1|GET|URL 后缀|
|重定向链接|/url/redirect/1|GET|URL 后缀|
