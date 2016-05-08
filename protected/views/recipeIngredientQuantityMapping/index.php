<?php
/* @var $this RecipeIngredientQuantityMappingController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Recipe Ingredient Quantity Mappings',
);

$this->menu=array(
	array('label'=>'Create RecipeIngredientQuantityMapping', 'url'=>array('create')),
	array('label'=>'Manage RecipeIngredientQuantityMapping', 'url'=>array('admin')),
);
?>

<h1>Recipe Ingredient Quantity Mappings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
