<?php

namespace app\controllers;

use app\models\user\User;
use app\models\user\UserSearch;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use Yii;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends BaseController
{

    public function beforeAction($action)
    {
        $this->layout = "admin";
        if (Yii::$app->user->identity->type == User::ADMIN) {
            return $this->redirect(['admin/index']);
        }
        return $action;
    }
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
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new User();


        $model->scenario = User::SCENARIO_CREATE;
        $newId = User::find()->max('id') + 1;

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->validate()) {


                $file = UploadedFile::getInstance($model, 'file');

                $model->password_hash = Yii::$app->security->generatePasswordHash($model->password);

                if (!empty($file)) {
                    $folder_path = "images/users/$newId";
                    FileHelper::createDirectory(
                        "$folder_path",
                        $mode = 0775,
                        $recursive = true
                    );
                    $file_path = "$folder_path/" . "image." . $file->extension;
                    $file->saveAs($file_path);
                    $model->avatar = $file_path;

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
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);


        $model->scenario = User::SCENARIO_UPDATE;
        $newId = $model->id;

        if ($this->request->isPost && $model->load($this->request->post()) && $model->validate()) {

            $file = UploadedFile::getInstance($model, 'file');

            if (!is_null($model->password)) {
                $model->password_hash = Yii::$app->security->generatePasswordHash($model->password);
            }

            if (!empty($file)) {
                $folder_path = "images/users/$newId";
                FileHelper::createDirectory(
                    "$folder_path",
                    $mode = 0775,
                    $recursive = true
                );

                $file_path = "$folder_path/" . "image." . $file->extension;
                $file->saveAs($file_path);
                $model->avatar = $file_path;


            }

            $model->save();


            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
