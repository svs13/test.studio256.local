<?php

namespace app\controllers\api\v1;

use app\controllers\api\ApiController;
use app\models\Post;
use yii\data\ActiveDataProvider;

/**
 * Действия с постами
 *
 * Class PostsController
 * @package app\controllers\api\v1
 */
class PostsController extends ApiController
{
    public $modelClass = Post::class;

    /**
     * @return array
     */
    public function verbs()
    {
        return [
            'index' => ['GET'],
            'view' => ['GET'],
            'create' => [],
            'update' => ['POST'],
            'delete' => ['DELETE'],
            'options' => []
        ];
    }

    /**
     * @return array
     */
    public function actions()
    {
        $actions = parent::actions();

        /** Отключение не нежных */
        unset($actions['create'], $actions['options']);

        /** настроить подготовку провайдера данных с помощью метода "prepareDataProvider()" */
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

        return $actions;
    }

    /**
     * @return ActiveDataProvider
     */
    public function prepareDataProvider()
    {
        return new ActiveDataProvider([
            'query' => Post::find()
                ->with('category','author')
                ->orderBy(['created_at' => SORT_DESC]),
            'pagination' => [
                'pageSize' => 100,
            ],
            'sort' => false,
        ]);
    }
}
