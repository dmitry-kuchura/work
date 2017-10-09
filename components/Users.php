<?php

class Users extends CWidget
{
    public function run()
    {
        $result = Users::model()->findByPk(1);

        var_dump($result);
        die;

        $this->render('users');
    }
}