<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\bootstrap\Nav;

\array_unshift($this->params['breadcrumbs'], ['label' => 'Админ-панель', 'url' => ['/admin/authors']]);
?>

<?php $this->beginContent('@app/views/layouts/main.php'); ?>
    <div class="row">
        <div class="col-xs-2">
            <?= Nav::widget([
                'options' => ['class' => 'nav nav-tabs nav-pills'],
                'items' => [
                    ['label' => 'Авторы', 'url' => ['/admin/authors']],
                    ['label' => 'Категории', 'url' => ['/admin/categories']],
                    ['label' => 'Посты', 'url' => ['/admin/posts']],
                ],
            ]);
            ?>
        </div>
        <div class="col-xs-10">
            <?= $content; ?>
        </div>
    </div>

<?php $this->endContent(); ?>
