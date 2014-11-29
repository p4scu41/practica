<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Supervision */

$this->title = 'Update Supervision: ' . ' ' . $model->id_supervision;
$this->params['breadcrumbs'][] = ['label' => 'Supervisions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_supervision, 'url' => ['view', 'id' => $model->id_supervision]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="supervision-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'list_clues' => $list_clues,
        'usuario' => $usuario,
    ]) ?>

</div>
