<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\jui\DatePicker;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SupervisionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Supervisions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supervision-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Supervision', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'fk_usuario',
            'fk_clues',
            [
                'attribute' => 'fecha_supervision',
                'format' => ['date', 'php:d-m-Y'],
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'fecha_supervision',
                    'language' => 'es',
                    'dateFormat' => 'yyyy-MM-dd',
                    'options' => ['class' => 'form-control'],
                    'clientOptions' => [
                        'changeMonth' => true,
                        'changeYear' => true,
                        'showWeek' => true,
                        'showButtonPanel' => true,
                        'beforeShow' => new JsExpression('function (input) {
                            setTimeout(function () {
                                var buttonPane = $(input)
                                    .datepicker("widget")
                                    .find(".ui-datepicker-buttonpane");

                                var btn = $(\'<button class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all" type="button">Limpiar</button>\');
                                btn.unbind("click").bind("click", function () {
                                    $.datepicker._clearDate(input);
                                });

                                btn.appendTo(buttonPane);
                                buttonPane.find("button:first").remove();
                            }, 1);
                        }')
                    ],
                ]),
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
