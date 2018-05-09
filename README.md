## laravel-aliyun

集成阿里云sdk的laravel composer包
    
## 安装
    composer require phplife/laravel-aliyun
- lumen
    在app.php中添加$app->register(Aliyun\Provider\AliyunServiceProvider::class)
    复制src/Config/aliyun.php到lumen config文件夹中进行自定义配置，如果lumen中没有config文件夹请自行创建
    
    
## 目前支持

- 发送单手机号短信
