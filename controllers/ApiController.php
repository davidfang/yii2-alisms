<?php

namespace zc\yii2Alisms\controllers;


use yii\base\ErrorException;
use yii\captcha\CaptchaValidator;
use yii\web\Controller;
use yii\web\Response;
use zc\yii2Alisms\models\SmsLog;
use zc\yii2Alisms\models\SmsTemplate;

/**
 * Default controller for the `yii2Alisms` module
 */
class ApiController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionGetCode($mobile,$id,$captcha = null)
    {
        $response = \Yii::$app->getResponse();
        $response->format = Response::FORMAT_JSON;
        if($this->validateMobile($mobile)){
            $model = SmsTemplate::findOne($id);
            if($model->captcha == SmsTemplate::CAPTCHA_ON){//验证码启用
                $captchaValidator = new CaptchaValidator();
                if( ! $captchaValidator->validate($captcha)){
                    $response->setStatusCode(422);
                    return [ 'status'=>false,'msg'=>'验证码不正确'];
                }
            }
            if(!$model){
                $response->setStatusCode(422);
                return [ 'status'=>false,'msg'=>'非法请求'];
            }

            $return = $this->sendCode($mobile,$model);
            if(!$return['status']){
                $response->setStatusCode(422);
            }
            return $return;

        }else{//手机格式验证错误
            $response->setStatusCode(422);
            return [
                'status'=>false,
                'msg'=>'手机格式不正确'
            ];
        }
        return $this->render('index');
    }
    /**
     * Validates the Mobile.
     * This method serves as the inline validation for Mobile.
     */
    public function validateMobile($mobile)
    {
        if(preg_match("/^1[34578]\d{9}$/", $mobile)){
            return true;
        }else{
            return false;
        }
    }

    //随机数或随机字符,可定长度,默认4位数字
     function random($length = 4 , $numeric = true) {
        if($numeric) {
            $hash = sprintf('%0'.$length.'d', mt_rand(0, pow(10, $length) - 1));
        } else {
            $hash = '';
            $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789abcdefghjkmnpqrstuvwxyz';
            $max = strlen($chars) - 1;
            for($i = 0; $i < $length; $i++) {
                $hash .= $chars[mt_rand(0, $max)];
            }
        }
        return $hash;
    }

    /**
     * 发送验证码
     * @param $mobile 手机号
     * @param $model \zc\yii2Alisms\models\SmsTemplate 模板信息
     * @return array
     */
     function sendCode($mobile,$model){
         $cache = \Yii::$app->getCache();
         $key = "SMS_{$model->id}_{$mobile}";
         if($cache->get($key)){//已经发送 缓存
             return [
                 'status'=>true,
                 'code'=>$cache->get($key),
                 'msg'=>'短信发送成功'
             ];
         }
         //var_dump([$key,$cache->get($key)]);exit;
         //没有发送 缓存

        include \Yii::getAlias('@vendor/zc/yii2-alisms/alidayu/TopSdk.php');
        $c = new \TopClient;
        $c ->appkey = $model->appkey ;// 可替换为您的沙箱环境应用的AppKey
        $c ->secretKey = $model->secretKey ;// 可替换为您的沙箱环境应用的AppSecret
        $req = new \AlibabaAliqinFcSmsNumSendRequest;
        $req ->setExtend( "" );
        $req ->setSmsType( "normal" );
        $req ->setSmsFreeSignName( $model->sms_free_sign_name );
        $param = json_decode($model->param,true);

        $code = '1';
        if (isset($param['code'])){
            $code = $param['code'] = $this->random(4);
        }

         $req ->setSmsParam( json_encode($param,JSON_UNESCAPED_UNICODE) );
        $req ->setRecNum( $mobile );
        $req ->setSmsTemplateCode( $model->tmpId );
        $resp = $c ->execute( $req );


        /*$c = new \TopClient;
        $c->appkey = "23773211"; // 可替换为您的沙箱环境应用的AppKey
        $c->secretKey = "c4ffc305083eeb12488734a245b4f85d"; // 可替换为您的沙箱环境应用的AppSecret
        $sessionkey= "test";  // 必须替换为沙箱账号授权得到的真实有效SessionKey

        $req = new \SellerItemGetRequest;
        $req->setFields("num_iid,title,nick,price,approve_status,sku");
        $req->setNumIid("123456789");
        $rsp = $c->execute($req,$sessionkey);*/

        //echo "api result:";
        //print_r($resp);exit;

         $smsLog = new SmsLog();
         $smsLog->tmp_id = $model->id;
         $smsLog->content = $code;
         $smsLog->mobile = $mobile;

        if(isset($resp->result)){
            if($resp->result->success){
                //短信发送成功信息
                //发送短信成功
                //To do 记录发送信息
                $smsLog->status = SmsLog::STATUS_SECUSS;
                $smsLog->result = 'ok';
                $return = [
                    'status'=>true,
                    'code'=>$code,
                    'message'=>'短信发送成功'
                ];
                //写入缓存
                $cacheResult = $cache->set($key,$code,time()+36000);
                //var_dump($cacheResult);exit;
                //return true;
            }else{
                //短信发送失败操作
                //To do 记录发送信息
                $smsLog->status = SmsLog::STATUS_FAILS;
                $smsLog->result = json_encode($resp->result,JSON_UNESCAPED_UNICODE);
                $return = [
                    'status'=>false,
                    //'code'=>$randomCode,
                    'message'=>$resp->result->msg,//'发送短信失败',
                    'err_code'=>$resp->result->err_code
                ];
            }
        }else{//短信发送异常
            $smsLog->status =  SmsLog::STATUS_FAILS;
            $smsLog->result = json_encode($resp,JSON_UNESCAPED_UNICODE);
            $return = [
                'status'=>false,
                //'code'=>$randomCode,
                'message'=>$resp,
                'error_response'=>$resp
            ];
        }

        $smsLog->save();


        return $return;

        //$sessionkey= "test";  // 必须替换为沙箱账号授权得到的真实有效SessionKey
        //$rsp = $c->execute($req,$sessionkey);

        //echo "api result:";
        // print_r($resp);



    }
    static function checkCode($phone,$code){
        $cacheCode = \Yii::$app->cache->get('sendCode'.$phone);
        //$cache = \Yii::$app->cache;
        //var_dump([$code ,$phone, $cacheCode,$cache]);exit;
        return $code === $cacheCode;
    }
}
