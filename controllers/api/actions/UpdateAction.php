<?php

namespace app\controllers\api\actions;

use yii\db\ActiveRecord;
use yii\rest\UpdateAction as RestUpdateAction;
use yii\web\ServerErrorHttpException;

/**
 * Действие обновления
 *
 * Class UpdateAction
 * @package app\controllers\api\actions
 */
class UpdateAction extends RestUpdateAction
{
    /**
     * @param string $id
     * @return ActiveRecord
     * @throws ServerErrorHttpException
     */
    public function run($id): ActiveRecord
    {
        /** @var ActiveRecord $model */
        $model = parent::run($id);
        /**
         * Принудительное обновление данных модели из базы данных,
         * чтобы возвратить только скалярные данные.
         */
        $model->refresh();

        return $model;
    }
}