<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\SignupForm;
use app\models\User;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
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
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'onAuthSuccess'],
            ],
        ];
    }


    public function onAuthSuccess($client)
    {
        $attributes = $client->getUserAttributes();
        // user login or signup comes here
        $session = Yii::$app->session;
        $session->set('user', $attributes);

    }


    public function actionIndex()
    {
        $session = Yii::$app->session;

        if($session->has('user')) {
            $model = new SignupForm();
            $model->attributes = $session->get('user');


            print_r(Yii::$app->params['api_key']);

            return $this->render('form', [
                'model' => $model
            ]);
        }

        return $this->render('index');
    }

    /**
     * Signup action.
     *
     * @return string
     */
    public function actionSignup()
    {

        $model = new SignupForm();

        if($model->load(Yii::$app->request->post()) && $model->signup()){

            $login = new LoginForm();
            if($login->load(['password'=>Yii::$app->request->post('password'), 'id'=>$model->user_login]) && $login->login()){
                return $this->redirect('/portal',302);
            }
        }

        return $this->goBack((!empty(Yii::$app->request->referrer) ? Yii::$app->request->referrer : null));
    }




}
