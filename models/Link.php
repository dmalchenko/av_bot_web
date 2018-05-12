<?php

namespace app\models;

use Yii;
use yii\base\Event;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\AttributesBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "link".
 *
 * @property int $id
 * @property string $link
 * @property int $link_hash
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $expired_at
 */
class Link extends ActiveRecord
{
    const STATUS_ACTIVE = 10;
    const STATUS_DISABLE = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'link';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['link_hash', 'status', 'created_at', 'updated_at', 'expired_at'], 'default', 'value' => null],
            [['link_hash', 'status', 'created_at', 'updated_at', 'expired_at'], 'integer'],
            [['link'], 'string', 'max' => 1024],
            [['link'], 'trim'],
            [['link'], 'url'],
            [['link'], function ($attribute) {
                if (mb_strpos($this->$attribute, 'https://cars.av.by/search') !== 0)
                    $this->addError('link', 'Invalid link, example https://cars.av.by/search?brand_id%5B0%5D=6&model_id%5B0%5D=15&year_from=&year_to=&currency=USD&price_from');
            }],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'timestamp' => TimestampBehavior::class,
            'attributes' => [
                'class' => AttributesBehavior::class,
                'attributes' => [
                    'link_hash' => [
                        ActiveRecord::EVENT_BEFORE_INSERT => function (Event $event) {
                            return crc32($event->sender->link);
                        },
                        ActiveRecord::EVENT_BEFORE_UPDATE => function (Event $event) {
                            return crc32($event->sender->link);
                        },
                    ],
                    'status' => [
                        ActiveRecord::EVENT_BEFORE_INSERT => self::STATUS_ACTIVE,
                    ],
                    'expired_at' => [
                        ActiveRecord::EVENT_BEFORE_INSERT => function (Event $event) {
                            return $event->sender->created_at + 86400 * 30;
                        }
                    ]
                ],
            ]
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
            'link_hash' => 'Link Hash',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function delete()
    {
        $this->status = self::STATUS_DISABLE;
        $this->update(false);
    }
}
