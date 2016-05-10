<?php
/* @var $this MeasurementController */
/* @var $model Measurement */

$this->breadcrumbs=array(
	'Measurements'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Measurement', 'url'=>array('index')),
	array('label'=>'Manage Measurement', 'url'=>array('admin')),
);
?>

<h1>Create Measurement</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>