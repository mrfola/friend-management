<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Friend;
use app\models\User;

class FriendController extends Controller
{

    public function actionIndex()
    {
        $id = User::getAuthUser()->id;
        $user = User::findOne($id);

        return $this->render('index', ["friends" =>  $user->friends]);
    }

    public function actionStore()
    {
        $user = User::getAuthUser();
        //replace this with logged in middleware
        if(!$user)
        {
            return "You are not logged in";
            exit();
        }

        $request = Yii::$app->request->post();

        if($request)
        {
            $friend = new Friend();
            $friend->attributes = $request;

            if($friend->validate())
            {
                $friend->link('user', $user);
                return $this->redirect(['friend/index']);
            }else
            {
                var_dump($friend);
            }
        }else
        {
            return "bad request";
        }

        

    }

}