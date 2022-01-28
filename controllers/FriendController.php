<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Friend;
use app\models\User;

class FriendController extends Controller
{

    public function actionIsAuthorized($friend)
    {
        $user = User::getAuthUser();
        $friend = Friend::findOne($friend["id"]);

        //replace this with logged in middleware
        if(!$user)
        {
            return "You are not logged in";
            exit();
        }

        if($user->id == $friend["user_id"])
        {
            return true;
        }else
        {
            return false;
        }

    }
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

    public function actionEdit()
    {
        $request = Yii::$app->request->get();
        $id = $request['id'];

        $friend = Friend::findOne($id);
        return $this->render('update', ["friend" => $friend]);
    }

    public function actionUpdate()
    {
        $request = Yii::$app->request->post();
        if($request && $this->actionIsAuthorized($request))
        {
            $id = $request['id'];
            $friend = Friend::findOne($id);
            $friend->attributes = $request;
            $friend->updated_at = Date('Y-m-d H:i:s');

            if($friend->save())
            {
                return $this->redirect(['/friend/index']);
    
            }else
            {
                return "An error occured. Please try again.";
            }

        }else
        {
            return "Bad request. Kindly try again";
        }
    }

    public function actionDestroy()
    {
        
        $request = Yii::$app->request->post();
        if($request && $this->actionIsAuthorized($request))
        {
            $friend = Friend::findOne($request['id']);
            
            if($friend->delete())
            {
                return $this->redirect(['friend/index']);
            }else
            {
                return 'Something went wrong. Please try again';
            }
        }else
        {
            return "Bad request. Kindly try again";
        }
    }

}