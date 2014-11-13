<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Pregunta */

$this->title = 'Create Pregunta';
$this->params['breadcrumbs'][] = ['label' => 'Preguntas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pregunta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'list_tipo_pregunta' => $list_tipo_pregunta,
        'list_categoria' => $list_categoria,
        'list_nivel_atencion' => $list_nivel_atencion,
        'nivel_atencion' => $nivel_atencion,
        'list_opcion_respuesta' => $list_opcion_respuesta,
    ]) ?>

</div>
