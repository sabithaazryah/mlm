<?php

namespace frontend\controllers;

use Yii;
use common\models\Employee;
use common\models\EmployeeDetails;
use common\models\EmployeePackage;

class DashboardController extends \yii\web\Controller {

    public $layout = '@app/views/layouts/dashboard';

    public function actionIndex() {
        $employee = Employee::findOne(Yii::$app->user->identity->id);
        $employee_details = EmployeeDetails::find()->where(['employee_id' => Yii::$app->user->identity->id])->one();
        $employee_package = EmployeePackage::find()->where(['employee_id' => Yii::$app->user->identity->id])->one();
        return $this->render('index', [
                    'employee' => $employee,
                    'employee_details' => $employee_details,
                    'employee_package' => $employee_package,
        ]);
    }

}
