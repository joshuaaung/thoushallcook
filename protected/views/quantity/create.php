<?php
/* @var $this QuantityController */
/* @var $model Quantity */

$this->breadcrumbs=array(
	'Quantities'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Quantity', 'url'=>array('index')),
	array('label'=>'Manage Quantity', 'url'=>array('admin')),
);
?>

<h1>Create Quantity</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>