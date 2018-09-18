<?php

use yii\db\Migration;

/**
 * Handles the creation of table `agentPoints`.
 */
class m180918_093141_create_agentPoints_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('agentPoints', [
            'id' => $this->primaryKey(),
            'agentId' => $this->integer(),
            'category_id' => $this->integer(),
            'point' => $this->double(),
            'created_at' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('agentPoints');
    }
}
