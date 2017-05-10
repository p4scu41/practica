<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pregunta */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pregunta-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fk_tipo_pregunta')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'fk_categoria')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => 60]) ?>

    <?= $form->field($model, 'comentario')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'ponderacion')->textInput() ?>

    <?= $form->field($model, 'fecha_creado')->textInput() ?>

    <?= $form->field($model, 'fecha_modificado')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
