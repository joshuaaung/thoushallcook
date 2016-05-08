<?php
/* @var $this RecipeController */
/* @var $data Recipe */
?>

<div class="view">

	<!--HIDE ID
	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />
	-->
	<b><?php echo CHtml::encode($data->getAttributeLabel('Recipe')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->name), array('view', 'id'=>$data->id, )); ?>
	<br />


</div>