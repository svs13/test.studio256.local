<?php

use yii\db\Migration;

/**
 * Добавление таблицы "Авторы"
 *  name - Имя
 */
class m190729_121237_create_authors_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%authors}}', [
            'id' => $this->bigPrimaryKey()->unsigned(),
            'name' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%authors}}');
    }
}
