<?php

namespace app\controllers;

use Yii;
use app\models\Pregunta;
use app\models\PreguntaSearch;
use app\models\TipoPregunta;
use app\models\Categoria;
use app\models\NivelAtencion;
use app\models\OpcionRespuesta;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * PreguntaController implements the CRUD actions for Pregunta model.
 */
class PreguntaController extends Controller
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
     * Lists all Pregunta models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PreguntaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pregunta model.
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
     * Creates a new Pregunta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pregunta();
        $list_tipo_pregunta = ArrayHelper::map(
                                TipoPregunta::find()
                                    ->select(['id_tipo_pregunta', 'descripcion'])
                                    ->all(),
                                'id_tipo_pregunta', 'descripcion'
                              );
        $list_categoria = ArrayHelper::map(
                                Categoria::find()
                                    ->select(['id_categoria', 'descripcion'])
                                    ->all(),
                                'id_categoria', 'descripcion'
                              );
        $list_nivel_atencion = ArrayHelper::map(
                                NivelAtencion::find()
                                    ->select(['id_nivel_atencion', 'descripcion'])
                                    ->all(),
                                'id_nivel_atencion', 'descripcion'
                              );
        $list_opcion_respuesta = ArrayHelper::map(
                                OpcionRespuesta::find()
                                    ->select(['id_opcion_respuesta', 'descripcion'])
                                    ->all(),
                                'id_opcion_respuesta', 'descripcion'
                              );
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_pregunta]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'list_tipo_pregunta' => $list_tipo_pregunta,
                'list_categoria' => $list_categoria,
                'list_nivel_atencion' => $list_nivel_atencion,
                'list_opcion_respuesta' => $list_opcion_respuesta,
            ]);
        }
    }

    /**
     * Updates an existing Pregunta model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $list_tipo_pregunta = ArrayHelper::map(
                                TipoPregunta::find()
                                    ->select(['id_tipo_pregunta', 'descripcion'])
                                    ->asArray() // Este metodo es opcional, funciona igual si no se agrega
                                    ->all(),
                                'id_tipo_pregunta', 'descripcion'
                              );
        $list_categoria = ArrayHelper::map(
                                    Categoria::find()
                                    ->select(['id_categoria', 'descripcion'])
                                    ->asArray() // Este metodo es opcional, funciona igual si no se agrega
                                    ->all(),
                                'id_categoria', 'descripcion'
                              );
        $list_nivel_atencion = ArrayHelper::map(
                                NivelAtencion::find()
                                    ->select(['id_nivel_atencion', 'descripcion'])
                                    ->asArray() // Este metodo es opcional, funciona igual si no se agrega
                                    ->all(),
                                'id_nivel_atencion', 'descripcion'
                              );
        $list_opcion_respuesta = ArrayHelper::map(
                                OpcionRespuesta::find()
                                    ->select(['id_opcion_respuesta', 'descripcion'])
                                    ->all(),
                                'id_opcion_respuesta', 'descripcion'
                              );
        $nivel_atencion = 0;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_pregunta]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'list_tipo_pregunta' => $list_tipo_pregunta,
                'list_categoria' => $list_categoria,
                'list_nivel_atencion' => $list_nivel_atencion,
                'list_opcion_respuesta' => $list_opcion_respuesta,
            ]);
        }
    }

    /**
     * Deletes an existing Pregunta model.
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
     * Finds the Pregunta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Pregunta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pregunta::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
