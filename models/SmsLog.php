<?php

namespace zc\yii2Alisms\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%sms_log}}".
 *
 * @property integer $id
 * @property integer $tmp_id
 * @property integer $mobile
 * @property string $content
 * @property integer $status
 * @property string $result
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property SmsTemplate $tmp
 */
class SmsLog extends \yii\db\ActiveRecord
{
    const STATUS_SECUSS = 1;//成功
    const STATUS_FAILS = 0;//失败

    /**
     * 获取状态集
     * @return array
     */
    public static function getStatus(){
        return [
            self::STATUS_SECUSS => '成功',
            self::STATUS_FAILS => '失败',
        ];
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
    public static function tableName()
    {
        return '{{%sms_log}}';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'tmp_id', 'content','mobile'], 'required'],
            [['id', 'tmp_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['content'], 'string', 'max' => 200],
            [['result'], 'string', 'max' => 500],
            [['tmp_id'], 'exist', 'skipOnError' => true, 'targetClass' => SmsTemplate::className(), 'targetAttribute' => ['tmp_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tmp_id' => '模板名',
            'mobile' => '手机',
            'content' => '内容',
            'status' => '状态',
            'result' => '结果',
            'created_at' => '创建时间',
            'updated_at' => '修改时间',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTmp()
    {
        return $this->hasOne(SmsTemplate::className(), ['id' => 'tmp_id']);
    }
}
