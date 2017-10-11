<?php

class ApiController extends MainController
{
    public $post;

    public $layout = false;

    protected function beforeAction($action)
    {
        $this->post = json_decode(Yii::app()->request->getRawBody());

        return true;
    }

    public function actionCreateUser()
    {
        $model = new Users();

//        if (Yii::app()->request->post()) {
//            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
//                $model->save();
//
//                Yii::$app->response->format = Response::FORMAT_JSON;
//
//                return ['success' => true, 'message' => 'User created!'];
//            }
//        }

        $companies = [
            '' => 'Select company ...',
        ];

        $result = Companies::model()->findAll();


        if ($result) {
            foreach ($result as $obj) {
                $companies[$obj->id] = $obj->name;
            }
        }

        return $this->render('user-form', [
            'model' => $model,
            'companies' => $companies,
        ]);
    }

    public function actionCreateCompany()
    {
        $model = new Companies();

        $types = Yii::app()->params['types'];

        return $this->render('company-form', [
            'model' => $model,
            'types' => $types,
        ]);
    }

    public function actionDelete()
    {
        var_dump($this->post);
        die;
    }
}