<?php

namespace zc\yii2Alisms\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%sms_template}}".
 *
 * @property integer $id
 * @property string $appkey
 * @property string $secretKey
 * @property string $sms_free_sign_name
 * @property string $name
 * @property string $tmpId
 * @property string $content
 * @property string $param
 * @property integer $status
 * @property integer $captcha
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property SmsLog[] $smsLogs
 */
class SmsTemplate extends \yii\db\ActiveRecord
{
    const STATUS_ON = 1;//启用
    const STATUS_OFF = 2;//禁用

    const CAPTCHA_ON = 1;//验证码启用
    const CAPTCHA_OFF = 0;//验证码禁用

    /**
     * 获取状态集
     * @return array
     */
    public static function getStatus(){
        return [
            self::STATUS_ON => '启用',
            self::STATUS_OFF => '禁用',
        ];
    }
    /**
     * 获取状态集
     * @return array
     */
    public static function getCaptchas(){
        return [
            self::CAPTCHA_ON => '启用',
            self::CAPTCHA_OFF => '禁用',
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sms_template}}';
    }
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['appkey', 'secretKey', 'sms_free_sign_name', 'name', 'tmpId', 'content', 'param'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['appkey', 'secretKey', 'sms_free_sign_name', 'name', 'tmpId'], 'string', 'max' => 45],
            [['content'], 'string', 'max' => 500],
            [['param'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'appkey' => 'Appkey',
            'secretKey' => 'Secret Key',
            'sms_free_sign_name' => '短信签名',
            'name' => '模板名称',
            'tmpId' => '模板ID(阿里)',
            'content' => '内容',
            'param' => '参数(json格式）',
            'status' => '状态',
            'captcha' => '验证码',
            'created_at' => '创建时间',
            'updated_at' => '修改时间',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSmsLogs()
    {
        return $this->hasMany(SmsLog::className(), ['tmp_id' => 'id']);
    }
}
