<?php

namespace app\controllers;

use app\models\Post;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Действия с постами
 *
 * Class PostsController
 * @package app\controllers
 */
class PostsController extends Controller
{

    /**
     * Displays a single Post model.
     * @param string $id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView(string $id): string
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(string $id): Post
    {
        $model = Post::findOne($id);

        if (empty($model)) {
            throw new NotFoundHttpException('Not found');
        }

        return $model;
    }
}
