<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\EpinRequest;

/**
 * EpinRequestSearch represents the model behind the search form of `common\models\EpinRequest`.
 */
class EpinRequestSearch extends EpinRequest
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'type', 'number_of_pin', 'status', 'CB', 'UB'], 'integer'],
            [['amount_deposited'], 'number'],
            [['bank_name', 'transaction_id', 'name', 'phone_number', 'package_for_each_pin', 'slip', 'DOC', 'DOU'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = EpinRequest::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'amount_deposited' => $this->amount_deposited,
            'type' => $this->type,
            'number_of_pin' => $this->number_of_pin,
            'status' => $this->status,
            'CB' => $this->CB,
            'UB' => $this->UB,
            'DOC' => $this->DOC,
            'DOU' => $this->DOU,
        ]);

        $query->andFilterWhere(['like', 'bank_name', $this->bank_name])
            ->andFilterWhere(['like', 'transaction_id', $this->transaction_id])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'phone_number', $this->phone_number])
            ->andFilterWhere(['like', 'package_for_each_pin', $this->package_for_each_pin])
            ->andFilterWhere(['like', 'slip', $this->slip]);

        return $dataProvider;
    }
}
