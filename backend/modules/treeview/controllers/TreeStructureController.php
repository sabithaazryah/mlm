<?php

namespace backend\modules\treeview\controllers;

use Yii;
use common\models\Employee;

class TreeStructureController extends \yii\web\Controller {

    public function actionIndex($id = NULL) {
        if ($id != NULL) {
            $id = Yii::$app->EncryptDecrypt->Encrypt('decrypt', $id);
            $emp_details = Employee::find()->where(['id' => $id])->one();
        } else {
            $emp_details = Employee::find()->where(['id' => Yii::$app->user->identity->id])->one();
        }
        return $this->render('index', [
                    'emp_details' => $emp_details,
        ]);
    }

    public function actionTreeSearch() {
        if (Yii::$app->request->post()) {
            $distributor = $_POST['distributor_name'];
            $emp = Employee::find()->where(['user_name' => $distributor])->one();
            if (!empty($emp)) {
                return $this->redirect(['index', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp->id)]);
            }
        } return $this->redirect(Yii::$app->request->referrer);
    }

}
