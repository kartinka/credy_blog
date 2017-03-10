<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Feeds */
/* @var $form yii\widgets\ActiveForm */

$this->registerCssFile('http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css', ['position' => \yii\web\View::POS_END]);
$this->registerJsFile('http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js', ['position' => \yii\web\View::POS_END, 'depends' => 'yii\web\JqueryAsset']);

$this->registerJs("
$(document).ready(function(){
	$('textarea#content').summernote({height: '200px', maximumImageFileSize: 1024000});
});	
");
?>

<div class="feeds-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6, 'id' => 'content']) ?>

    <div class="form-group pull-right">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), ['/feeds/index'], ['class'=>'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
