<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = $model->username;
?>
<div class="users-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'name',
            'in_group:boolean',
        ],
    ]) ?>
    
    <?= Html::a(Yii::t('app', 'Back'), ['/users/index'], ['class'=>'btn btn-default pull-right']) ?>

</div>
