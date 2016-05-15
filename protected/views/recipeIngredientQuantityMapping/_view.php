<?php
/* @var $this RecipeIngredientQuantityMappingController */
/* @var $data RecipeIngredientQuantityMapping */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('recipe_id')); ?>:</b>
	<?php echo CHtml::encode($data->recipe_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ingredient_id')); ?>:</b>
	<?php echo CHtml::encode($data->ingredient_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('quantity')); ?>:</b>
	<?php echo CHtml::encode($data->quantity); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('measurement_id')); ?>:</b>
	<?php echo CHtml::encode($data->measurement_id); ?>
	<br />


</div>