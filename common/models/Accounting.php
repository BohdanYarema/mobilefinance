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
 * @property integer $dates
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $category_id
 * @property string $name
 * @property string $thumbnail_base_url
 * @property string $thumbnail_path
 */
class Accounting extends \yii\db\ActiveRecord
{
    /**
     * @var array
     */
    public $thumbnail;


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
            [
                'class' => UploadBehavior::className(),
                'attribute' => 'thumbnail',
                'pathAttribute' => 'thumbnail_path',
                'baseUrlAttribute' => 'thumbnail_base_url'
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price'], 'number'],
            [['thumbnail'], 'safe'],
            [['status', 'created_at', 'updated_at', 'category_id'], 'integer'],
            [['name', 'thumbnail_base_url', 'thumbnail_path'], 'string', 'max' => 1024],
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
            'dates'         => 'Dates',
            'status'        => 'Status',
            'thumbnail'     => 'Thumbnail',
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
