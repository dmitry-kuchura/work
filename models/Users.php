<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property integer $company_id
 *
 * @property Companies $company
 */
class Users extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'users';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return [
            ['name, email, company_id', 'required'],
            ['company_id', 'numerical', 'integerOnly' => true],
            ['name', 'length', 'max' => 150],
            ['email', 'length', 'max' => 50],
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
            'email' => 'Email',
            'company_id' => 'Company',
        ];
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return [
            'company' => [self::BELONGS_TO, 'Companies', 'company_id'],
        ];
    }

    /**
     * @param string $className active record class name.
     * @return Users the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
