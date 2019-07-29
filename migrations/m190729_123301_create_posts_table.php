<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%posts}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%authors}}`
 * - `{{%categories}}`
 */
class m190729_123301_create_posts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%posts}}', [
            'id' => $this->primaryKey(),
            'author_id' => $this->bigint()->notNull(),
            'category_id' => $this->bigint()->notNull(),
            'slug' => $this->string()->notNull(),
            'content' => $this->string()->notNull(),
            'lead' => $this->string()->notNull(),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp(),
        ]);

        // creates index for column `author_id`
        $this->createIndex(
            '{{%idx-posts-author_id}}',
            '{{%posts}}',
            'author_id'
        );

        // add foreign key for table `{{%authors}}`
        $this->addForeignKey(
            '{{%fk-posts-author_id}}',
            '{{%posts}}',
            'author_id',
            '{{%authors}}',
            'id',
            'CASCADE'
        );

        // creates index for column `category_id`
        $this->createIndex(
            '{{%idx-posts-category_id}}',
            '{{%posts}}',
            'category_id'
        );

        // add foreign key for table `{{%categories}}`
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
        // drops foreign key for table `{{%authors}}`
        $this->dropForeignKey(
            '{{%fk-posts-author_id}}',
            '{{%posts}}'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            '{{%idx-posts-author_id}}',
            '{{%posts}}'
        );

        // drops foreign key for table `{{%categories}}`
        $this->dropForeignKey(
            '{{%fk-posts-category_id}}',
            '{{%posts}}'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            '{{%idx-posts-category_id}}',
            '{{%posts}}'
        );

        $this->dropTable('{{%posts}}');
    }
}
