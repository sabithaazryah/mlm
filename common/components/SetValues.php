<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SetValues
 *
 * @author user
 */

namespace common\components;

use Yii;
use yii\base\Component;

class SetValues extends Component {

    public function Attributes($model) {



        if (isset($model) && !Yii::$app->user->isGuest) {
            if ($model->isNewRecord) {
                $model->CB = Yii::$app->user->identity->id;
                $model->DOC = date('Y-m-d');
            } else {
                $model->UB = Yii::$app->user->identity->id;
            }
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function currentBranch($model) {
        if ($model->isNewRecord) {
            $model->branch_id = Yii::$app->user->identity->branch_id;
        }
        return true;
    }

    public function Selected($value) {
        $options = array();
        if (is_array($value)) {
            $array = $value;
        } else {
            $array = explode(',', $value);
        }

        foreach ($array as $valuee):
            $options[$valuee] = ['selected' => true];
        endforeach;
        return $options;
    }

    public function ChangeFormate($date) {
        if ($date == Null || $date == '0000-00-00 00:00:00') {
            return '(Not Set)';
        } else {
            return date("d-M-Y h:i:s", strtotime($date));
        }
    }

    public function DateFormate($date) {
        $old = strtotime('1999-01-01 00:00:00');
        if ($date == Null || $date == '0000-00-00 00:00:00') {
            return;
        } else {
            $f = 'd-M-Y' . (date('H:i:s', strtotime($date)) != '00:00:00' ? ' H:i' : '');
            return str_replace(' 00:00:00', '', date($f, strtotime($date)));
        }
    }

    public function NumberFormat($grandtotal) {
        $s = explode('.', $grandtotal);
        $amount = $s[0];
        if (isset($s[1])) {
            $decimal = $s[1];
        } else {
            $decimal = 0;
        }
        if ($amount != '') {
            $total = $english_format_number = number_format($amount);
            if ($decimal != 0) {
                $grandtotal = $total . '.' . $decimal;
            } else {
                $grandtotal = $total . '.00';
            }
            return $grandtotal;
        } else {
            return;
        }
    }

    public function NumberArabic($input) {
        $unicode = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        $arabic = array('۰', '۱', '۲', '۳', '٤', '٥', '٦', '۷', '۸', '۹');

        $string = str_replace($unicode, $arabic, $input);
        return $string;
    }

    public function Transaction($transaction_category, $transaction_id, $transaction_date, $financial_year, $supplier_id, $supplier_name, $supplier_code, $credit_amount, $debit_amount, $balance_amount, $status, $type) {
        $model = new \common\models\Transaction;
        $model->transaction_category = $transaction_category;
        $model->transaction_id = $transaction_id;
        $model->type = $type;
        $model->transaction_date = $transaction_date;
        $model->financial_year = $financial_year;
        $model->supplier_id = $supplier_id;
        $model->supplier_name = $supplier_name;
        $model->supplier_code = $supplier_code;
        $model->credit_amount = $credit_amount;
        $model->debit_amount = $debit_amount;
        $model->balance_amount = $balance_amount;
        $model->status = $status;
        $model->CB = Yii::$app->user->identity->id;
        $model->DOC = date('Y-m-d');
        if ($model->save()) {
            return TRUE;
//                    echo 'ha';exit;
        } else {

        }
    }

    public function TransactionUpdate($transaction_category, $transaction_id, $transaction_date, $financial_year, $supplier_id, $supplier_name, $supplier_code, $credit_amount, $debit_amount, $balance_amount, $status, $type) {
        $model = \common\models\Transaction::find()->where(['transaction_category' => $transaction_category, 'transaction_id' => $transaction_id, 'type' => $type])->one();
        if (empty($model)) {
            $model = new \common\models\Transaction();
        }
        $model->transaction_category = $transaction_category;
        $model->transaction_id = $transaction_id;
        $model->transaction_date = $transaction_date;
        $model->financial_year = $financial_year;
        $model->supplier_id = $supplier_id;
        $model->supplier_name = $supplier_name;
        $model->supplier_code = $supplier_code;
        $model->credit_amount = $credit_amount;
        $model->debit_amount = $debit_amount;
        $model->balance_amount = $balance_amount;
        $model->status = $status;
        $model->CB = Yii::$app->user->identity->id;
        $model->DOC = date('Y-m-d');
        if ($model->save()) {
            return TRUE;
//                    echo 'ha';exit;
        } else {

        }
    }

}
