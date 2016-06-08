<?php
/* @var $this RecipeController */
/* @var $model Recipe */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'recipe-updateForm',
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

	<?php for($i = 0; $i<sizeof($ingredient); $i++) { ?>
		<div class="row">
	        <?php echo $form->labelEx($ingredient[$i],'['.$i.']'.'Ingredient '.($i+1)); ?>
	        <?php echo $form->textField($ingredient[$i],'['.$i.']'.'name', array('size'=>30, 'maxlength'=>30)); ?>
	        <?php echo $form->error($ingredient[$i],'['.$i.']'.'name'); ?>
	    </div>

	    <div class="row">
	        <?php echo $form->labelEx($mapping[$i],'['.$i.']'.'Quantity'); ?>
	        <?php echo $form->textField($mapping[$i],'['.$i.']'.'quantity', array('size'=>10, 'maxlength'=>10)); ?>
	        <?php echo $form->error($mapping[$i],'['.$i.']'.'quantity'); ?>
	    </div>

	    <div class="row">
	        <?php echo $form->labelEx($measurement[$i],'['.$i.']'.'Measurement'); ?>
	        <?php echo $form->textField($measurement[$i],'['.$i.']'.'name', array('size'=>20, 'maxlength'=>20)); ?>
	        <?php echo $form->error($measurement[$i],'['.$i.']'.'name'); ?>
	    </div>
	<?php } ?>

	<div class="row buttons">
		<?php echo CHtml::button('Update Recipe', array('submit'=>array('recipe/update', 'id'=>$model->id), 'class'=>'btn btn-success', 'style'=>'margin-left:220px; margin-top:20px; margin-bottom:20px')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->