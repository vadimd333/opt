<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Cdr */

$this->title = 'Create Cdr';
$this->params['breadcrumbs'][] = ['label' => 'Cdrs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cdr-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
