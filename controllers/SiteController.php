<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\User;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
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
     * {@inheritdoc}
     */
    public function actions()
    {
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
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Register action.
     *
     * @return Response|string
     */
    public function actionRegister()
    {
        return $this->render('register');
    }

     /**
     * Create User action.
     *
     * @return Response|string
     */
    public function actionCreateUser()
    {
        $request = Yii::$app->request->post();

        //if password_confirmation is not in request go back
        if(!$request['password_confirmation'] || ($request['password'] != $request['password_confirmation']))
        {
            $this->goBack();
        }

        $user = new User();
        $user->attributes = $request;
        $user->password = Yii::$app->getSecurity()->generatePasswordHash($user->password);

        if($user->validate() && $user->save())
        {
            return $this->redirect(['site/login']);
        }else
        {
            //Make the register page show validation errors if they are any
            return $this->goBack();
        }

        
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        return $this->render('login');
    }

     /**
     * Process Login action.
     *
     * @return Response|string
     */
    public function actionProcessLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $user = new User();
        $request = Yii::$app->request->post();
        $user->attributes = $request;
        if ($user->login())
        {
            return $this->redirect(['friend/index']);

        }else
        {
            var_dump($user);
            exit();
        }

        // $user->password = '';
        // return $this->render('login', [
        //     'user' => $user,
        // ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}
