<?php

namespace app\controllers;

use yii\web\Controller;

class FriendsController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }

}