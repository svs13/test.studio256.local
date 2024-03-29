<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * Категория (поста)
 *
 * @property string $id
 * @property string $title
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Post[] $posts
 * @property int $postsCount
 */
class Category extends ActiveRecord
{
    /** Названия категорий */
    protected static $titles;

    /**
     * {@inheritdoc}
     * @return string
     */
    public static function tableName(): string
    {
        return 'categories';
    }

    /**
     * Названия категорий в формате [id => title, ...]
     *
     * @return array
     */
    public static function findTitles(): array
    {
        if (empty(static::$titles)) {
            static::$titles = static::find()
                ->select('title')
                ->indexBy('id')
                ->column();
        }

        return static::$titles;
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
            [['title', 'description'], 'required'],
            [['title', 'description'], 'string', 'max' => 255],
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
            'title' => 'Название',
            'description' => 'Описание',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата изменения',
            'postsCount' => 'Кол-во постов',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getPosts(): ActiveQuery
    {
        return $this->hasMany(Post::class, ['category_id' => 'id']);
    }

    /**
     * Агрегация для получения кол-ва постов данного автора (для жадной загрузки)
     *
     * @return ActiveQuery
     */
    public function getPostsCountAggregation(): ActiveQuery
    {
        return $this->getPosts()
            ->select(['category_id', 'counted' => 'COUNT(*)'])
            ->groupBy('category_id')
            ->asArray(true);
    }

    /**
     * @return int
     */
    public function getPostsCount(): int
    {
        return $this->postsCountAggregation[0]['counted'] ?? 0;
    }
}
