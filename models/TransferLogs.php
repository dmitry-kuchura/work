<?php

/**
 * This is the model class for table "transfer_logs".
 *
 * The followings are the available columns in table 'transfer_logs':
 * @property integer $id
 * @property integer $user_id
 * @property integer $date_time
 * @property string $resource
 * @property string $transferred
 *
 * @property Users $user
 */
class TransferLogs extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'transfer_logs';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return [
            ['id, user_id, date_time, resource, transferred', 'required'],
            ['id, user_id, date_time', 'numerical', 'integerOnly' => true],
            ['resource', 'length', 'max' => 150],
            ['transferred', 'length', 'max' => 20],
        ];
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return [
            'user' => [self::BELONGS_TO, 'Users', 'user_id'],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User',
            'date_time' => 'Date Time',
            'resource' => 'Resource',
            'transferred' => 'Transferred',
        ];
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return TransferLogs the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
