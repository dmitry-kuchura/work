<?php

/**
 * This is the model class for table "companies".
 *
 * The followings are the available columns in table 'companies':
 * @property integer $id
 * @property string $name
 * @property string $quota
 * @property string $quota_type
 * @property integer $created_at
 * @property integer $updated_at
 */
class Companies extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'companies';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return [
            ['name, quota_type', 'required'],
            ['created_at, updated_at', 'numerical', 'integerOnly' => true],
            ['name', 'length', 'max' => 50],
            ['quota', 'length', 'max' => 20],
            ['quota_type', 'length', 'max' => 2],
        ];
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return [
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'quota' => 'Quota',
            'quota_type' => 'Quota Type',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @param string $className active record class name.
     * @return Companies the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * Custom method for take companies list as array
     *
     * @return array
     */
    public static function getCompaniesAsArray()
    {
        $companies = [
            '' => 'Select company...',
        ];

        $result = Companies::model()->findAll();

        if ($result) {
            foreach ($result as $obj) {
                $companies[$obj->id] = $obj->name;
            }
        }

        return $companies;
    }
}
