<?php
/* @var $this QuantityController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Quantities',
);

$this->menu=array(
	array('label'=>'Create Quantity', 'url'=>array('create')),
	array('label'=>'Manage Quantity', 'url'=>array('admin')),
);
?>

<h1>Quantities</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
