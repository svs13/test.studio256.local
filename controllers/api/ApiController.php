<?php

namespace app\controllers\api;

use app\controllers\api\actions\UpdateAction;
use yii\rest\ActiveController;

/**
 * Базовый контроллер API
 *
 * Class ApiController
 * @package app\controllers\api
 */
class ApiController extends ActiveController
{
    public function actions()
    {
        $actions = parent::actions();
        $actions['update']['class'] = UpdateAction::class;

        return $actions;
    }
}
