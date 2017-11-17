<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Autodial */

$this->title = 'Update Autodial: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Autodials', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="autodial-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
