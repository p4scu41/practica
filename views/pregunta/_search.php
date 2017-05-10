<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PreguntaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pregunta-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_pregunta') ?>

    <?= $form->field($model, 'fk_tipo_pregunta') ?>

    <?= $form->field($model, 'fk_categoria') ?>

    <?= $form->field($model, 'descripcion') ?>

    <?= $form->field($model, 'comentario') ?>

    <?php // echo $form->field($model, 'ponderacion') ?>

    <?php // echo $form->field($model, 'fecha_creado') ?>

    <?php // echo $form->field($model, 'fecha_modificado') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
