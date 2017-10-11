<?php

namespace common\models;

use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "accounting".
 *
 * @property integer $id
 * @property double $price
 * @property double $gps_x
 * @property double $gps_y
 * @property integer $dates
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $category_id
 * @property string $name
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
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price', 'gps_x', 'gps_y'], 'number'],
            [['status', 'created_at', 'updated_at', 'category_id'], 'integer'],
            [['name'], 'string', 'max' => 1024],
            [['dates'], 'filter', 'filter' => 'strtotime', 'skipOnEmpty' => true],
            [['dates'], 'default', 'value' => function () {
                return date(DATE_ISO8601);
            }],
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
            'gps_x'         => 'GPS Coords x',
            'gps_y'         => 'GPS Coords y',
            'dates'         => 'Dates',
            'status'        => 'Status',
            'name'          => 'Name',
            'category_id'   => 'Category',
            'created_at'    => 'Created At',
            'updated_at'    => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCateogry()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
}
