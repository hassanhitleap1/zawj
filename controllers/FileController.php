<?php

namespace app\controllers;

use app\models\Categories\Categories;
use app\models\Categories\CategoriesSearch;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CategoriesController implements the CRUD actions for Categories model.
 */
class FileController extends BaseController
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
     * Lists all Categories models.
     *
     * @return string
     */
    public function actionUpload()
    {

        if ($this->request->isPost) {

            $bytes = random_bytes(20);
            $string = bin2hex($bytes);


            $uploaddir = "/images/uploads/" . date('Y/m/d');


            FileHelper::createDirectory(\Yii::getAlias('@webroot') . $uploaddir);

            $image = $_FILES['image']['name'];
            $ext = pathinfo($image, PATHINFO_EXTENSION);
            // that's the directory in the document_root where I put pics
            $uploadfile = "$uploaddir/$string.$ext";
            if (move_uploaded_file($_FILES['image']['tmp_name'], \Yii::getAlias('@webroot') . $uploadfile)) {
                return \Yii::getAlias('@web') . $uploadfile;
            }

        }

    }




    public function actionCreate()
    {
        $model = new Categories();
        $model->scenario = Categories::SCENARIO_CREATE;
        $newId = Categories::find()->max('id') + 1;




        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Categories model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $model->scenario = Categories::SCENARIO_UPDATE;
        $newId = $model->id;

        if ($this->request->isPost && $model->load($this->request->post()) && $model->validate()) {

            $file = UploadedFile::getInstance($model, 'file');

            if (!empty($file)) {
                $folder_path = "images/categories/$newId";
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

    /**
     * Deletes an existing Categories model.
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
     * Finds the Categories model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Categories the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Categories::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
