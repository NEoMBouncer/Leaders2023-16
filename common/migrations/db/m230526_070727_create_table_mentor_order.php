<?php

use yii\db\Migration;

/**
 * Class m230526_070727_create_table_mentor_order
 */
class m230526_070727_create_table_mentor_order extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%mentor_order}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'organization_id' => $this->integer()->notNull(),
            'title' => $this->string(),
            'status' => $this->tinyInteger()->notNull(),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%mentor_order}}');
    }
}
