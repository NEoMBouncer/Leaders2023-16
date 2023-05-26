<?php

use yii\db\Migration;

/**
 * Class m230526_144255_create_table_citizenship
 */
class m230526_144255_create_table_citizenship extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%citizenship}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%citizenship}}');
    }
}
