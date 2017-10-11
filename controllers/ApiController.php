<?php

class ApiController extends MainController
{
    public $post;
    public $raw;

    protected function beforeAction($action)
    {
        $this->post = $_POST;
        $this->raw = json_decode(Yii::app()->request->getRawBody());;

        return true;
    }

    /**
     * Method for AJAX Request for create new User
     *
     * @return mixed|string
     *
     */
    public function actionCreateUser()
    {
        $model = new Users();

        if ($this->post) {
            $data = $this->post['Users'];
            $model->name = $data['name'];
            $model->email = $data['email'];
            $model->company_id = $data['company_id'];

            if ($model->validate() && $model->save()) {
                $this->renderJSON([
                    'success' => true,
                    'message' => 'User created!',
                    'table' => $model->tableName(),
                    'data' => $data,
                ]);
            } else {
                $this->renderJSON([
                    'success' => false,
                    'message' => 'Not created!',
                ]);
            }
        }

        return $this->renderPartial('user-form', [
            'model' => $model,
            'companies' => Companies::getCompaniesAsArray(),
        ]);
    }

    /**
     * Method for AJAX Request for create new Company
     *
     * @return mixed|string
     */
    public function actionCreateCompany()
    {
        $model = new Companies();

        if ($this->post) {
            $data = $this->post['Companies'];
            $model->name = $data['name'];
            $model->quota_type = $data['quota_type'];
            $model->quota = Helper::revertFileSizeConvert($data['quota'], $data['quota_type']);
            $model->created_at = time();
            $model->updated_at = time();

            if ($model->validate() && $model->save()) {
                $this->renderJSON([
                    'success' => true,
                    'message' => 'Company created!',
                    'table' => $model->tableName(),
                    'data' => $data,
                ]);
            } else {
                $this->renderJSON([
                    'success' => false,
                    'message' => 'Not created!',
                ]);
            }
        }

        return $this->renderPartial('company-form', [
            'model' => $model,
            'types' => Yii::app()->params['types'],
        ]);
    }

    /**
     * This method deleted current row from database in needed table
     */
    public function actionDelete()
    {
        $command = Yii::app()->db->createCommand();
        if ($command->delete($this->raw->table, 'id=:id', [':id' => $this->raw->id])) {
            $this->renderJSON([
                'success' => true,
                'message' => 'Record deleted!',
            ]);
        } else {
            $this->renderJSON([
                'success' => false,
                'message' => 'Not deleted. Some want wrong!',
            ]);
        }
    }
}