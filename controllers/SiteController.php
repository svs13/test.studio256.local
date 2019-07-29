<?php

namespace app\controllers;

use app\models\Post;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

/**
 * Корень сайта
 *
 * Class SiteController
 * @package app\controllers
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     * @return array
     */
    public function actions(): array
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex(): string
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Post::find()->with('author', 'category')->orderBy(['created_at' => SORT_DESC]),
            'sort' => false,
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
