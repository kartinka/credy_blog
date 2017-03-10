<?php

namespace app\controllers;

use Yii;
use app\models\Feeds;
use app\models\Comments;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ListView;

/**
 * FeedsController implements the CRUD actions for Feeds model.
 */
class FeedsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['index', 'create', 'update', 'delete', 'preview', 'logout'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],            
        ];
    }

    public function actionAddComment()
    {   
        $model = new Comments();

        $model->feed_id = Yii::$app->request->post('feed_id');
        $model->content = Yii::$app->request->post('content_' . $model->feed_id);
        $model->save();
        
        $dataProvider = new ActiveDataProvider([
                'query' => Feeds::find(),
                'pagination' => ['pageSize' => 10],
        ]);

        return $this->renderPartial('_feed', [
                'model' => $this->findModel($model->feed_id)
        ]);
    }
    
    /**
     * Lists all Feeds models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Feeds::find(),
            'pagination' => [
                    'pageSize' => 10,
                ],              
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Feeds models.
     * @return mixed
     */
    public function actionList()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Feeds::find(),
            'pagination' => [
                    'pageSize' => 10,
                ],            
        ]);

        return $this->render('list', [
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Displays a single Feeds model.
     * @param integer $id
     * @return mixed
     */
    public function actionPreview($id)
    {
        return $this->render('preview', [
            'feed' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Feeds model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Feeds();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Feeds model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Feeds model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Feeds model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Feeds the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Feeds::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
