<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Employee;

/**
 * EmployeeSearch represents the model behind the search form about `common\models\Employee`.
 */
class EmployeeSearch extends Employee
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'placement', 'epin', 'bv', 'referal_id', 'gender', 'pincode', 'state', 'nominee_relation', 'status', 'CB', 'UB'], 'integer'],
            [['placement_name', 'placement_id', 'distributor_name', 'epin_number', 'father_name', 'dob', 'mobile_number', 'post_office', 'city', 'house_name', 'taluk', 'address', 'email', 'nominee_name', 'ifsc_code', 'account_no', 'bank_name', 'branch', 'pan_number', 'password', 'user_name', 'DOC', 'DOU'], 'safe'],
            [['pin_price'], 'number'],
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
        $query = Employee::find();

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
            'placement' => $this->placement,
            'epin' => $this->epin,
            'pin_price' => $this->pin_price,
            'bv' => $this->bv,
            'referal_id' => $this->referal_id,
            'dob' => $this->dob,
            'gender' => $this->gender,
            'pincode' => $this->pincode,
            'state' => $this->state,
            'nominee_relation' => $this->nominee_relation,
            'status' => $this->status,
            'CB' => $this->CB,
            'UB' => $this->UB,
            'DOC' => $this->DOC,
            'DOU' => $this->DOU,
        ]);

        $query->andFilterWhere(['like', 'placement_name', $this->placement_name])
            ->andFilterWhere(['like', 'placement_id', $this->placement_id])
            ->andFilterWhere(['like', 'distributor_name', $this->distributor_name])
            ->andFilterWhere(['like', 'epin_number', $this->epin_number])
            ->andFilterWhere(['like', 'father_name', $this->father_name])
            ->andFilterWhere(['like', 'mobile_number', $this->mobile_number])
            ->andFilterWhere(['like', 'post_office', $this->post_office])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'house_name', $this->house_name])
            ->andFilterWhere(['like', 'taluk', $this->taluk])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'nominee_name', $this->nominee_name])
            ->andFilterWhere(['like', 'ifsc_code', $this->ifsc_code])
            ->andFilterWhere(['like', 'account_no', $this->account_no])
            ->andFilterWhere(['like', 'bank_name', $this->bank_name])
            ->andFilterWhere(['like', 'branch', $this->branch])
            ->andFilterWhere(['like', 'pan_number', $this->pan_number])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'user_name', $this->user_name]);

        return $dataProvider;
    }
}
