<?php

use yii\db\Migration;

/**
 * Class m180512_162029_link
 */
class m180512_162029_link extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('link', [
            'id' => $this->primaryKey(),
            'link' => $this->string(1024),
            'link_hash' => $this->bigInteger(),
            'status' => $this->smallInteger(1),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'expired_at' => $this->integer(),
        ]);

        $this->createIndex('idx_link', 'link', 'link_hash');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('link');
    }
}