<?php

namespace app\controllers;

use app\models\OpcionRespuesta;

class OpcionRespuestaController extends \yii\web\Controller
{
    /**
     * Creates a new OpcionRespuesta model.
     * If creation is successful, the browser will be return the record
     * @return json
     */
    public function actionCreate()
    {
        $model = new OpcionRespuesta();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $response = ['message' => null, 'code' => null];
        
        try {
            if ($model->load(\Yii::$app->request->post()) && $model->save()) {
                $response['message'] = ['id_opcion_respuesta' => $model->id_opcion_respuesta, 
                                        'descripcion' => $model->descripcion];
                $response['code'] = 200;
            } else {
                $response['message'] = $model->getErrors();
                $response['code'] = 400;
            }
        } catch (Exception $e) {
            $response['message'] = 'ERROR: No se puede registrar el dato.';
            $response['code'] = 400;
            Yii::error($e->getMessage());
        }
        
        return $response;
    }

}
