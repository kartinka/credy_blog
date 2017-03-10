<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Group Blog | Feeds List';
?>
<div class="feeds-index">

   <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'summary'=>'',
        'viewParams' => ['currentFeed' => $currentFeed],
        'itemView' => '_feed',
    ]);
   ?>

</div>
