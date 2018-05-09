## laravel-aliyun

集成阿里云sdk的laravel composer包
    
## 安装
-   ```
    composer require phplife/laravel-aliyun
    ```
- lumen
    ```
    在app.php中添加$app->register(Aliyun\Provider\AliyunServiceProvider::class);
    复制src/Config/aliyun.php到lumen config文件夹中进行自定义配置，如果lumen中没有config文件夹请自行创建
    ```
- laravel
    ```
    'providers' => array(
        // ...
        Aliyun\Provider\AliyunServiceProvider::class,
    );
    复制src/Config/aliyun.php到laravel config文件夹中进行自定义配置
    ```
## 目前支持

- 发送单手机号短信
```php
//注入sms
public function send(Sms $sms)
{
    //短信发送
    $sms->sendSms('手机号', '签名名称', '模板CODE', '模板参数', '可选，流水号', '可选，扩展码');
}
```
