<?php

class RecipeController extends Controller
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
		$mappings = RecipeIngredientQuantityMapping::model()->findAll(array("condition"=>"recipe_id=$id","order"=>"id")); //Gather All the rows with recipe_id = this recipe id
		$results = $this->extractData($mappings);
		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'results'=>$results,
		));
	}

	public function extractData($mappings)
	{	
		$results = array('ingredient'=>[], 'quantity'=>[], 'measurement'=>[]);
		foreach ($mappings as $item) {
			$ingredient = Ingredient::model()->findByPk($item->ingredient_id);
			$quantity = $item->quantity;
			$measurement = Measurement::model()->findByPk($item->measurement_id);
			array_push($results['ingredient'], $ingredient);
			array_push($results['quantity'], $quantity);
			array_push($results['measurement'], $measurement);
			//array_push($results, $ingredient, $quantity, $measurement);
		}
		return $results;
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{

		$model=new Recipe;
		$ingredientModels = [];
		//(1) $quantityModels = [];
		$measurementModels = [];
		$quantities = [];
		
		$ingredients = Ingredient::model()->findAll(); //get all the existing ingredients
		//(2) $quantities = Quantity::model()->findAll(); //get all the existing quantities
		$measurements = Measurement::model()->findAll();

		$found_ingredient = false;
		//(3) $found_quantity = false;
		$found_measurement = false;
		
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
		//$this->performAjaxValidation($ingredient);
		//$this->performAjaxValidation($quantity);

		
		/*Multiple Ingredient inputs*/
		if(isset($_POST['Ingredient'])){
			foreach($_POST['Ingredient'] as $ingredientModel) {
				$ingredient = new Ingredient;
				$ingredient->attributes = $ingredientModel;

				foreach($ingredients as $item) {
					if(strcasecmp($item->name, $ingredient->name) == 0) {
						$found_ingredient = true;
						$ingredient = $item; //there is old record. Assign it to the $ingredient
						break;
					}
				}

				if(!$this->hasDuplicate($ingredientModels, $ingredient)) {
					$ingredientModels[] = $ingredient;

					if(!$found_ingredient) {
						$ingredient->save(); //new ingredient! save it
					} 
				}

				$found_ingredient = false;
			}
		}

		if(isset($_POST['RecipeIngredientQuantityMapping'])){
			foreach($_POST['RecipeIngredientQuantityMapping'] as $mappingModel) {
				$quantity = new RecipeIngredientQuantityMapping;
				$quantity->attributes = $mappingModel;
				array_push($quantities, $quantity->quantity);
			}
		}
		/*Multiple Quantity inputs*/
		/*
		if(isset($_POST['Quantity'])){
			foreach($_POST['Quantity'] as $quantityModel) {
				$quantity = new Quantity;
				$quantity->attributes = $quantityModel;

				foreach($quantities as $item) {
					if(strcasecmp($item->name, $quantity->name) == 0) {
						$found_quantity = true;
						$quantity = $item; //there is old record. Assign it to the $quantity
						break;
					}
				} 

				//if(!$this->hasDuplicate($quantityModels, $quantity)) {
					
				if(!$found_quantity && !($this->hasDuplicate($quantityModels, $quantity))) {
					$quantity->save(); //new ingredient! save it
				}

				$quantityModels[] = $quantity;

				//}
				$found_quantity = false;
			}
		}
		*/

		/*Multiple measurement input*/
		if(isset($_POST['Measurement'])){
			foreach($_POST['Measurement'] as $measurementModel) {
				$measurement = new Measurement;
				$measurement->attributes = $measurementModel;

				foreach($measurements as $item) {
					if(strcasecmp($item->name, $measurement->name) == 0) {
						$found_measurement = true;
						$measurement = $item; //there is old record. Assign it to the $ingredient
						break;
					}
				}

				//if(!$this->hasDuplicate($measurementModels , $measurement)) {

				if(!$found_measurement && !($this->hasDuplicate($measurementModels, $measurement))) {
					$measurement->save(); 
				} 
				$measurementModels[] = $measurement;

				//}

				$found_measurement = false;
			}
		}

		/*Validation whehter the Recipe/Ingredient/Quantity field have been filled*/
		/*Must have at least 1 ingrediet per recipe*/	
		/*
		$valid=$addressModel_1->validate(); 
        $valid=$addressModel_2->validate() && $valid;
        $valid=$model->validate() && $valid;
		*/


        /*Single Ingredient input*/
        /*
		if(isset($_POST['Ingredient']))
		{
			$ingredient->attributes=$_POST['Ingredient']; //assign the input vattributes(only 'name' in this case), to the new $ingredient model

			//iterate through old ingredient records to see if the input is a pre-existing one. This is to prevent duplicate ingredients
			foreach($ingredients as $item) {
				if(strcasecmp($item->name, $ingredient->name) == 0) {
					$found_ingredient = true;
					$ingredient = $item; //there is old record. Assign it to the $ingredient
					break;
				}
			}

			if(!$found_ingredient) {
				$ingredient->save(); //new ingredient! save it
			} 
		}
		*/
		
		/*Single Quantity input*/
		/*
		if(isset($_POST['Quantity']))
		{
			$quantity->attributes=$_POST['Quantity']; //assign the input vattributes(only 'name' in this case), to the new $ingredient model

			//iterate through old ingredient records to see if the input is a pre-existing one. This is to prevent duplicate ingredients
			foreach($quantities as $item) {
				if(strcasecmp($item->name, $quantity->name) == 0) {
					$found_quantity = true;
					$quantity = $item; //there is old record. Assign it to the $ingredient
					break;
				}
			}

			if(!$found_quantity) {
				$quantity->save(); //new ingredient! save it
			} 
		}
		*/
		if(isset($_POST['Recipe']))
		{
			$model->attributes=$_POST['Recipe'];
			if($model->save()) {
				for ($i = 0; $i < count($ingredientModels); $i++){
					if($ingredientModels[$i] != null && $quantities[$i] != null && $measurementModels[$i] != null)
						$this->createMapping($model->id, $ingredientModels[$i]->id, $quantities[$i], $measurementModels[$i]->id);
				}
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
			'ingredient'=>new Ingredient,
			'mapping_quantity'=>new RecipeIngredientQuantityMapping,
			'measurement'=>new Measurement,
		));
	}

	public function createMapping($recipe_id, $ingredient_id, $quantity, $measurement_id) {
		$mapping = new RecipeIngredientQuantityMapping;
		$mapping->recipe_id = $recipe_id;
		$mapping->ingredient_id = $ingredient_id;
		$mapping->quantity = $quantity;
		$mapping->measurement_id = $measurement_id;

		$mapping->save();
	}

	public function hasDuplicate($models, $model) {
		foreach($models as $item) {
			if(strcasecmp($item->name, $model->name) == 0) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		$mapping=RecipeIngredientQuantityMapping::model()->findAll(array("condition"=>"recipe_id=$id","order"=>"id"));
		$results = $this->extractData($mapping);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$ingredientModels = [];
		$ingredients = Ingredient::model()->findAll(); //get all the existing ingredients
		$found_ingredient = false;
		
		/*Multiple Ingredient inputs*/
		if(isset($_POST['Ingredient'])){
			foreach($_POST['Ingredient'] as $ingredientModel) {
				$ingredient = new Ingredient;
				$ingredient->attributes = $ingredientModel;

				foreach($ingredients as $item) {
					if(strcasecmp($item->name, $ingredient->name) == 0) {
						$found_ingredient = true;
						$ingredient = $item; //there is old record. Assign it to the $ingredient
						break;
					}
				}

				if(!$this->hasDuplicate($ingredientModels, $ingredient)) {
					$ingredientModels[] = $ingredient;

					if(!$found_ingredient) {
						$ingredient->save(); //new ingredient! save it
					} 
				}

				$found_ingredient = false;
			}
		}

		if(isset($_POST['Recipe']))
		{
			$model->attributes=$_POST['Recipe'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
			'ingredient'=>$results['ingredient'],
			'quantity'=>$results['quantity'],
			'measurement'=>$results['measurement']
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Recipe');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Recipe('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Recipe']))
			$model->attributes=$_GET['Recipe'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Recipe the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Recipe::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Recipe $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='recipe-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
