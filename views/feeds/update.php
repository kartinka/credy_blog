<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Feeds */

$this->title = 'Update: ' . $model->title;
?>
<div class="feeds-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
