<?php if(!$load_data) { ?>
<div id="ingredient_form">
	<div class="row">
		<?php echo $form->labelEx($ingredient,"Ingredient"); ?>
		<?php echo $form->textField($ingredient,"[$i]name", array('class'=>'form-control','size'=>30, 'maxlength'=>30)); ?>
		<?php echo $form->error($ingredient,"[$i]name"); ?>
	</div>

	<div class="row">
	    <?php echo $form->labelEx($mapping_quantity,'Quantity'); ?>
	    <?php echo $form->textField($mapping_quantity,"[$i]quantity", array('class'=>'form-control','size'=>10, 'maxlength'=>10)); ?>
	    <?php echo $form->error($mapping_quantity,"[$i]quantity"); ?>
	</div>

	<div class="row">
	    <?php echo $form->labelEx($measurement,'Measurement'); ?>
	    <?php echo $form->textField($measurement,"[$i]name", array('class'=>'form-control','size'=>20, 'maxlength'=>20)); ?>
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
<?php } ?>
	
<?php if($load_data) { ?>
	<?php for($i = 0; $i<sizeof($ingredient); $i++) { ?>
		<div id="ingredient_form">
			<div class="row">
				<?php echo $form->labelEx($ingredient[$i],"Ingredient"); ?>
				<?php echo $form->textField($ingredient[$i],"[$i]name", array('class'=>'form-control','size'=>30, 'maxlength'=>30)); ?>
				<?php echo $form->error($ingredient[$i],"[$i]name"); ?>
			</div>

			<div class="row">
			    <?php echo $form->labelEx($mapping_quantity[$i],'Quantity'); ?>
			    <?php echo $form->textField($mapping_quantity[$i],"[$i]quantity", array('class'=>'form-control','size'=>10, 'maxlength'=>10)); ?>
			    <?php echo $form->error($mapping_quantity[$i],"[$i]quantity"); ?>
			</div>

			<div class="row">
			    <?php echo $form->labelEx($measurement[$i],'Measurement'); ?>
			    <?php echo $form->textField($measurement[$i],"[$i]name", array('class'=>'form-control','size'=>20, 'maxlength'=>20)); ?>
			    <?php echo $form->error($measurement[$i],"[$i]name"); ?>
			</div>

			<div class="row">
			<?php echo CHtml::link('Remove', '', array(
								'class'=>'btn btn-warning btn-sm active',
			                    'onClick'=>'deleteIngredient($(this))', 
			                    ));
			?>
			</div>
		</div>
		</br>
	<?php } ?>

	</div>

<?php } ?>
