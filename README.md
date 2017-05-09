阿里大于发送短信 yii2扩展
===============
阿里大于发送短信 yii2扩展

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist zc/yii2-alisms "*"
```

or add

```
"zc/yii2-alisms": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= \zc\yii2Alisms\AutoloadExample::widget(); ?>
```


管理后台
-------
* 配置文件
```php
"sms" => [
            "class" => "zc\yii2Alisms\Module",
        ]
        
```

* 后台管理访问地址
模板 http://backend.example.dev/sms/sms-template
日志 http://backend.example.dev/sms/sms-log


前台访问
-------
* 配置文件
```php
'controllerMap' => [

            'sms-api' => 'zc\yii2Alisms\controllers\ApiController',

    ],
```
* 发验证码api访问地址
http://example.dev/sms-api/get-code?mobile=15699999999&id=1
 
 
 