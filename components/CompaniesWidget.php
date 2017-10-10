<?php

class CompaniesWidget extends CWidget
{
    /**
     * Widget class for display Companies list at main page
     */
    public function run()
    {
        $result = Companies::model()->findAll();

        $this->render('companies', [
            'result' => $result,
        ]);
    }
}