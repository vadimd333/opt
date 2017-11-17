<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AutodialSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="autodial-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'src') ?>

    <?= $form->field($model, 'dst') ?>

    <?= $form->field($model, 'did') ?>

    <?= $form->field($model, 'clid') ?>

    <?php // echo $form->field($model, 'wait_que') ?>

    <?php // echo $form->field($model, 'duration') ?>

    <?php // echo $form->field($model, 'billsec') ?>

    <?php // echo $form->field($model, 'disposition') ?>

    <?php // echo $form->field($model, 'operator') ?>

    <?php // echo $form->field($model, 'record') ?>

    <?php // echo $form->field($model, 'uniqueid') ?>

    <?php // echo $form->field($model, 'project') ?>

    <?php // echo $form->field($model, 'cl_online') ?>

    <?php // echo $form->field($model, 'cur_state') ?>

    <?php // echo $form->field($model, 'num_att') ?>

    <?php // echo $form->field($model, 'last_att') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'call_date') ?>

    <?php // echo $form->field($model, 'add_date') ?>

    <?php // echo $form->field($model, 'record_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
