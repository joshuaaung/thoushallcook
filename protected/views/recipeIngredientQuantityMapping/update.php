<?php
/* @var $this RecipeIngredientQuantityMappingController */
/* @var $model RecipeIngredientQuantityMapping */

$this->breadcrumbs=array(
	'Recipe Ingredient Quantity Mappings'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RecipeIngredientQuantityMapping', 'url'=>array('index')),
	array('label'=>'Create RecipeIngredientQuantityMapping', 'url'=>array('create')),
	array('label'=>'View RecipeIngredientQuantityMapping', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage RecipeIngredientQuantityMapping', 'url'=>array('admin')),
);
?>

<h1>Update RecipeIngredientQuantityMapping <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>