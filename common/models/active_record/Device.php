<?php

namespace common\models\active_record;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "device".
 *
 * @property int $id
 * @property string $serial_number
 * @property int $store_id
 * @property string $created_at
 * @property string $upated_at
 * @property Store $store
 */
class Device extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'device';
    }
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => function () {
                    return Yii::$app->formatter->asDatetime(time());
                }
            ]
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['serial_number', 'store_id'], 'required'],
            [['store_id'], 'integer'],
            [['created_at'], 'safe'],
            [['serial_number'], 'string', 'max' => 255],
            [['serial_number'], 'unique'],
            [['store_id'], 'exist', 'skipOnError' => true, 'targetClass' => Store::class, 'targetAttribute' => ['store_id' => 'id']],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'serial_number' => 'Serial Number',
            'store_id' => 'Store',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Store]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStore()
    {
        return $this->hasOne(Store::class, ['id' => 'store_id']);
    }
    public static function getStoreList()
    {
        return \yii\helpers\ArrayHelper::map(Store::find()->all(), 'id', 'name');
    }
}
