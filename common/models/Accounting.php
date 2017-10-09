<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "accounting".
 *
 * @property integer $id
 * @property double $price
 * @property integer $dates
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Accounting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'accounting';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className()
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price'], 'number'],
            [['dates', 'status', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'            => 'ID',
            'price'         => 'Price',
            'dates'         => 'Dates',
            'status'        => 'Status',
            'created_at'    => 'Created At',
            'updated_at'    => 'Updated At',
        ];
    }
}
