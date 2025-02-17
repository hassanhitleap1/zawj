<?php

namespace app\controllers;

use app\models\Pages\Pages;
use app\models\Pages\PagesSearch;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PagesController implements the CRUD actions for Pages model.
 */
class PagesController extends BaseController
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Pages models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PagesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pages model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Pages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Pages();

        $model->scenario = Pages::SCENARIO_CREATE;
        $newId = Pages::find()->max('id') + 1;

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->validate()) {

                $file = UploadedFile::getInstance($model, 'file');


                if (!empty($file)) {
                    $folder_path = "images/pages/$newId";
                    FileHelper::createDirectory(
                        "$folder_path",
                        $mode = 0775,
                        $recursive = true
                    );

                    $file_path = "$folder_path/" . "image." . $file->extension;
                    $file->saveAs($file_path);
                    $model->image = $file_path;


                }


                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Pages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);


        $model->scenario = Pages::SCENARIO_UPDATE;
        $newId = $model->id;
        if ($this->request->isPost && $model->load($this->request->post()) && $model->validate()) {

            $file = UploadedFile::getInstance($model, 'file');

            if (!empty($file)) {
                $folder_path = "images/pages/$newId";
                FileHelper::createDirectory(
                    "$folder_path",
                    $mode = 0775,
                    $recursive = true
                );

                $file_path = "$folder_path/" . "image." . $file->extension;
                $file->saveAs($file_path);
                $model->image = $file_path;


            }

            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }



    public function actionRemoveMainImage($id)
    {

        $model = $this->findModel($id);

        $model->scenario = Pages::SCENARIO_UPDATE;

        if ($model->image == "mechanical-engineering.jpg") {
            return json_encode(['success' => false, 'error' => 'can not remove image ']);
        }
        $model->image = "mechanical-engineering.jpg";
        $model->save();

        return json_encode(['success' => true]);


    }
    /**
     * Deletes an existing Pages model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Pages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pages::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
