<?php
/* @var $this QuantityController */
/* @var $model Quantity */

$this->breadcrumbs=array(
	'Quantities'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Quantity', 'url'=>array('index')),
	array('label'=>'Create Quantity', 'url'=>array('create')),
	array('label'=>'View Quantity', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Quantity', 'url'=>array('admin')),
);
?>

<h1>Update Quantity <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>