<?php
/* @var $this IngredientController */
/* @var $model Ingredient */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ingredient-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php if(Yii::app()->user->hasFlash('ingredient_exists')):?> <!-- See if any flash messages with the title 'ingredient_exists' exist in the singleton app() -->
	    <div class="alert alert-danger alert-dismissible" role="alert">
	    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <?php echo Yii::app()->user->getFlash('ingredient_exists'); ?>
	    </div>
	<?php endif; ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('class'=>'form-control','size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-primary', 'style'=>'margin-left:220px; margin-top:20px; margin-bottom:20px')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->