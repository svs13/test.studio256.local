<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\widgets\ListView;

?>
<h1> Последние записи </h1>
<div class="site-index">
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_post',
        'summary' => '',
    ]); ?>
</div>
