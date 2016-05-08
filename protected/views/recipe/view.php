<?php
/* @var $this RecipeController */
/* @var $model Recipe */

$this->breadcrumbs=array(
	'Recipes'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Recipe', 'url'=>array('index')),
	array('label'=>'Create Recipe', 'url'=>array('create')),
	array('label'=>'Update Recipe', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Recipe', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Recipe', 'url'=>array('admin')),
);
?>

<h1>View Recipe <b><?php echo $model->name; ?></b></h1>

<?php 
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
	),
)); 

$counter = 1;
$ingredient_counter = 1;
foreach ($results as $result){
	if(($counter%2) != 0){
		$this->widget('zii.widgets.CDetailView', array(
			'data'=>$result,
			'attributes'=>array(
				array(
			      'label' => 'Ingredient '.$ingredient_counter,
			      'value' => $result->name,
			    )
			),
		));
		$ingredient_counter++;
	} else {
		$this->widget('zii.widgets.CDetailView', array(
			'data'=>$result,
			'attributes'=>array(
				array(
			      'label' => 'Quantity',
			      'value' => $result->name,
			    )
			),
		));
	}
	$counter++;
}
?>
