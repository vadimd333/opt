<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Autodial */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Autodials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="autodial-view">

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
            'src',
            'dst',
            'did',
            'clid',
            'wait_que',
            'duration',
            'billsec',
            'disposition',
            'operator',
            'record',
            'uniqueid',
            'project',
            'cl_online',
            'cur_state',
            'num_att',
            'last_att',
            'type',
            'call_date',
            'add_date',
            'record_id',
        ],
    ]) ?>

</div>
