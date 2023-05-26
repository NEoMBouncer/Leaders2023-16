<?php

use yii\db\Migration;

/**
 * Class m230526_073643_create_table_vacancy
 */
class m230526_073643_create_table_vacancy extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%vacancy}}', [
            'id' => $this->primaryKey(),
            'organization_id' => $this->integer()->notNull(),
            'title' => $this->string(),
            'status' => $this->tinyInteger()->notNull(),
            'created_by' => $this->integer(),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%vacancy}}');
    }
}
