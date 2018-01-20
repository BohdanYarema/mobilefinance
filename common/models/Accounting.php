<?php

namespace common\models;

use common\models\query\AccountingQuery;
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
 * @property integer $user_id
 * @property integer $gps_id
 * @property integer $gps_status
 * @property string $name
 * @property integer $type
 * @property string $gps_title
 *
 * @property TagToAccounting[] $tagToAccountings
 */
class Accounting extends \yii\db\ActiveRecord
{
    const STATUS_DRAFT  = 0;
    const STATUS_ACTIVE = 1;

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
            [['category_id'], 'required'],
            [['price', 'gps_x', 'gps_y'], 'number'],
            [['status', 'created_at', 'updated_at', 'category_id', 'user_id', 'gps_id', 'gps_status'], 'integer'],
            [['name', 'gps_title'], 'string', 'max' => 1024],
            [['user_id'], 'default', 'value' => Yii::$app->user->id],
            [['dates'], 'default', 'value' => function () {
                return date(DATE_ISO8601);
            }],
            [['dates'], 'filter', 'filter' => 'strtotime', 'skipOnEmpty' => true],
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
            'gps_id'        => 'GPS Id',
            'gps_title'     => 'GPS Title',
            'gps_x'         => 'GPS Coords x',
            'gps_y'         => 'GPS Coords y',
            'gps_status'    => 'GPS Status',
            'dates'         => 'Dates',
            'status'        => 'Status',
            'name'          => 'Name',
            'category_id'   => 'Category',
            'user_id'       => 'User id',
            'created_at'    => 'Created At',
            'updated_at'    => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTagToAccountings()
    {
        return $this->hasMany(TagToAccounting::className(), ['accounting_id' => 'id']);
    }

    /**
     * @return AccountingQuery
     */
    public static function find()
    {
        return new AccountingQuery(get_called_class());
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            if ($this->gps_status == 0 && $this->gps_id > 0){
                $data = GpsData::findOne($this->gps_id);

                $this->gps_x        = $data->gps_x;
                $this->gps_y        = $data->gps_y;
                $this->gps_title    = $data->name;
            }

            return true;
        }
        return false;
    }
}
