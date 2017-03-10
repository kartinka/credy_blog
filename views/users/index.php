<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create New User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'name',
            'in_group:boolean',

[
            'class' => \yii\grid\ActionColumn::className(),
            'header' => Yii::t('app', 'Actions'),
            'buttons'=>[
                   'preview' => function ($url, $model) {
                             return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-eye-open"></span>', 
                                 Url::toRoute('/users/preview/' . $model->id),
                                 ['title' => Yii::t('yii', 'Preview'), 'data-pjax' => '0']);
                                                                        
                    },
                   'update' => function ($url, $model) {
                             return (Yii::$app->user->id == $model->id ?
                                 \yii\helpers\Html::a( '<span class="glyphicon glyphicon-pencil"></span>', 
                                     Url::toRoute('/users/update/' . $model->id),
                                     ['title' => Yii::t('yii', 'Update'), 'data-pjax' => '0'])
                                     : ''
                              );
                    },                  
                   'delete' => function ($url, $model) {
                             return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-trash"></span>', 
                                 Url::toRoute('/users/delete/' . $model->id),
                                 ['title' => Yii::t('yii', 'Delete'), 
                                 'data-confirm' => Yii::t('yii', 'Are you sure to delete user: ' . $model->username. '?'),
                                 'data-method' => 'post',]);
                                                                        
                    },
                   'invite' => function ($url, $model) {
                             return (Yii::$app->user->id != $model->id ? 
                                 \yii\helpers\Html::a('<span class="glyphicon glyphicon-heart' . ($model->in_group ? '': '-empty'). '"></span>', 
                                     Url::toRoute('/users/invite/' . $model->id),
                                     ['title' => Yii::t('yii', ($model->in_group ? Yii::t('yii', 'Remove from Group'): Yii::t('yii', 'Invite to Group'))), 
                                     'data-confirm' => Yii::t('yii', 'Are you sure to ' . ($model->in_group ? 'remove': 'invite') . ' user "' . $model->username . '"' . ($model->in_group ? ' from': ' to') . ' the group?'),
                                     'data-method' => 'post',])
                                     : ''
                            );     
                    },                    
             ],
            'template' => '{preview} &nbsp; {update} &nbsp; {delete} &nbsp; {invite}',
            ],
        ],
    ]); ?>
</div>
