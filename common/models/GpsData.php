<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "gps_data".
 *
 * @property int $id
 * @property float $gps_x
 * @property float $gps_y
 * @property string $name
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class GpsData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gps_data';
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
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['gps_x', 'gps_y'], 'double'],
            [['name'], 'string', 'max' => 512],
            [['status'], 'default', 'value' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'            => 'ID',
            'gps_x'         => 'Gps X',
            'gps_y'         => 'Gps Y',
            'name'          => 'Name',
            'status'        => 'Status',
            'created_at'    => 'Created At',
            'updated_at'    => 'Updated At',
        ];
    }
}
