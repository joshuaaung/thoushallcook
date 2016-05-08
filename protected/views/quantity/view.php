<?php
/* @var $this QuantityController */
/* @var $model Quantity */

$this->breadcrumbs=array(
	'Quantities'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Quantity', 'url'=>array('index')),
	array('label'=>'Create Quantity', 'url'=>array('create')),
	array('label'=>'Update Quantity', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Quantity', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Quantity', 'url'=>array('admin')),
);
?>

<h1>View Quantity #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
