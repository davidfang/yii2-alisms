<?php

namespace zc\yii2Alisms\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use zc\yii2Alisms\models\SmsTemplate;

/**
 * SmsTemplateSearch represents the model behind the search form about `zc\yii2Alisms\models\SmsTemplate`.
 */
class SmsTemplateSearch extends SmsTemplate
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['appkey', 'secretKey', 'sms_free_sign_name', 'name', 'tmpId', 'content', 'param'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = SmsTemplate::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'appkey', $this->appkey])
            ->andFilterWhere(['like', 'secretKey', $this->secretKey])
            ->andFilterWhere(['like', 'sms_free_sign_name', $this->sms_free_sign_name])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'tmpId', $this->tmpId])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'param', $this->param]);

        return $dataProvider;
    }
}
