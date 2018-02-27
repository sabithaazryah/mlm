<?php

namespace frontend\controllers;

use Yii;
use common\models\Employee;

class EmployeeController extends \yii\web\Controller {

        public function actionCreate() {
                $model = new Employee();
                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
                        $model->dob = date('Y-m-d', strtotime($model->dob));
                        $model->password = Yii::$app->security->generatePasswordHash($model->password);
                        if ($model->save()) {
                                $model = new Employee;
                        }
                }

                return $this->render('create', ['model' => $model]);
        }

}
