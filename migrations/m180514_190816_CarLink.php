<?php

use yii\db\Migration;

/**
 * Class m180514_190816_CarLink
 */
class m180514_190816_CarLink extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('car_link', [
            'id' => $this->primaryKey(),
            'link' => $this->string(),
            'av_id' => $this->integer(),
            'price_usd' => $this->integer(),
            'price_byn' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('car_link');
    }
}
