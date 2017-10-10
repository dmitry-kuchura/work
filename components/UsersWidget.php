<?php

class UsersWidget extends CWidget
{
    /**
     *
     */
    public function run()
    {
        $result = Users::model()->findAll();

        $this->render('users', [
            'result' => $result
        ]);
    }
}