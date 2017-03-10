<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Feeds';

?>
<div class="feeds-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create New Feed', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
             [
             'header' => 'Comments',
             'format' => 'html',
             'value' =>  function ($model) {
                             return implode(\yii\helpers\ArrayHelper::map($model->comments, 'id', 'content'), ' <br/> ');                                                            
                    }
            ],

            [
            'class' => \yii\grid\ActionColumn::className(),
            'header' => Yii::t('app', 'Actions'),
            'buttons'=>[
                   'preview' => function ($url, $model) {
                             return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-eye-open"></span>', 
                                 Url::toRoute('/feeds/preview/' . $model->id),
                                 ['title' => Yii::t('yii', 'Preview'), 'data-pjax' => '0']);
                    },
                   'update' => function ($url, $model) {
                             return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-pencil"></span>', 
                                 Url::toRoute('/feeds/update/' . $model->id),
                                 ['title' => Yii::t('yii', 'Update'), 'data-pjax' => '0']);
                                                                        
                    },
                   'delete' => function ($url, $model) {
                             return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-trash"></span>', 
                                 Url::toRoute('/feeds/delete/' . $model->id),
                                 ['title' => Yii::t('yii', 'Delete'), 
                                 'data-confirm' => Yii::t('yii', 'Are you sure to delete feed "' . $model->title. '"?'),
                                 'data-method' => 'post',]);
                                                                        
                    },
             ],
            'template'=>'{preview} &nbsp; {update} &nbsp; {delete}',
            ],
        ],
    ]); ?>
</div>
