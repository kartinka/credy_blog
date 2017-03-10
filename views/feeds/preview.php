<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Feeds */

$this->title = $feed->title;
?>

<div class="feeds-view">
    
    <div class="panel panel-success">
        <div class="panel-heading"> <?= $feed->title ?> </div>
        <div class="panel-body">
            <?= $feed->content ?>
        </div>
        <div class="panel-footer">
            <h4>Comments</h4>
                <?php if (count($feed->comments) >0):
                            foreach ($feed->comments as $comment):
                                print "<li>$comment->content</li><br/>";  
                            endforeach;  
                                               
                        endif; 
                ?>
        </div>
    </div>    

    <?= Html::a(Yii::t('app', 'Back'), ['/feeds/index'], ['class'=>'btn btn-default pull-right']) ?>
</div>
