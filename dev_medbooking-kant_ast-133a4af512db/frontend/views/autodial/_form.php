<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Autodial */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="autodial-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'src')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dst')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'did')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'clid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wait_que')->textInput() ?>

    <?= $form->field($model, 'duration')->textInput() ?>

    <?= $form->field($model, 'billsec')->textInput() ?>

    <?= $form->field($model, 'disposition')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'operator')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'record')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'uniqueid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'project')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cl_online')->textInput() ?>

    <?= $form->field($model, 'cur_state')->textInput() ?>

    <?= $form->field($model, 'num_att')->textInput() ?>

    <?= $form->field($model, 'last_att')->textInput() ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'call_date')->textInput() ?>

    <?= $form->field($model, 'add_date')->textInput() ?>

    <?= $form->field($model, 'record_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
