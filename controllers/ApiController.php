<?php

/**
 * Class ApiController all request for our API gateway
 */
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
                    'method' => 'create',
                    'data' => [
                        'id' => $model->id,
                        'name' => $model->name,
                        'email' => $model->email,
                        'company' => $model->company->name,
                    ],
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
     * Update User in database
     *
     * @param $id
     * @return mixed|string
     */
    public function actionUpdateUser($id)
    {
        $model = Users::model()->findByPk($id);

        if ($this->post) {
            $data = $this->post['Users'];
            $model->name = $data['name'];
            $model->email = $data['email'];
            $model->company_id = $data['company_id'];

            if ($model->validate() && $model->save()) {
                $this->renderJSON([
                    'success' => true,
                    'message' => 'User updated!',
                    'table' => $model->tableName(),
                    'method' => 'update',
                    'update' => [
                        'id' => $id,
                        'name' => $data['name'],
                        'email' => $data['email'],
                        'company' => $model->company->name,
                    ],
                ]);
            } else {
                $this->renderJSON([
                    'success' => false,
                    'message' => 'Not updated!',
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
     * Update company row in table
     *
     * @param $id
     * @return mixed|string
     */
    public function actionUpdateCompany($id)
    {
        $model = Companies::model()->findByPk($id);

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
                    'message' => 'Company updated!',
                    'table' => $model->tableName(),
                    'data' => $data,
                ]);
            } else {
                $this->renderJSON([
                    'success' => false,
                    'message' => 'Not updated!',
                ]);
            }
        }

        return $this->renderPartial('company-form', [
            'model' => $model,
            'types' => Yii::app()->params['types'],
        ]);
    }

    /**
     * Method for generate custom data with Faker
     * @link https://github.com/fzaninotto/Faker
     */
    public function actionGenerateTransferLog()
    {
        for ($i = 1; $i <= 500; $i++) {
            $faker = Faker\Factory::create();
            $model = new TransferLogs();
            // 10 GB to 1 TB
            $minBytes = 10000000000;
            $maxBytes = 1000000000000;

            $model->user_id = Users::model()->find(['select' => '*, rand() as rand', 'order' => 'rand'])->id;
            $model->date_time = $faker->dateTimeThisMonth($max = '+6 month')->getTimestamp();
            $model->resource = $faker->freeEmailDomain;
            $model->transferred = rand($minBytes, $maxBytes);

            if ($model->save()) {
                $this->renderJSON([
                    'success' => true,
                    'message' => 'Transfer data was generated!',
                ]);
            } else {
                $this->renderJSON([
                    'success' => false,
                    'message' => 'Transfer data was not generated!',
                ]);
            }
        }

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