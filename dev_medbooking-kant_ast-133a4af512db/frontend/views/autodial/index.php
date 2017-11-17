<?php

use common\components\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
rmrevin\yii\fontawesome\AssetBundle::register($this);
/* @var $this yii\web\View */
/* @var $searchModel app\models\AutodialSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Автозвонки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="autodial-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="panel">
        <audio controls="" id="player" type="audio/mpeg" autoplay="" style=""></audio>
    </div>
    <button class="btn load_panel">Загрузить лист</button>

    <div class="csv_container">
        <?php $form = ActiveForm::begin(['action' => '/autodial/upload', 'options' => ['enctype' => 'multipart/form-data']]) ?>
        <div class="hint fa fa-question" title="Файл формата .csv должен состоять из 2-х столбцов: 'Куда' и 'Определяемый номер'"></div>
        <?= $form->field($model, 'csvFile')->fileInput() ?>
        <?= $form->field($model, 'delimiter')->textInput(['placeholder'=>';']) ?>

        <button class="btn btn-success submit_csv">Отправить</button>

        <?php ActiveForm::end() ?>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'src',
            'dst',
            'wait_que',
            'duration',
            'billsec',
            'disposition',
            [
                'attribute' => 'operator',
                'format' => 'raw',
                'value' => function ($data) {
                    return $data->operator?$data->operator:'';
                }
            ],
//             'uniqueid',
//             'cl_online',
//             'cur_state',
            'num_att',
            'last_att',
            [
                'attribute' => 'add_date',
                'format' => 'raw',
                'value' => function ($data) {
                    return $data->add_date?$data->add_date:'';
                }
            ],
            'type',
            [
                'attribute' => 'list',
                'format' => 'raw',
                'value' => function ($data) {
                    return $data->list ? $data->list : '';
                }
            ],
            [
                'header' => 'Запись',
                'class' => ActionColumn::className(),
                'template' => '{play}{download}',
            ]


//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
