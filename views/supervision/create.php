<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Supervision */

$this->title = 'Create Supervision';
$this->params['breadcrumbs'][] = ['label' => 'Supervisions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supervision-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'list_clues' => $list_clues,
        'usuario' => $usuario,
    ]) ?>

</div>
