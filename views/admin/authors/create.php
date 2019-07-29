<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Author */

$this->title = 'Создание автора';
$this->params['breadcrumbs'][] = ['label' => 'Авторы', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Создание';
?>
<div class="author-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
