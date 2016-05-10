<?php
/* @var $this RecipeIngredientQuantityMappingController */
/* @var $model RecipeIngredientQuantityMapping */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'recipe_id'); ?>
		<?php echo $form->textField($model,'recipe_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ingredient_id'); ?>
		<?php echo $form->textField($model,'ingredient_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'quantity_id'); ?>
		<?php echo $form->textField($model,'quantity_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'measurement_id'); ?>
		<?php echo $form->textField($model,'measurement_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->