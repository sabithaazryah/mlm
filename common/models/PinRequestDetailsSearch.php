<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PinRequestDetails;

/**
 * PinRequestDetailsSearch represents the model behind the search form about `common\models\PinRequestDetails`.
 */
class PinRequestDetailsSearch extends PinRequestDetails {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'master_id', 'parent_id', 'package_id', 'status', 'epin_status', 'CB', 'UB', 'transer_id'], 'integer'],
            [['epin', 'DOC', 'DOU','approved_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {
        $query = PinRequestDetails::find()->orderBy(['id' => SORT_DESC]);

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
            'master_id' => $this->master_id,
            'parent_id' => $this->parent_id,
            'package_id' => $this->package_id,
            'status' => $this->status,
            'epin_status' => $this->epin_status,
            'transer_id' => $this->transer_id,
            'CB' => $this->CB,
            'UB' => $this->UB,
            'DOC' => $this->DOC,
            'DOU' => $this->DOU,
            'approved_date' => $this->approved_date,
        ]);

        $query->andFilterWhere(['like', 'epin', $this->epin]);

        return $dataProvider;
    }

}
