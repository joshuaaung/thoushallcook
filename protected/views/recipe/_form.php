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
		<?php echo $form->textField($model,'name',array('class'=>'form-control','size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	</br>

	<div class="row">
        <?php echo CHtml::button('Add Ingredient', array('onClick'=>'addIngredient($(".input-wrapper"))', 'class'=>'btn btn-success btn-sm active')); ?>
	</div>

	</br>

	<div class="input-wrapper"></div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-primary', 'style'=>'margin-left:220px; margin-top:20px; margin-bottom:20px')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->


<script>
var num_ingredients = 0;

var ingredient = new String(<?php echo CJSON::encode($this->renderPartial('_ingredientForm', array('i'=>'idPlaceHolder', 'ingredient'=>$ingredient, 'mapping_quantity'=>$mapping_quantity, 'measurement'=>$measurement,'form'=>$form, 'load_data'=>false), true));?>);

function addIngredient(wrapper) {
	num_ingredients++;

	wrapper.append(ingredient.replace(/idPlaceHolder/g, 'n'+num_ingredients));
}

function deleteIngredient(wrapper) {
	num_ingredients--;
    wrapper.parents('#ingredient_form').detach();
}

(function($) {

})(jQuery);
</script>