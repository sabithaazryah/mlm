<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
USE common\models\Employee;
use common\models\EmployeePackage;
Use common\models\ProfileUploads;
use yii\web\UploadedFile;
use common\models\ForgotPasswordTokens;

/**
 * Site controller
 */
class SiteController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup', 'forgot', 'new-password'],
                'rules' => [
                    [
                        'actions' => ['signup', 'forgot', 'new-password'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'forgot', 'new-password'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex() {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['dashboard/index']);
        }

        $this->layout = 'login';
        $model = new Employee();
        $model->scenario = 'login';
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            return $this->redirect(['dashboard/index']);
        } else {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    public function UploadImages($model, $type, $files) {
        $model->type = $type;
        $model->customer_id = Yii::$app->user->identity->id;
        if (!empty($files)) {
            $model->photo = $files->extension;
        }
        if ($type == 1) {
            $path = Yii::$app->basePath . '/../uploads/profile_uploads/profile_picture/';
        } elseif ($type == 2) {
            $path = Yii::$app->basePath . '/../uploads/profile_uploads/pancard/';
        } elseif ($type == 3) {
            $path = Yii::$app->basePath . '/../uploads/profile_uploads/bank_details/';
        }
        if ($model->save()) {
            if (!empty($files)) {
                $this->upload($model, $files, $path);
            }
        }
        return TRUE;
    }

    /**
     * Upload Material photos.
     * @return mixed
     */
    public function Upload($model, $files, $path) {
        if (isset($files) && !empty($files)) {
            $files->saveAs($path . $model->id . '.' . $files->extension);
        }
        return TRUE;
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['dashboard/index']);
        }

        $this->layout = 'login';
        $model = new Employee();
        $model->scenario = 'login';
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            return $this->redirect(['dashboard/index']);
        } else {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout() {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup() {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
                    'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset() {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
                    'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token) {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
                    'model' => $model,
        ]);
    }

    public function actionForgot() {
        date_default_timezone_set("Asia/Dubai");
        $this->layout = 'login';
        $model = new Employee();
        if ($model->load(Yii::$app->request->post())) {
            $check_exists = Employee::find()->where(['user_name' => $model->user_name])->orWhere(['email' => $model->user_name])->one();
            if (!empty($check_exists)) {
                $token_value = $this->tokenGenerator();
                $token = $check_exists->id . '_' . $token_value;
                $val = base64_encode($token);
                $token_model = new ForgotPasswordTokens();
                $token_model->user_id = $check_exists->id;
                $token_model->token = $token_value;
                $token_model->date = date('Y-m-d h:m:s');
                $token_model->save();
                $this->sendMail($val, $check_exists->email);
                $msg = "Reset password link has been sent to your email ID(" . $check_exists->email . "). The link will expire in 15 minutes. If you couldn't find the mail in your inbox check you spam box.";
                Yii::$app->getSession()->setFlash('success', $msg);
            } else {
                Yii::$app->getSession()->setFlash('error', 'Invalid username or email');
            }
            return $this->render('forgot-password', [
                        'model' => $model,
            ]);
        } else {
            return $this->render('forgot-password', [
                        'model' => $model,
            ]);
        }
    }

    public function tokenGenerator() {

        $length = rand(1, 1000);
        $chars = array_merge(range(0, 9));
        shuffle($chars);
        $token = implode(array_slice($chars, 0, $length));
        return $token;
    }

    public function sendMail($val, $email) {

//        echo '<a href="' . Yii::$app->homeUrl . 'site/new-password?token=' . $val . '">Click here change password</a>';
//        exit;
        $to = $email;

// subject
        $subject = 'Change password';

// message
        echo
        $message = '
<html>
<head>
  <title>Forgot Password</title>
</head>
<body>
  <p>As requested, here is a link to allow you to select a new password:</p>
  <table>

     <tr>
      <td><a href="' . Yii::$app->homeUrl . 'site/new-password?token=' . $val . '">Click here for reset your password</a></td>
    </tr>

  </table>
</body>
</html>
';

        exit;
// To send HTML mail, the Content-type header must be set
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n" .
                "From: 'no-reply@emperor.ae";
        mail($to, $subject, $message, $headers);
    }

    public function actionNewPassword($token) {
        date_default_timezone_set("Asia/Dubai");
        $this->layout = 'login';
        $data = base64_decode($token);
        $values = explode('_', $data);
        $token_exist = ForgotPasswordTokens::find()->where("user_id = " . $values[0] . " AND token = " . $values[1])->one();
        if (!empty($token_exist)) {
            $model = Employee::find()->where("id = " . $token_exist->user_id)->one();
            if (Yii::$app->request->post()) {
                if (Yii::$app->request->post('new-password') == Yii::$app->request->post('confirm-password')) {
                    $model->password = Yii::$app->security->generatePasswordHash(Yii::$app->request->post('confirm-password'));
                    if ($model->update()) {
                        Yii::$app->session['change-pwd-success-msg'] = 'password changed successfully';
                    }
                    $token_exist->delete();
                    $this->redirect('index');
                } else {
                    Yii::$app->getSession()->setFlash('error', 'password mismatch  ');
                }
            }
            return $this->render('new-password', [
            ]);
        } else {
            Yii::$app->session['change-pwd-error-msg'] = "This password reset link is expired. Please try again.";
            $this->redirect('index');
        }
    }

}
