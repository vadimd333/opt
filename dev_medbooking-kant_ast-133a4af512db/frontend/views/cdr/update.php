<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Cdr */

$this->title = 'Update Cdr: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Cdrs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cdr-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
