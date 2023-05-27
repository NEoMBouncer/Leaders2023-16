<?php

use yii\db\Migration;

/**
 * Class m230526_220255_create_table_course
 */
class m230526_220255_create_table_course extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%course}}', [
            'id' => $this->primaryKey(),
            'date_start' => $this->integer()->notNull(),
            'date_end' => $this->integer()->notNull(),
            'status' => $this->tinyInteger()->defaultValue(0)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%course}}');
    }
}
