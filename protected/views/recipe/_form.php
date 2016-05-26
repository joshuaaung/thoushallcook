<?php
/* @var $this RecipeController */
/* @var $model Recipe */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'recipe-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Recipe Name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<?php for($i = 0; $i<5; $i++) { ?>
		<div class="row">
	        <?php echo $form->labelEx($ingredient,'['.$i.']'.'Ingredient '.($i+1)); ?>
	        <?php echo $form->textField($ingredient,'['.$i.']'.'name', array('size'=>30, 'maxlength'=>30)); ?>
	        <?php echo $form->error($ingredient,'['.$i.']'.'name'); ?>
	    </div>

	    <div class="row">
	        <?php echo $form->labelEx($mapping_quantity,'['.$i.']'.'Quantity'); ?>
	        <?php echo $form->textField($mapping_quantity,'['.$i.']'.'quantity', array('size'=>10, 'maxlength'=>10)); ?>
	        <?php echo $form->error($mapping_quantity,'['.$i.']'.'quantity'); ?>
	    </div>

	    <div class="row">
	        <?php echo $form->labelEx($measurement,'['.$i.']'.'Measurement'); ?>
	        <?php echo $form->textField($measurement,'['.$i.']'.'name', array('size'=>20, 'maxlength'=>20)); ?>
	        <?php echo $form->error($measurement,'['.$i.']'.'name'); ?>
	    </div>
	<?php } ?>

	<!--
	<div class="row">
		<?php echo $form->labelEx($model,'image'); ?>
		<?php echo CHtml::activeFileField($model, 'image'); ?>
		<?php echo $form->error($model,'image'); ?>
	</div>
	-->

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-primary', 'style'=>'margin-left:220px; margin-top:20px; margin-bottom:20px')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->