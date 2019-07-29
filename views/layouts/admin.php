<?php

/* @var $this \yii\web\View */
/* @var $content string */

\array_unshift($this->params['breadcrumbs'], ['label' => 'Админ-панель', 'url' => ['/admin/authors']]);
?>

<?php $this->beginContent('@app/views/layouts/main.php'); ?>

    <?= $content; ?>

<?php $this->endContent(); ?>
