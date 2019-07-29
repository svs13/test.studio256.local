<?php

/** @var $model \app\models\Post */

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>

<div class="post">
    <h2><?= Html::a(Html::encode($model->title), ['/posts/view', 'id' => $model->id]); ?></h2>
    <p><?= HtmlPurifier::process($model->lead) ?></p>
    <p>
        Автор: <?= $model->author->name; ?>
        <br>
        Дата: <?= $model->created_at; ?>
    </p>
</div>
