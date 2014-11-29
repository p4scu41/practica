<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\DataColumn;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PreguntaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Preguntas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pregunta-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pregunta', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'descripcion',
            [
                'attribute' => 'fk_tipo_pregunta',
                'format' => 'html',
                'value' => function ($model, $key, $index, $column){
                    return $model->fkTipoPregunta->descripcion;
                },
                'filter' => $list_tipo_pregunta,
            ],
            [
                'attribute' => 'fk_categoria',
                'format' => 'html',
                'value' => function ($model, $key, $index, $column){
                    return $model->fkCategoria->descripcion;
                },
                'filter' => $list_categoria,
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
