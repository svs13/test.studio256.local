<?php

use yii\db\Migration;

/**
 * Добавление таблицы "Посты"
 *  title - Название
 *  slug - Slug
 *  content - Пост
 *  lead - Краткое описание
 *  created_at - Дата создания
 *  updated_at - Дата изменения
 *
 * Внешние ключи:
 *  author_id - Автор
 *  category_id - Категория
 */
class m190729_123301_create_posts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%posts}}', [
            'id' => $this->bigPrimaryKey()->unsigned(),
            'author_id' => $this->bigInteger()->notNull()->unsigned(),
            'category_id' => $this->bigInteger()->notNull()->unsigned(),
            'title' => $this->string()->notNull(),
            'slug' => $this->string()->notNull(),
            'content' => $this->text()->notNull(),
            'lead' => $this->string()->notNull(),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp(),
        ]);

        $this->createIndex(
            '{{%idx-posts-author_id}}',
            '{{%posts}}',
            'author_id'
        );

        $this->addForeignKey(
            '{{%fk-posts-author_id}}',
            '{{%posts}}',
            'author_id',
            '{{%authors}}',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            '{{%idx-posts-category_id}}',
            '{{%posts}}',
            'category_id'
        );

        $this->addForeignKey(
            '{{%fk-posts-category_id}}',
            '{{%posts}}',
            'category_id',
            '{{%categories}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            '{{%fk-posts-author_id}}',
            '{{%posts}}'
        );

        $this->dropIndex(
            '{{%idx-posts-author_id}}',
            '{{%posts}}'
        );

        $this->dropForeignKey(
            '{{%fk-posts-category_id}}',
            '{{%posts}}'
        );

        $this->dropIndex(
            '{{%idx-posts-category_id}}',
            '{{%posts}}'
        );

        $this->dropTable('{{%posts}}');
    }
}
