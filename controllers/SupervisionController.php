<?php

namespace app\controllers;

use Yii;
use app\models\Supervision;
use app\models\SupervisionSearch;
use app\models\Clues;
use app\models\Categoria;
use app\models\CategoriaNivel;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * SupervisionController implements the CRUD actions for Supervision model.
 */
class SupervisionController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Supervision models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SupervisionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $searchModel->fecha_supervision = $searchModel->fecha_supervision == 0 ? null : $searchModel->fecha_supervision;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Supervision model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Supervision model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Supervision();
        $list_clues = ArrayHelper::map(
                                    Clues::find()
                                    ->select(['id_clues', 'nombre'])
                                    ->all(),
                                'id_clues', 'nombre'
                              );
        $usuario = 1;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['cuestionario', 'id' => $model->id_supervision]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'list_clues' => $list_clues,
                'usuario' => $usuario,
            ]);
        }
    }

    /**
     * Updates an existing Supervision model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_supervision]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Supervision model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Supervision model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Supervision the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Supervision::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Updates an existing Supervision model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionCuestionario($id)
    {
        $model = $this->findModel($id);
        $connection = Yii::$app->db;

        $command = $connection->createCommand('SELECT
                                        categoria.id_categoria,
                                        categoria.descripcion
                                    FROM
                                        clues, categoria_nivel, categoria
                                    WHERE
                                        clues.id_clues = '.$model->fk_clues.' AND
                                        categoria_nivel.fk_nivel_atencion = clues.fk_nivel_atencion AND
                                        categoria.id_categoria = categoria_nivel.fk_categoria');
        $categorias = $command->queryAll();
        $preguntas = array();

        foreach ($categorias as $cat) {
            $command = $connection->createCommand('SELECT
                                            id_pregunta,
                                            fk_tipo_pregunta,
                                            descripcion,
                                            comentario
                                        FROM
                                            pregunta
                                        WHERE
                                            fk_categoria = '.$cat['id_categoria'].
                                        ' ORDER BY fk_tipo_pregunta');
            $rsPreguntas = $command->queryAll();

            $preguntas[ $cat['id_categoria'] ] = array();

            foreach ($rsPreguntas as $preg) {
                /*$arPregunta = array();

                $arPregunta['id_pregunta']      = $preg['id_pregunta'];
                $arPregunta['fk_tipo_pregunta'] = $preg['fk_tipo_pregunta'];
                $arPregunta['descripcion']      = $preg['descripcion'];
                $arPregunta['comentario']       = $preg['comentario'];
                $arPregunta['respuestas']       = array();*/

                $preg['respuestas'] = array();

                $command = $connection->createCommand('SELECT
                                                opcion_respuesta.id_opcion_respuesta,
                                                opcion_respuesta.descripcion,
                                                opcion_pregunta.valor_ideal,
                                                opcion_respuesta.comentario
                                            FROM
                                                opcion_pregunta,opcion_respuesta
                                            WHERE
                                                opcion_pregunta.fk_opcion_respuesta = opcion_respuesta.id_opcion_respuesta AND
                                                opcion_pregunta.fk_pregunta = '.$preg['id_pregunta']);

                $rsRespuestas = $command->queryAll();

                foreach ($rsRespuestas as $resp) {
                    /*$arRespuesta = array();

                    $arRespuesta['id_opcion_respuesta'] = $resp['id_opcion_respuesta'];
                    $arRespuesta['descripcion']         = $resp['descripcion'];
                    $arRespuesta['valor_ideal']         = $resp['valor_ideal'];
                    $arRespuesta['comentario']          = $resp['comentario'];

                    $arPregunta['respuestas'][] = $arRespuesta;*/
                    $preg['respuestas'][] = $resp;
                }

                //$preguntas[ $cat['id_categoria'] ][] = $arPregunta;
                $preguntas[ $cat['id_categoria'] ][] = $preg;
            }
        }

        //print_r($preguntas);
        if ($model) {
            return $this->render('cuestionario', [
                'model' => $model,
                'list_categorias' => $categorias,
                'list_preguntas' => $preguntas,
            ]);
        } else {
            return $this->redirect(['index']);
        }
    }
}
