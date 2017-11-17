<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Cdr */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cdrs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cdr-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'accountcode',
            'src',
            'dst',
            'did',
            'dcontext',
            'clid',
            'channel',
            'dstchannel',
            'lastapp',
            'lastdata',
            'start',
            'answer',
            'end',
            'duration',
            'billsec',
            'disposition',
            'op_answer',
            'operator',
            'wait_duration',
            'ans_duration',
            'amaflags',
            'userfield',
            'uniqueid',
            'linkedid',
            'tr_linkedid',
            'peeraccount',
            'direct',
            'sequence',
            'mark',
        ],
    ]) ?>

</div>
