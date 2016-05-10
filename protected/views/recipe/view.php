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
	//array('label'=>'Manage Recipe', 'url'=>array('admin')),
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

for($i = 0; $i < count($results['ingredient']); $i++){
	$this->widget('zii.widgets.CDetailView', array(
		'data'=>$results['ingredient'][$i],
		'attributes'=>array(
			array(
		      'label' => 'Ingredient '.($i+1),
		      'value' => $results['ingredient'][$i]->name,
		    )
		),
	));

	$this->widget('zii.widgets.CDetailView', array(
		'data'=>$results['quantity'][$i],
		'attributes'=>array(
			array(
		      'label' => 'Quantity',
		      'value' => $results['quantity'][$i]->name,
		    )
		),
	));

	$this->widget('zii.widgets.CDetailView', array(
		'data'=>$results['measurement'][$i],
		'attributes'=>array(
			array(
		      'label' => 'Measurement',
		      'value' => $results['measurement'][$i]->name,
		    )
		),
	));
}
?>
