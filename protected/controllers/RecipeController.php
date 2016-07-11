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
				'actions'=>array('index','view', 'addIngredient'),
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
		$model = $this->loadModel($id);

		$imageName=$model->imageName;

		$imageLink=null;

		//Retrieving file link from the s3
		require Yii::app()->getBasePath().'/vendor/aws_s3/s3_connect.php';

		if(!is_null($imageName)) {
			$imageLink = $s3->getObjectUrl($s3_config['s3']['bucket'], "images/{$imageName}");
		}

		//Constructing an array of recipe/ingredients/quantity/measurement details to display
		$mappings = RecipeIngredientQuantityMapping::model()->findAll(array("condition"=>"recipe_id=$id","order"=>"id")); //Gather All the rows with recipe_id = this recipe id
		$results = $this->extractData($mappings);

		$this->render('view',array(
			'model'=>$model,
			'results'=>$results,
			'imageLink'=>$imageLink,
			//'count'=>$count
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

	public function extractDataModel($mappings)
	{	
		$results = array('ingredient'=>[], 'mapping'=>[], 'measurement'=>[]);
		foreach ($mappings as $item) {
			$ingredient = Ingredient::model()->findByPk($item->ingredient_id);
			$measurement = Measurement::model()->findByPk($item->measurement_id);
			array_push($results['ingredient'], $ingredient);
			array_push($results['mapping'], $item);
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
		$measurementModels = [];
		$quantities = [];
		

		$isOldIngredient = false;
		$isOldMeasurement = false;
		
		$imageName = null;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
		//$this->performAjaxValidation($ingredient);
		//$this->performAjaxValidation($quantity);

		
		/*Multiple Ingredient inputs*/
		if(isset($_POST['Ingredient'])){
			foreach($_POST['Ingredient'] as $ingredientModel) {
				$ingredient = new Ingredient;
				$ingredient->attributes = $ingredientModel;

				$isOldIngredient = $this->ingredientExists($ingredient->name);

				if($isOldIngredient) { //there is old record. Assign it to the $ingredient
					$ingredient = Ingredient::model()->findByAttributes(array('name'=>$ingredient->name));
				}
				
				if(!$this->hasDuplicate($ingredientModels, $ingredient)) {
					$ingredientModels[] = $ingredient;

					if(!$isOldIngredient) {
						$ingredient->save(); //new ingredient! save it
					} 
				}

				$isOldIngredient = false;
			}
		}

		if(isset($_POST['RecipeIngredientQuantityMapping'])){
			foreach($_POST['RecipeIngredientQuantityMapping'] as $mappingModel) {
				$quantity = new RecipeIngredientQuantityMapping;
				$quantity->attributes = $mappingModel;
				array_push($quantities, $quantity->quantity);
			}
		}

		/*Multiple measurement input*/
		if(isset($_POST['Measurement'])){
			foreach($_POST['Measurement'] as $measurementModel) {
				$measurement = new Measurement;
				$measurement->attributes = $measurementModel;

				$isOldMeasurement = $this->measurementExists($measurement->name);

				if($isOldMeasurement) {
					$measurement = Measurement::model()->findByAttributes(array('name'=>$measurement->name));
				}
				
				if(!$isOldMeasurement && !($this->hasDuplicate($measurementModels, $measurement))) {
					$measurement->save(); 
				}

				$measurementModels[] = $measurement;

				$isOldMeasurement = false;
			}
		}

		/*Validation whehter the Recipe/Ingredient/Quantity field have been filled*/
		/*Must have at least 1 ingrediet per recipe*/	
		/*
		$valid=$addressModel_1->validate(); 
        $valid=$addressModel_2->validate() && $valid;
        $valid=$model->validate() && $valid;
		*/

		if(isset($_POST['ImageFileForm']))
        {
        	require Yii::app()->getBasePath().'/vendor/aws_s3/s3_connect.php';

        	$file = new ImageFileForm;
        	$file->image = CUploadedFile::getInstance($file, 'image'); //retrieving and assigning the FILE to the one of the public variable(called $image) in the ImageFileForm

        	if(!is_null($file->image)) {
	        	//File Details
	        	$ori_name = $file->image->getName();

	     		$extension = explode('.', $ori_name);
	     		$extension = strtolower(end($extension));

	     		//Temp Details
	     		$key = md5(uniqid());
	     		$temp_file_name = "{$key}.{$extension}"; //hence, unique name for each files

	        	$file->image->saveAs(Yii::app()->getBasePath().'/images/'.$temp_file_name); //Saving the uploaded file at /var/www/html/thoushallcook/protected . /images/ . <temp_file_name.jpg>

	        	//Uploading to s3
	        	//$s3 and $s3_config variables are available from the s3_connect.php which was imported by < require Yii::app()->getBasePath().'/vendor/aws_s3/s3_connect.php'; >

	    		$s3->putObject([
	        			'Bucket'=>$s3_config['s3']['bucket'],
	        			'Key'=>"images/{$temp_file_name}", //so that there are no duplicated filenames in the s3
	        			'Body'=>fopen(Yii::app()->getBasePath().'/images/'.$temp_file_name, 'rb'),
	        			'ACL'=>'public-read'
	    			]);

	        	//Remove the uploaded file from the server
	        	unlink(Yii::app()->getBasePath().'/images/'.$temp_file_name);

	        	$imageName = $temp_file_name;
	        }
        }

		if(isset($_POST['Recipe']))
		{
			$model->attributes=$_POST['Recipe'];
			$model->imageName=$imageName;
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
			'image'=>new ImageFileForm,
		));
	}

	private function createMapping($recipe_id, $ingredient_id, $quantity, $measurement_id) {
		$mapping = new RecipeIngredientQuantityMapping;
		$mapping->recipe_id = $recipe_id;
		$mapping->ingredient_id = $ingredient_id;
		$mapping->quantity = $quantity;
		$mapping->measurement_id = $measurement_id;

		$mapping->save();
	}

	private function hasDuplicate($models, $model) {
		foreach($models as $item) {
			if(strcasecmp($item->name, $model->name) == 0) {
				return true;
			}
		}

		return false;
	}

	private function ingredientExists($name) {
		if(Ingredient::model()->findByAttributes(array('name'=>$name))) {
			return true;
		} else {
			return false;
		}
	}

	private function measurementExists($name) {
		if(Measurement::model()->findByAttributes(array('name'=>$name))) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id) 
	{
		$model=$this->loadModel($id);

		$mapping = RecipeIngredientQuantityMapping::model()->findAll(array("condition"=>"recipe_id=$id","order"=>"id"));
		
		$results = $this->extractDataModel($mapping);

		$i = 0;

		// Uncomment the following line if AJAX validation is needed
		//$this->performAjaxValidation($model);

		if(isset($_POST['Ingredient'])) {
			$ingredients = $this->extractIngredients($_POST['Ingredient']);
			$quantities = $this->extractQuantities($_POST['RecipeIngredientQuantityMapping']);
			$measurements = $this->extractMeasurements($_POST['Measurement']);

			//Updated Recipe contains EQUAL or LESS amount of ingredients
			if(sizeof($ingredients) == sizeof($mapping) || sizeof($ingredients) < sizeof($mapping)) {
				foreach($ingredients as $ingredient) {
					if(!$this->ingredientExists($ingredient->name)) {
						$ingredient->save();
						$mapping[$i]->ingredient_id = $ingredient->id;
					} else {
						$mapping[$i]->ingredient_id = Ingredient::model()->findByAttributes(array('name'=>$ingredient->name))->id;
					}

					if(!$this->measurementExists($measurements[$i]->name)) {
						$measurements[$i]->save();
						$mapping[$i]->measurement_id = $measurements[$i]->id;
					} else {
						$mapping[$i]->measurement_id = Measurement::model()->findByAttributes(array('name'=>$measurements[$i]->name))->id;
					}

					$mapping[$i]->quantity = $quantities[$i]->quantity;

					$mapping[$i]->save();

					$i++;
				}

				//LESS amount of ingredients, hence delete the old extra mapping entries
				if(sizeof($ingredients) < sizeof($mapping)) {
					for($j=$i; $j<sizeof($mapping); $j++) {
						$mapping[$j]->delete();
					}
				}
			} else { //Updated Recipe contains MORE ingredients
				foreach($ingredients as $ingredient) {
					if(!$this->ingredientExists($ingredient->name)) {
						$ingredient->save();
						$mapping[$i]->ingredient_id = $ingredient->id;
					} else {
						$mapping[$i]->ingredient_id = Ingredient::model()->findByAttributes(array('name'=>$ingredient->name))->id;
					}

					if(!$this->measurementExists($measurements[$i]->name)) {
						$measurements[$i]->save();
						$mapping[$i]->measurement_id = $measurements[$i]->id;
					} else {
						$mapping[$i]->measurement_id = Measurement::model()->findByAttributes(array('name'=>$measurements[$i]->name))->id;
					}

					$mapping[$i]->quantity = $quantities[$i]->quantity;

					$mapping[$i]->save();

					$i++;

					if($i >= sizeof($mapping))
						break;
				}

				//Creating mapping for the remaining additional ingredients
				for($j=$i; $j<sizeof($_POST['Ingredient']); $j++) {
					$ingredient_id;
					$measurement_id;

					if(!$this->ingredientExists($ingredients[$j]->name)) {
						$ingredients[$j]->save();
						$ingredient_id = $ingredients[$j]->id;
					} else {
						$ingredient_id = Ingredient::model()->findByAttributes(array('name'=>$ingredients[$j]->name))->id;
					}

					if(!$this->measurementExists($measurements[$j]->name)) {
						$measurements[$j]->save();
						$measurement_id = $measurements[$j]->id;
					} else {
						$measurement_id = Measurement::model()->findByAttributes(array('name'=>$measurements[$i]->name))->id;
					}

					$this->createMapping($id, $ingredient_id, $quantities[$j]->quantity, $measurement_id);
				}
			} 
		}

		if(isset($_POST['Recipe']))
		{
			$model->attributes=$_POST['Recipe'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id)); //,'count'=>sizeof($_POST['Ingredient'])));
		}


		$this->render('update',array(
			'model'=>$model,
			'ingredient'=>$results['ingredient'],
			'mapping'=>$results['mapping'],
			'measurement'=>$results['measurement'],
			'_ingredient'=>new Ingredient,
			'_mapping'=>new RecipeIngredientQuantityMapping,
			'_measurement'=>new Measurement
		));
	}

	/**
	 * Loop through the $_POST['RecipeIngredientQuantityMapping'] and push each model into the $results array.
	 * Hence, the indexes in the $results array will be in sequence which $_POST['RecipeIngredientQuantityMapping'] lacks.
	 * NOTE: the objects(models) in the $results array are not being saved yet(Thus not in the SQL DB yet). Hence, there are no id field for those models. It's just a skeleton. Not a true saved data.
	 * @param $_POST['RecipeIngredientQuantityMapping']
	*/
	private function extractQuantities($quantities) {
		$results = [];

		foreach ($quantities as $quantity) {
			$temp = new RecipeIngredientQuantityMapping;
			$temp->attributes = $quantity;
			array_push($results, $temp);
		}

		return $results;
	}

	/**
	 * Loop through the $_POST['Ingredient'] and push each model into the $results array.
	 * Hence, the indexes in the $results array will be in sequence which $_POST['Ingredient'] lacks.
	 * NOTE: the objects(models) in the $results array are not being saved yet(Thus not in the SQL DB yet). Hence, there are no id field for those models. It's just a skeleton. Not a true saved data.
	 * @param $_POST['Ingredient']
	*/
	private function extractIngredients($ingredients) {
		$results = [];

		foreach($ingredients as $ingredient) {
			$temp = new Ingredient;
			$temp->attributes = $ingredient;
			array_push($results, $temp);
		}

		return $results;
	}

	/**
	 * Loop through the $_POST['Measurement'] and push each model into the $results array.
	 * Hence, the indexes in the $results array will be in sequence which $_POST['Measurement'] lacks.
	 * NOTE: the objects(models) in the $results array are not being saved yet(Thus not in the SQL DB yet). Hence, there are no id field for those models. It's just a skeleton. Not a true saved data.
	 * @param $_POST['Measurement']
	*/
	private function extractMeasurements($measurements) {
		$results = [];

		foreach($measurements as $measurement) {
			$temp = new Measurement;
			$temp->attributes = $measurement;
			array_push($results, $temp);
		}

		return $results;
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

		if(RecipeIngredientQuantityMapping::model()->deleteAllByAttributes(array('recipe_id'=>$id))) {
			$dataProvider = new CActiveDataProvider('Recipe');
			Yii::app()->user->setFlash('success', "Recipe ".$name." has been deleted!"); //Flash alert-message with the title:'success', message:"Recipe $name has been deleted" -> it will then be displayed in the index(view)
			$this->render('index', array('dataProvider'=>$dataProvider));
		}

		/* DEFAULT */
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