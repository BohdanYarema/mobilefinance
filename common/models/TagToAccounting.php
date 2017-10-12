<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "tag_to_accounting".
 *
 * @property integer $id
 * @property integer $tags_id
 * @property integer $accounting_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Accounting $accounting
 * @property Tags $tags
 */
class TagToAccounting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag_to_accounting';
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
            [['tags_id', 'accounting_id'], 'required'],
            [['tags_id', 'accounting_id', 'created_at', 'updated_at'], 'integer'],
            [['accounting_id'], 'exist', 'skipOnError' => true, 'targetClass' => Accounting::className(), 'targetAttribute' => ['accounting_id' => 'id']],
            [['tags_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tags::className(), 'targetAttribute' => ['tags_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tags_id' => 'Tags ID',
            'accounting_id' => 'Accounting ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccounting()
    {
        return $this->hasOne(Accounting::className(), ['id' => 'accounting_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasOne(Tags::className(), ['id' => 'tags_id']);
    }
}
