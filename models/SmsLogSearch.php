<?php

namespace zc\yii2Alisms\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use zc\yii2Alisms\models\SmsLog;

/**
 * SmsLogSearch represents the model behind the search form about `zc\yii2Alisms\models\SmsLog`.
 */
class SmsLogSearch extends SmsLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tmp_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['content','mobile', 'result'], 'safe'],
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
        $query = SmsLog::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'tmp_id' => $this->tmp_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'result', $this->result]);

        return $dataProvider;
    }
}
