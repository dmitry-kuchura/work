<?php

class ApiController extends MainController
{
    public $post;

    protected function beforeAction($action)
    {
        $this->post = json_decode(Yii::app()->request->getRawBody());

        return true;
    }

    public function actionCreateUser()
    {
        var_dump($this->post);
        die;
    }

    public function actionDelete()
    {
        var_dump($this->post);
        die;
    }
}