<?php

namespace common\models;

use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use Imagine\Image\Box;
use Imagine\Image\ImageInterface;
use Imagine\Gd\Imagine;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $name
 * @property string $thumbnail_base_url
 * @property string $thumbnail_path
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Accounting[] $accountings
 */
class Category extends \yii\db\ActiveRecord
{
    const STATUS_DRAFT  = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @var array
     */
    public $thumbnail;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
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
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 512],
            [['thumbnail_base_url', 'thumbnail_path'], 'string', 'max' => 1024],
            [['thumbnail'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'                    => 'ID',
            'name'                  => 'Name',
            'thumbnail_base_url'    => 'Thumbnail Base Url',
            'thumbnail'             => 'Thumbnail',
            'status'                => 'Status',
            'created_at'            => 'Created At',
            'updated_at'            => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountings()
    {
        return $this->hasMany(Accounting::className(), ['category_id' => 'id']);
    }

    /**
     * @return string
     */
    public function getImageUrl()
    {
        return $this->thumbnail_base_url.'/'.$this->thumbnail_path;
    }

    /**
     * @return string
     */
    public function getImagePath()
    {
        return Yii::getAlias("@storage").'/web/source/'.$this->thumbnail_path;
    }

    /**
     * @inheritdoc
     */

    public function afterSave($insert, $changedAttributes){
        parent::afterSave($insert, $changedAttributes);
        $imagine = new Imagine();

        $imagine->open($this->getImagePath())
            ->save($this->getImagePath(), ['quality' => 25]);
    }
}
