<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * Автор
 *
 * @property string $id
 * @property string $name
 *
 * @property Post[] $posts
 * @property int $postsCount
 */
class Author extends ActiveRecord
{
    /** Имена авторов */
    protected static $names;

    /**
     * {@inheritdoc}
     * @return string
     */
    public static function tableName(): string
    {
        return 'authors';
    }

    /**
     * Имена авторов в формате [id => name, ...]
     *
     * @return array
     */
    public static function findNames(): array
    {
        if (empty(static::$names)) {
            static::$names = ArrayHelper::map(
                static::find()->select(['id', 'name'])->asArray()->all(),
                'id',
                'name'
            );
        }

        return static::$names;
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
