<?php
/* @var $this RecipeController */
/* @var $model Recipe */

$this->breadcrumbs=array(
	'Recipes'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Recipe', 'url'=>array('index')),
	array('label'=>'Create Recipe', 'url'=>array('create')),
	array('label'=>'View Recipe', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Recipe', 'url'=>array('admin')),
);
?>

<h1>Update Recipe <?php echo $model->name; ?></h1>

<?php $this->renderPartial('_updateForm', array('model'=>$model, 'ingredient'=>$ingredient, 'mapping_quantity'=>$mapping, 'measurement'=>$measurement, '_ingredient'=>$_ingredient, '_quantity'=>$_mapping, '_measurement'=>$_measurement)); ?>