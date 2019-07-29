<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'category.title',
            'lead',
            'content:ntext',
            'slug',
            'author.name',
            'created_at',
            'updated_at',
        ],
        'template' => '<tr><th{captionOptions}>{label}</th></tr> <tr><td{contentOptions}>{value}</td></tr>',
        'options' => [
            'class' => 'table detail-view'
        ],
    ]) ?>

</div>
