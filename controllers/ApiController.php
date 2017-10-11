<?php

class ApiController extends MainController
{
    public $post;

    protected function beforeAction($action)
    {
        $this->post = $_POST;

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
            }
        }

        return $this->renderPartial('company-form', [
            'model' => $model,
            'types' => Yii::app()->params['types'],
        ]);
    }

    public function actionDelete()
    {
        var_dump($this->post);
        die;
    }
}