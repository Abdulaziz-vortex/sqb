<?php

namespace frontend\controllers;

use common\models\CurrencyModel;
use common\models\CurrencySearch;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new CurrencySearch();
        $provider = $model->search(Yii::$app->request->get());
        $pages = $model->pagination;
        $has_chart = Yii::$app->request->get('CurrencySearch')['charCode'] != null;

        return $this->render('index',
            [
                'model' => $model,
                'provider' => $provider,
                'pages' => $pages,
                'has_chart' => $has_chart
            ]
        );
    }

}
