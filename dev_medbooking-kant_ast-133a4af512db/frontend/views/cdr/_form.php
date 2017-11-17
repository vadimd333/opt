<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Cdr */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cdr-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'accountcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'src')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dst')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'did')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dcontext')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'clid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'channel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dstchannel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lastapp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lastdata')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'start')->textInput() ?>

    <?= $form->field($model, 'answer')->textInput() ?>

    <?= $form->field($model, 'end')->textInput() ?>

    <?= $form->field($model, 'duration')->textInput() ?>

    <?= $form->field($model, 'billsec')->textInput() ?>

    <?= $form->field($model, 'disposition')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'op_answer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'operator')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wait_duration')->textInput() ?>

    <?= $form->field($model, 'ans_duration')->textInput() ?>

    <?= $form->field($model, 'amaflags')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'userfield')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'uniqueid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'linkedid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tr_linkedid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'peeraccount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'direct')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sequence')->textInput() ?>

    <?= $form->field($model, 'mark')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
