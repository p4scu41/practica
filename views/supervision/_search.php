<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SupervisionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="supervision-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_supervision') ?>

    <?= $form->field($model, 'fk_usuario') ?>

    <?= $form->field($model, 'fk_clues') ?>

    <?= $form->field($model, 'fecha_supervision') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
