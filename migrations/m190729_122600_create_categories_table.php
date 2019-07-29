<?php

use yii\db\Migration;

/**
 * Добавление таблицы "Категории"
 *  title - Название
 *  description - Описание
 *  created_at - Дата создания
 *  updated_at - Дата изменения
 */
class m190729_122600_create_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%categories}}', [
            'id' => $this->bigPrimaryKey()->unsigned(),
            'title' => $this->string()->notNull(),
            'description' => $this->string()->notNull(),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%categories}}');
    }
}
