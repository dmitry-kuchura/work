<?php

/**
 * Class ApiController all request for our API gateway
 */
class ApiController extends MainController
{
    public $post;
    public $raw;

    /**
     * Define $_POST data
     *
     * @param $action
     * @return bool
     */
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
                    'method' => 'create',
                    'table' => $model->tableName(),
                    'html' => $this->show('api/user-data', [
                        'obj' => $model,
                    ]),
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
                    'method' => 'update',
                    'table' => $model->tableName(),
                    'data' => [
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
                    'method' => 'create',
                    'table' => $model->tableName(),
                    'html' => $this->show('api/company-data', [
                        'obj' => $model,
                    ]),
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
                    'method' => 'update',
                    'table' => $model->tableName(),
                    'data' => [
                        'id' => $id,
                        'name' => $data['name'],
                        'quota' => $data['quota'],
                        'quota_type' => $data['quota_type'],
                    ],
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
            // 1 GB to 100 GB
            $minBytes = 1000000000;
            $maxBytes = 100000000000;

            $model->user_id = Users::model()->find(['select' => '*, rand() as rand', 'order' => 'rand'])->id;
            $model->date_time = $faker->dateTimeThisMonth($max = '+6 month')->getTimestamp();
            $model->resource = $faker->freeEmailDomain;
            $model->transferred = rand($minBytes, $maxBytes);

            $model->save(false);
        }

        $this->renderJSON([
            'success' => true,
            'message' => 'Transfer data was generated!',
        ]);

    }

    /**
     * Method for generate report all companies
     */
    public function actionGetReport()
    {
        $month = $this->raw->month;
        $result = Yii::app()->db->createCommand('SELECT
                MONTH(FROM_UNIXTIME(`transfer_logs`.`date_time`)) AS `month`,
                SUM(`transfer_logs`.`transferred`) AS `transferred`,
                `companies`.`quota` AS `quota`,
                `companies`.`name` AS `company_name`
            FROM `transfer_logs`
            LEFT JOIN `users` ON `users`.`id` = `transfer_logs`.`user_id`
            LEFT JOIN `companies` ON `users`.`company_id` = `companies`.`id`
            GROUP BY `month`, `company_name`
            HAVING `month` = ' . $month . '
            ORDER BY `month` ASC')->setFetchMode(PDO::FETCH_OBJ)->queryAll();

        $this->renderJSON([
            'success' => true,
            'result' => $this->show('api/report', [
                'result' => $result,
                'months' => Yii::app()->params['months'],
                'month' => $month,
            ]),
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