<div id="ingredient_form">
	<div class="row">
		<?php echo $form->labelEx($ingredient,"Ingredient"); ?>
		<?php echo $form->textField($ingredient,"[$i]name", array('size'=>30, 'maxlength'=>30)); ?>
		<?php echo $form->error($ingredient,"[$i]name"); ?>
	</div>

	<div class="row">
	    <?php echo $form->labelEx($mapping_quantity,'Quantity'); ?>
	    <?php echo $form->textField($mapping_quantity,"[$i]quantity", array('size'=>10, 'maxlength'=>10)); ?>
	    <?php echo $form->error($mapping_quantity,"[$i]quantity"); ?>
	</div>

	<div class="row">
	    <?php echo $form->labelEx($measurement,'Measurement'); ?>
	    <?php echo $form->textField($measurement,"[$i]name", array('size'=>20, 'maxlength'=>20)); ?>
	    <?php echo $form->error($measurement,"[$i]name"); ?>
	</div>

	<div class="row">
	<?php echo CHtml::link('Remove', '', array(
						'class'=>'btn btn-warning btn-sm active',
	                    'onClick'=>'deleteIngredient($(this))', 
	                    ));
	?>
	</div>
</div>