<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Supervision */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="supervision-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fk_usuario')->hiddenInput(['value' => $usuario]) ?>

    <?= $form->field($model, 'fk_clues')->dropDownList($list_clues, ['prompt' => 'Elija una opción']) ?>

    <?= $form->field($model, 'fecha_supervision')->input('date') ?>

    <?= $form->field($model, 'observaciones')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Continuar' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
