<?php

use yii\helpers\Html;
use yii\grid\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Group Blog | Feeds List';
?>
<div class="feeds-index">

    <?php Pjax::begin(); ?>
        <div class="panel panel-success">
            <div class="panel-heading"> <?= $model->title ?> </div>
            <div class="panel-body">
                <?= $model->content ?>
            </div>
            <div class="panel-footer">
                <h4>Comments</h4>
                    <?php if (count($model->comments) == 0): ?>
                        No comments yet
                    <?php  else:
                                foreach ($model->comments as $comment):
                                    print "<li>$comment->content</li><br/>";  
                                endforeach;  
                                                   
                            endif; 
                    ?>

                    <?= Html::beginForm(['feeds/add-comment'], 'post', ['data-pjax' => '', 'class' => 'form-inline', 'id' => 'comment_to_' . $model->id]); ?>
                        <?= Html::hiddenInput('feed_id', $model->id); ?>
                        <?= Html::textarea('content_' . $model->id, Yii::$app->request->post('content'), ['class' => 'form-control', 'cols' => 100, 'rows' => 3]) ?>
                        <?= Html::submitButton('Add comment', ['class' => 'btn btn-default']) ?>
                    <?= Html::endForm() ?>
            
            </div>  
         </div>
    <?php Pjax::end(); ?>
</div>
