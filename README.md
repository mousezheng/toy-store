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

配置数据库，测试使用 sqlite 在 .env 中添加

```php
DATABASE_URL=sqlite:///%kernel.project_dir%/var/data.db
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
