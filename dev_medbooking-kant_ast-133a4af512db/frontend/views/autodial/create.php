<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Autodial */

$this->title = 'Create Autodial';
$this->params['breadcrumbs'][] = ['label' => 'Autodials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="autodial-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
