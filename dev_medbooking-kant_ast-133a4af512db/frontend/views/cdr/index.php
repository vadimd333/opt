<?php

use common\components\ActionColumn;
use common\widgets\ExportMenu;
use yii\helpers\Html;
use yii\grid\GridView;
use kartik\datetime\DateTimePicker;
use yii\helpers\VarDumper;

rmrevin\yii\fontawesome\AssetBundle::register($this);
/* @var $this yii\web\View */
/* @var $searchModel common\models\CdrSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Звонки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel">
    <audio controls="" id="player" type="audio/mpeg" autoplay="" style=""></audio>
</div>
<div class="cdr-index">
    <div class="cdr_export">
    <?= ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns'      => [
            'id',
            [
                'attribute' => 'direct',
                'filter' => array("IN" => "Входящий", "INTR" => "Внутренний", "OUT" => "Исходящий"),
                'value' => function ($data) {
                    switch ($data->direct) {
                        case 'IN':
                            return "Входящий";
                            break;
                        case 'INTR':
                            return "Внутренний";
                            break;
                        case 'OUT':
                            return "Исходящий";
                            break;
                        default:
                            return $data->direct;
                    }
                },
            ],
//            ['attribute' => 'direct_detail_name'],
            [
                'attribute' => 'src',
                'format' => 'raw',
                'value' => function ($data) {
                    $src = Html::a($data->src, "callto:{$data->src}");
                    return $src;
                }
            ],[
                'attribute' => 'dst',
                'format' => 'raw',
                'value' => function ($data) {
                    $src = Html::a($data->dst, "callto:{$data->dst}");
                    return $src;
                }
            ],
            [
                'attribute' => 'start',
                'format' => ['datetime', "php:Y-m-d H:i:s"],
            ],
            [
                'attribute' => 'operator',
            ],
            [
                'attribute' => 'duration',
                'contentOptions' => ['class' => 'duration'],
                'format' => ['datetime', "php:i:s"],
            ],
            [
                'attribute' => 'ans_duration',
                'contentOptions' => ['class' => 'duration'],
                'format' => ['datetime', "php:i:s"],
            ],
            [
                'attribute' => 'op_answer',
                'filter' => array("ANSWERED" => "Отвечен", "NOANSWER" => "Не отвечен"),
                'value' => function ($data) {
                    switch ($data->op_answer) {
                        case 'ANSWERED':
                            return "Отвечен";
                            break;
                        case 'NOANSWER':
                            return "Не отвечен";
                            break;
                        default:
                            return $data->op_answer;
                    }
                },
            ],
            [
                'attribute' => 'press',
                'format' => 'raw',
                'value' => function ($data) {
                    return $data->press?$data->press:'';
                }
            ],
        ]
    ]);
    ?>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'attribute' => 'direct',
                'filter' => array("IN" => "Входящий", "INTR" => "Внутренний", "OUT" => "Исходящий"),
                'value' => function ($data) {
                    switch ($data->direct) {
                        case 'IN':
                            return "Входящий";
                            break;
                        case 'INTR':
                            return "Внутренний";
                            break;
                        case 'OUT':
                            return "Исходящий";
                            break;
                        default:
                            return $data->direct;
                    }
                },
            ],
//            ['attribute' => 'direct_detail_name'],
            [
                'attribute' => 'src',
                'format' => 'raw',
                'value' => function ($data) {
                    $src = Html::a($data->src, "callto:{$data->src}");
                    return $src;
                }
            ],[
                'attribute' => 'dst',
                'format' => 'raw',
                'value' => function ($data) {
                    $src = Html::a($data->dst, "callto:{$data->dst}");
                    return $src;
                }
            ],
            [
                'attribute' => 'start',
                'format' => ['datetime', "php:Y-m-d H:i:s"],
            ],
            [
                'attribute' => 'operator',
            ],
            [
                'attribute' => 'duration',
                'contentOptions' => ['class' => 'duration'],
                'format' => ['datetime', "php:i:s"],
            ],
            [
                'attribute' => 'ans_duration',
                'contentOptions' => ['class' => 'duration'],
                'format' => ['datetime', "php:i:s"],
            ],
            [
                'attribute' => 'op_answer',
                'filter' => array("ANSWERED" => "Отвечен", "NOANSWER" => "Не отвечен"),
                'value' => function ($data) {
                    switch ($data->op_answer) {
                        case 'ANSWERED':
                            return "Отвечен";
                            break;
                        case 'NOANSWER':
                            return "Не отвечен";
                            break;
                        default:
                            return $data->op_answer;
                    }
                },
            ],
            [
                'attribute' => 'press',
                'format' => 'raw',
                'value' => function ($data) {
                    return $data->press?$data->press:'';
                }
            ],
            [
                'header' => 'Запись',
                'class' => ActionColumn::className(),
                'template' => '{play}{download}',
            ]
        ],
    ]); ?>
</div>
