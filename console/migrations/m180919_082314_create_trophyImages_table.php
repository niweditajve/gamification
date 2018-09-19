<?php

use yii\db\Migration;

/**
 * Handles the creation of table `trophyImages`.
 */
class m180919_082314_create_trophyImages_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('trophyImages', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'filename' => $this->string(),
            'created_at' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('trophyImages');
    }
}
