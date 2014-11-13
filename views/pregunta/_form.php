<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Pregunta */
/* @var $form yii\widgets\ActiveForm */

$this->registerJs('urlOpcionRespuestaCreate="'.Url::to(['opcionrespuesta/create']).'";');
$this->registerJsFile(Url::to('@web/js/pregunta.js'), ['depends' => [yii\web\JqueryAsset::className()]]);
?>

<div class="pregunta-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fk_tipo_pregunta')->dropDownList($list_tipo_pregunta, ['prompt' => 'Elija una opción']) ?>

    <?= $form->field($model, 'fk_categoria')->dropDownList($list_categoria, ['prompt' => 'Elija una opción']) ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => 60]) ?>

    <?= $form->field($model, 'comentario')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'ponderacion')->input('number', ['min'=>'0', 'max'=>'100']) ?>
    
    <?= Html::label('Nivel de atención:') ?>
    
    <?= Html::checkboxList('Pregunta[nivel_atencion]', $nivel_atencion, $list_nivel_atencion) ?>
    <br />
    <?= Html::label('Opciones de respuesta:') ?>
    
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover" 
               id="tbl_asignacion_opciones" style="width: auto !important">
            <thead>
                <tr align="center">
                    <th>Opción</th>
                    <th>Adecuada</th>
                    <th>Valor ideal</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    
    <a href="#dialogAgregarOpciones" class="btn btn-default" data-toggle="modal">
        <span class="glyphicon glyphicon-list"></span> Agregar opción
    </a>
    <br /><br />
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    
</div>

<?php 
Modal::begin([
    'id' => 'dialogAgregarOpciones',
    //'size' => Modal::SIZE_LARGE,
    'header' => '<h3>Asignar opciones de respuesta</h3>',
    //'toggleButton' => ['label' => 'Agregar opción', 'class' => 'btn btn-default btn-sm'],
    'footer' => '<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                 <button type="button" class="btn btn-primary" id="btnAsignarOpciones">Asignar opciones</button>'
]);
?>
<div class="table-responsive">
    <table id="tbl_opciones_respuesta" class="table table-bordered table-striped table-hover" 
           style="width: auto !important"  align="center">
        <thead>
            <tr>
                <th>Elegir</th>
                <th>Opción</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($list_opcion_respuesta)) {
                foreach ($list_opcion_respuesta as $id_opcion_respuesta => $descripcion) {
                    echo '<tr>
                        <td align="center">'.Html::checkbox('id_opcion_respuesta', false, 
                                                            ['value'=>$id_opcion_respuesta, 'class' => 'opcionRespuesta',
                                                                'data-texto' => $descripcion]).'</td>
                        <td>'.Html::encode($descripcion).'</td>
                    </tr>';
                }
            }
            ?>
        </tbody>
    </table>
</div>
<a href="#dialogNuevaOpcion" class="btn btn-default" data-toggle="modal">
    <span class="glyphicon glyphicon-check"></span> Registrar nueva opción
</a>
<?php
Modal::end();

Modal::begin([
    'id' => 'dialogNuevaOpcion',
    'size' => Modal::SIZE_SMALL,
    'header' => '<h3>Registrar nuevo opción</h3>',
    'footer' => '<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                 <button type="button" class="btn btn-primary" id="btnNuevaOpcion">Registrar</button>'
]);

    echo '<div class="form-group" id="divOpcionRespuesta">';
        echo Html::label('Opción: ', 'opcion_respuesta', array('class' => 'control-label'));
        echo Html::textInput('opcion_respuesta', '', array('id' => 'opcion_respuesta', 'class' => 'form-control'));
        echo '<div class="help-block"></div>';
    echo '</div>';
    
Modal::end();
?>