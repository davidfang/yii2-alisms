<?php

namespace zc\yii2Alisms;

/**
 * This is just an example.
 */
class Sms
{

    /**
     * 校验手机验证码
     * @param $mobile
     * @param $code
     * @param int $id
     * @return bool
     */
    static function checkCode($mobile,$code,$id=1){
        $key = "SMS_{$id}_{$mobile}";
        $cache = \Yii::$app->cache;
        $cacheCode = $cache->get($key);
        //$cache = \Yii::$app->cache;
        //var_dump([$code ,$phone, $cacheCode,$cache]);exit;
        if($code === $cacheCode){
            $cache->delete($key);
        }
        return $code === $cacheCode;
    }
}
