<?php

class TransferLogsWidget extends CWidget
{
    /**
     * Widget class for display TransferLogs list at main page
     */
    public function run()
    {
        $result = TransferLogs::model()->findAll();

        $this->render('transfer-log', [
            'result' => $result,
            'months' => Yii::app()->params['months'],
        ]);
    }
}