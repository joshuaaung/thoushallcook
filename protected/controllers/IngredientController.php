<?php

class IngredientController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Ingredient;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Ingredient']))
		{
			$model->attributes=$_POST['Ingredient'];
			if(!$this->isExist($model->name) && $model->save()) {
				$this->redirect(array('view','id'=>$model->id));
			} else {
				Yii::app()->user->setFlash('ingredient_exists', "<b>$model->name</b> is already in the Ingredient bank!"); //Flash alert-message with the title:'success', message:"Recipe $name has been deleted" -> it will then be displayed in the index(view)
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function isExist($ingredient_name) {
		$temp_ingredient = Ingredient::model()->findByAttributes(array('name'=>$ingredient_name));

		return $temp_ingredient==null ? false : true;
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Ingredient']))
		{
			$model->attributes=$_POST['Ingredient'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$name = $this->loadModel($id)->name;
		$this->loadModel($id)->delete();

		RecipeIngredientQuantityMapping::model()->deleteAllByAttributes(array('ingredient_id'=>$id));
		$dataProvider = new CActiveDataProvider('Ingredient');
		Yii::app()->user->setFlash('success_ingredient', "<b>$name</b> has been removed from the Ingredient bank!"); //Flash alert-message with the title:'success', message:"Ingredient $name has been deleted" -> it will then be displayed in the index(view)
		$this->render('index', array('dataProvider'=>$dataProvider));

		/*
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		*/
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Ingredient');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Ingredient('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Ingredient']))
			$model->attributes=$_GET['Ingredient'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Ingredient the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Ingredient::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Ingredient $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='ingredient-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
