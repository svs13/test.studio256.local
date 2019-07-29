<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * Пост
 * Должен быть связан с автором и с категорией
 *
 * @property string $id
 * @property string $author_id
 * @property string $category_id
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property string $lead
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Author $author
 * @property Category $category
 */
class Post extends ActiveRecord
{
    /**
     * {@inheritdoc}
     * @return string
     */
    public static function tableName(): string
    {
        return 'posts';
    }

    /**
     * @return array
     */
    public function behaviors(): array
    {
        return ArrayHelper::merge([
            /** Запись дат created_at, updated_at соответственно перед вставкой и перед обновлением данных */
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ]
        ], parent::behaviors());
    }

    /**
     * {@inheritdoc}
     * @return array
     */
    public function rules(): array
    {
        return [
            [['author_id', 'category_id', 'title', 'slug', 'content', 'lead'], 'required'],
            [['author_id', 'category_id'], 'integer'],
            [['content'], 'string'],
            [['title', 'slug', 'lead'], 'string', 'max' => 255],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Author::class, 'targetAttribute' => ['author_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'author_id' => 'Автор',
            'category_id' => 'Категория',
            'title' => 'Название',
            'slug' => 'Slug',
            'content' => 'Пост',
            'lead' => 'Краткое описание',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата изменения',
            'author.name' => 'Автор',
            'category.title' => 'Категория',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getAuthor(): ActiveQuery
    {
        return $this->hasOne(Author::class, ['id' => 'author_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getCategory(): ActiveQuery
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }
}
