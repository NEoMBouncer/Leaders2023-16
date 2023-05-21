<?php

use yii\db\Migration;

/**
 * Class m230520_094900_add_table_candidate
 */
class m230520_094900_add_table_candidate extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%internship_direction}}', [
            'id' => $this->primaryKey(),
            'supervisor_id' => $this->integer()->null(),
            'title' => $this->string(),
            'slogan' => $this->string(),
            'description' => $this->text(),
            'internship_places' => $this->text()->notNull(),
            'is_deleted' => $this->smallInteger(1)->defaultValue(0)
        ]);

        $this->createTable('{{%candidate}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'direction_id' => $this->integer()->null(),
            'universities' => $this->text()->notNull(),
            'education' => $this->text()->notNull(),
            'experience' => $this->text()->notNull(),
            'is_recommended' => $this->smallInteger(1)->defaultValue(0),
            'testing_status' => $this->integer()->defaultValue(0),
            'is_deleted' => $this->smallInteger(1)->defaultValue(0)
        ]);

        $this->createTable('{{%candidate_order}}', [
            'id' => $this->primaryKey(),
            'candidate_id' => $this->integer(),
            'status' => $this->integer(),
            'approved_by' => $this->integer()->defaultValue(null),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%candidate}}');
    }
}
