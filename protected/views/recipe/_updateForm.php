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
		<?php echo $form->textField($model,'name',array('class'=>'form-control','size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
	
	</br>

	<div class="row">
        <?php echo CHtml::button('Add Ingredient', array('onClick'=>'addIngredient($(".input-wrapper"))', 'class'=>'btn btn-success btn-sm active')); ?>
	</div>

	</br>

	<div id="ingredient_input" class="input-wrapper"></div>
	
	<div class="row buttons">
		<?php echo CHtml::button('Update Recipe', array('submit'=>array('recipe/update', 'id'=>$model->id), 'class'=>'btn btn-success', 'style'=>'margin-left:220px; margin-top:20px; margin-bottom:20px')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
var total_ingredients = <?php echo sizeof($ingredient); ?>;

var index = 0;

var new_ingredient = new String(<?php echo CJSON::encode($this->renderPartial('_ingredientForm', array('i'=>'idPlaceHolder', 'ingredient'=>$_ingredient, 'mapping_quantity'=>$_quantity, 'measurement'=>$_measurement,'form'=>$form, 'load_data'=>false), true));?>);

var old_ingredient = new String(<?php echo CJSON::encode($this->renderPartial('_ingredientForm', array('ingredient'=>$ingredient, 'mapping_quantity'=>$mapping_quantity, 'measurement'=>$measurement,'form'=>$form, 'load_data'=>true), true));?>);

function addIngredient(wrapper) {
	index++;
	wrapper.append(new_ingredient.replace(/idPlaceHolder/g, 'n'+index));
}

function deleteIngredient(wrapper) {
	index--;
    wrapper.parents('#ingredient_form').detach();
}

function loadIngredients() {	
	var divs = old_ingredient.split("</br>");

	for(var i=0; i<total_ingredients; i++){
		$('.input-wrapper').append(divs[i]);
	}
}

window.onload = loadIngredients;
</script>