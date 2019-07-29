<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Автор
 *
 * @property string $id
 * @property string $name
 *
 * @property Post[] $posts
 */
class Author extends ActiveRecord
{
    /**
     * {@inheritdoc}
     * @return string
     */
    public static function tableName(): string
    {
        return 'authors';
    }

    /**
     * {@inheritdoc}
     * @return array
     */
    public function rules(): array
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
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
            'name' => 'Имя',
            'postsCount' => 'Кол-во постов',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getPosts(): ActiveQuery
    {
        return $this->hasMany(Post::class, ['author_id' => 'id']);
    }

    /**
     * Агрегация для получения кол-ва постов данного автора (для жадной загрузки)
     *
     * @return ActiveQuery
     */
    public function getPostsCountAggregation(): ActiveQuery
    {
        return $this->getPosts()
            ->select(['author_id', 'counted' => 'COUNT(*)'])
            ->groupBy('author_id')
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
