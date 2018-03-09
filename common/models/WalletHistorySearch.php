<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\WalletHistory;

/**
 * WalletHistorySearch represents the model behind the search form of `common\models\WalletHistory`.
 */
class WalletHistorySearch extends WalletHistory
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'type', 'employee_id'], 'integer'],
            [['match_bv', 'previous_wallet_amount', 'current_wallet_amount', 'company', 'company_amount', 'tax', 'tax_amount', 'service_charge', 'service_charge_amount', 'commision'], 'number'],
            [['date'], 'safe'],
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
        $query = WalletHistory::find();

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
            'type' => $this->type,
            'employee_id' => $this->employee_id,
            'match_bv' => $this->match_bv,
            'previous_wallet_amount' => $this->previous_wallet_amount,
            'current_wallet_amount' => $this->current_wallet_amount,
            'company' => $this->company,
            'company_amount' => $this->company_amount,
            'tax' => $this->tax,
            'tax_amount' => $this->tax_amount,
            'service_charge' => $this->service_charge,
            'service_charge_amount' => $this->service_charge_amount,
            'commision' => $this->commision,
            'date' => $this->date,
        ]);

        return $dataProvider;
    }
}
