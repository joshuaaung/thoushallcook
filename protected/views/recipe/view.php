<?php
/* @var $this RecipeController */
/* @var $model Recipe */

$this->breadcrumbs=array(
	'Recipes'=>array('index'),
	$model->name,
);
?>

<?php
$this->menu=array(
	array('label'=>'List Recipe', 'url'=>array('index')),
	array('label'=>'Create Recipe', 'url'=>array('create')),
	array('label'=>'Update Recipe', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Recipe', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Manage Recipe', 'url'=>array('admin')),
);
?>

<div class="label" >
	<h1><b><?php echo $model->name; ?></b></h1>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-6 text-center">
			<a id='ingredient' class="btn btn-primary btn-sm active"><i class="fa fa-2x fa-pencil-square-o wow bounceIn text-primary" style="color:#fff" data-wow-delay=".3s"></i><h4>Ingredients</h4></a>
		</div>
		<div class="col-md-6 col-md-6 text-center">
			<a id='about' class="btn btn-primary btn-sm active"><i class="fa fa-2x fa-info wow bounceIn text-primary" style="color:#fff" data-wow-delay=".3s"></i><h4>About</h4></a>
		</div>
	</div>
</div>

<div id='ingredientTable' class="ingredientTable" style="display:none">
<?php 
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
	),
));

for($i=0; $i<count($results['ingredient']); $i++) {
	$this->widget('zii.widgets.CDetailView', array(
		'data'=>$results['ingredient'][$i],
		'attributes'=>array(
			array(
				'label'=>'Ingredient '.($i+1),
				'value'=>$results['ingredient'][$i]->name,
			),
		),
	));

	$this->widget('zii.widgets.CDetailView', array(
		'data'=>$results['quantity'][$i],
		'attributes'=>array(
			array(
				'label'=>'Quantity',
				'value'=>$results['quantity'][$i],
			),
			array(
				'label'=>'Measurement',
				'value'=>$results['measurement'][$i]->name,
			)
		),
	));
}

?>
</div>
	
<div id='aboutPage' style="display:none">
	<h1>About each recipe, load up from the database...</h1>
</div>



<script>
$('#ingredient').on('click', function() {
	$('#ingredientTable').slideToggle(300);
});

$('#about').on('click', function() {
	$('#aboutPage').slideToggle(300);
});
</script>
