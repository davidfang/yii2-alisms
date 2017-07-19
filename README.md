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
http://example.dev/sms-api/get-code?mobile=15699999999&id=1&captcha=sdfwf
   参数：
 
  * mobile: 手机 
  * id:短信模板ID
  * captcha：可选 ，在需要图形验证码的时候使用,是否需要图形验证码在后台设置

   返回：
 
  * status: true,
  * code: "7025",
  * hash1: "7025",原hash
  * hash2: "7025",小写hash
  * msg: "短信发送成功"
  
  说明：
  ``
  hash1、hash2可以用于客户端的验证，验证方法参考下面
  ``
  ```php
    /** 生成方法
     * Generates a hash code that can be used for client-side validation.
     * @param string $code the CAPTCHA code
     * @return string a hash code generated from the CAPTCHA code
     * /
    public function generateValidationHash($code)
    {
        for ($h = 0, $i = strlen($code) - 1; $i >= 0; --$i) {
            $h += ord($code[$i]);
        }

        return $h;
    } 
    ```


* 校验验证码api访问地址 （可以不用了）
http://example.dev/sms-api/check-code?mobile=15699999999&code=1&id=1
  * mobile: 手机 
  * id:短信模板ID
  * code:验证码 
校验验证码
---------

在需要的model里面添加rule规则

```php
['code', 'required'],
            //['code', 'checkCode'],
            ['code',  function ($attribute, $params) {
                $smsType = 1;//跟前台访问验证码的id一致
                if(!\zc\yii2Alisms\Sms::checkCode($this->mobile,$this->code,$smsType)){
                    $this->addError('code','手机验证码不正确');
                    return false;
                }
            }],
```
 
 
 