<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category`.
 */
class m180912_061022_create_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('categories', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'content' => $this->string(),
            'point' => $this->double(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('categories');
    }
}
