<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "car_link".
 *
 * @property int $id
 * @property string $link
 * @property int $av_id
 * @property int $price_usd
 * @property int $price_byn
 * @property string $image
 * @property int $created_at
 * @property int $updated_at
 */
class CarLink extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'car_link';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['av_id', 'price_usd', 'price_byn', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['av_id', 'price_usd', 'price_byn', 'created_at', 'updated_at'], 'integer'],
            [['link', 'image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'link' => 'Link',
            'av_id' => 'Av ID',
            'price_usd' => 'Price Usd',
            'price_byn' => 'Price Byn',
            'image' => 'Image',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
