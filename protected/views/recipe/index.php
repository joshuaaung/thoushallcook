<?php
/* @var $this RecipeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Recipes'
	);

$this->menu=array(
	array('label'=>'Create Recipe', 'url'=>array('create')),
	//array('label'=>'Manage Recipe', 'url'=>array('admin')),
	);
?>

<?php if(Yii::app()->user->hasFlash('success')):?> <!-- See if any flash messages with the title 'success' exist in the singleton app() -->
    <div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif; ?>

<h2 style="margin-bottom: 30px"><b>Recipes</b></h2>

<?php 
	/*
	foreach($dataProvider->getData() as $record) {

		echo '<a id="ingredient" class="btn btn-primary btn-sm active"><i class="fa fa-2x fa-pencil-square-o wow bounceIn text-primary" style="color:#fff" data-wow-delay=".3s"></i><h4>'.$record->name.'</h4></a>';
	}
	*/
	

	$this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
		'htmlOptions' => array('class'=>'list-group')
	)); 
?>
