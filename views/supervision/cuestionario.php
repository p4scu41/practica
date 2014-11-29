<style type="text/css">
/*
Boostrap horizontal scrollable tab bar
http://stackoverflow.com/questions/22582520/boostrap-horizontal-scrollable-tab-bar
*/
.nav-pills {
    overflow-x: auto;
    overflow-y: hidden;
    display: -webkit-box;
    display: -moz-box;
}
.nav-pills>li {
    float:none;
    border: gray solid 1px;
    border-radius: 4px;
    border-bottom: none;
}
</style>
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Supervision */
/* @var $form yii\widgets\ActiveForm */
$this->registerJsFile(Url::to('@web/js/cuestionario.js'), ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Url::to('@web/js/jquery.scrollTo.min.js'), ['depends' => [yii\web\JqueryAsset::className()]]);
?>

<br>
<div role="tabpanel" class="panelCuestionario">
    <!-- Nav tabs -->
    <ul class="nav nav-pills" role="tablist" id="seccionesCuestionario">
        <?php
        foreach ($list_categorias as $key => $categoria) {
            echo '<li role="presentation" class="'.($key==0 ? 'active' : '').'">
                    <a href="#tab_'.$categoria['id_categoria'].'" aria-controls="tab_'.$categoria['id_categoria'].
                        '" role="tab" data-toggle="tab">'.$categoria['descripcion'].'</a></li>';
        }
        ?>
    </ul>

    <!-- Tab panes -->

    <div class="tab-content">
        <?php
        foreach ($list_categorias as $key => $categoria) {
            echo '<div role="tabpanel" class="tab-pane fade in '.($key==0 ? 'active' : '').'" id="tab_'.$categoria['id_categoria'].'">
                    <div class="panel panel-info">
                        <div class="panel-heading"><strong>'.$categoria['descripcion'].'</strong></div>
                        <div class="panel-body">';

            echo '<div class="table-responsive">'.
                  '<table class="table table-bordered table-striped table-hover">';

            foreach ($list_preguntas[ $categoria['id_categoria'] ] as $pregunta) {
                echo '<tr>
                    <td>'.$pregunta['descripcion'].'</td>';

                    foreach ($pregunta['respuestas'] as $respuesta) {
                        echo '<td><label><input type="radio" name="'.$pregunta['id_pregunta'].'" value=""> '.$respuesta['descripcion'].'</label></td>';
                    }
                echo '</tr>';
            }

            echo '</table></div>';

            echo '</div>
                 </div>
             </div>';
        }
        ?>
    </div>
</div>

<div class="form-group">
    <nav>
        <ul class="pager">
            <li class="previous"><a href="#" id="btnAnterior"><span aria-hidden="true">&larr;</span> Anterior</a></li>
            <li class="next"><a href="#" id="btnSiguiente">Siguiente <span aria-hidden="true">&rarr;</span></a></li>
        </ul>
    </nav>
</div>

<div class="form-group">
    <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
</div>