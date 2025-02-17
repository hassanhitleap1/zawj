<?php

namespace app\controllers;

use app\models\Products\Products;
use app\models\Products\ProductsSearch;
use app\models\ProductsImages\ProductsImages;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends BaseController
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


    public function init()
    {
        $this->layout = "admin";

        parent::init();
    }


    /**
     * Lists all Products models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProductsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Products model.
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
     * Creates a new Products model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Products();


        $model->scenario = Products::SCENARIO_CREATE;
        $newId = Products::find()->max('id') + 1;
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->validate()) {

                $file = UploadedFile::getInstance($model, 'file');

                $files = UploadedFile::getInstances($model, 'files');

                $folder_path = "images/products/$newId";


                FileHelper::createDirectory(
                    "$folder_path",
                    $mode = 0775,
                    $recursive = true
                );


                if (!empty($file)) {

                    $file_path = "$folder_path/" . "image." . $file->extension;
                    $file->saveAs($file_path);
                    $model->image = $file_path;


                }




                if (!empty($files)) {

                    foreach ($files as $key => $image) {
                        $modelImage = new ProductsImages();
                        $file_path = "$folder_path/$key" . "." . $image->extension;
                        $modelImage->product_id = $newId;
                        $modelImage->image = $file_path;
                        $image->saveAs($file_path);
                        $modelImage->save(false);
                    }

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
     * Updates an existing Products model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $model->scenario = Products::SCENARIO_UPDATE;
        $newId = $model->id;

        if ($this->request->isPost && $model->load($this->request->post()) && $model->validate()) {

            $file = UploadedFile::getInstance($model, 'file');

            $files = UploadedFile::getInstances($model, 'files');
            $folder_path = "images/products/$newId";
            if (!empty($file)) {

                FileHelper::createDirectory(
                    "$folder_path",
                    $mode = 0775,
                    $recursive = true
                );

                $file_path = "$folder_path/" . "image." . $file->extension;
                $file->saveAs($file_path);
                $model->image = $file_path;

            }


            if (!empty($files)) {

                foreach ($files as $key => $image) {
                    $modelImage = new ProductsImages();
                    $file_path = "$folder_path/$key" . "." . $image->extension;
                    $modelImage->product_id = $newId;
                    $modelImage->image = $file_path;
                    $image->saveAs($file_path);
                    if (!$modelImage->save()) {
                        var_dump($image);
                        exit;
                    }
                    ;
                }


            }



            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Products model.
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
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Products::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }






    public function actionRemoveImage($id)
    {

        $modelImage = ProductsImages::findOne(['id' => $id]);


        if (!file_exists($modelImage->image)) {
            return json_encode(['success' => false, 'error' => 'Failed to remove image']);
        }

        if (unlink($modelImage->image)) { // Delete the image file

            ProductsImages::deleteAll(['id' => $id]);

            return json_encode(['success' => true]);
        } else {
            // Respond with an error message if deletion fails
            return json_encode(['success' => false, 'error' => 'Failed to remove image']);
        }
    }
    public function actionRemoveMainImage($id)
    {

        $model = $this->findModel($id);

        $model->scenario = Products::SCENARIO_UPDATE;

        if ($model->image == "mechanical-engineering.jpg") {
            return json_encode(['success' => false, 'error' => 'can not remove image ']);
        }
        $model->image = "mechanical-engineering.jpg";
        $model->save();

        return json_encode(['success' => true]);


    }

}
