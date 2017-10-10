<?php

class UsersWidget extends CWidget
{
    /**
     * Widget class for display Users list at main page
     */
    public function run()
    {
        $result = Users::model()->findAll();

        $this->render('users', [
            'result' => $result
        ]);
    }
}