<?php
/* @var $this RecipeIngredientQuantityMappingController */
/* @var $model RecipeIngredientQuantityMapping */

$this->breadcrumbs=array(
	'Recipe Ingredient Quantity Mappings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RecipeIngredientQuantityMapping', 'url'=>array('index')),
	array('label'=>'Manage RecipeIngredientQuantityMapping', 'url'=>array('admin')),
);
?>

<h1>Create RecipeIngredientQuantityMapping</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>