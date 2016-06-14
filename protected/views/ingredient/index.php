<?php
/* @var $this IngredientController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ingredients',
);

$this->menu=array(
	array('label'=>'Create Ingredient', 'url'=>array('create')),
	//array('label'=>'Manage Ingredient', 'url'=>array('admin')),
);
?>

<?php if(Yii::app()->user->hasFlash('success_ingredient')):?> <!-- See if any flash messages with the title 'success' exist in the singleton app() -->
    <div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::app()->user->getFlash('success_ingredient'); ?>
    </div>
<?php endif; ?>

<h1 style="margin-bottom: 30px"><small>Ingredients</small></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
