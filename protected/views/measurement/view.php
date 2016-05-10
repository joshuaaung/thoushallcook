<?php
/* @var $this MeasurementController */
/* @var $model Measurement */

$this->breadcrumbs=array(
	'Measurements'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Measurement', 'url'=>array('index')),
	array('label'=>'Create Measurement', 'url'=>array('create')),
	array('label'=>'Update Measurement', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Measurement', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Measurement', 'url'=>array('admin')),
);
?>

<h1>View Measurement #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
