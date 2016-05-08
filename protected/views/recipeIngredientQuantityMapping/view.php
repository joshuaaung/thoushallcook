<?php
/* @var $this RecipeIngredientQuantityMappingController */
/* @var $model RecipeIngredientQuantityMapping */

$this->breadcrumbs=array(
	'Recipe Ingredient Quantity Mappings'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List RecipeIngredientQuantityMapping', 'url'=>array('index')),
	array('label'=>'Create RecipeIngredientQuantityMapping', 'url'=>array('create')),
	array('label'=>'Update RecipeIngredientQuantityMapping', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete RecipeIngredientQuantityMapping', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RecipeIngredientQuantityMapping', 'url'=>array('admin')),
);
?>

<h1>View RecipeIngredientQuantityMapping #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'recipe_id',
		'ingredient_id',
		'quantity_id',
	),
)); ?>
