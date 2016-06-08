<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">

	<!-- Bootstrap CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.min.css" >

	<!-- Custom CSS -->
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/creative.css" type="text/css">

	<!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/font-awesome/css/font-awesome.min.css" type="text/css">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/animate.min.css" type="text/css">

    <!-- Font Awesome Icons -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- jQuery -->
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.js"></script>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

	<div class="container" id="page">

		<div id="header">
			<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
		</div><!-- header -->

		<nav id="mainNav" class="navbar navbar-fixed-top navbar-inverse">
			<div class="container">
				<div class="collapse navbar-collapse">
				<?php $this->widget('zii.widgets.CMenu',array(
					'items'=>array(
						array('label'=>'Home', 'url'=>array('/site/index')),
						//array('label'=>'About', 'url'=>array('/site/pages/', 'view'=>'about')),
						//array('label'=>'Contact', 'url'=>array('/site/contact')),
						//array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
						//array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
						array('label'=>'Recipe', 'url'=>array('/recipe/index')),
						array('label'=>'Ingredient Bank', 'url'=>array('/ingredient/index'))
					),
					'htmlOptions'=>array('class'=>'nav navbar-nav navbar-right')
				)); ?>
				</div><!-- collapse navbar-collapse -->
			</div><!-- container -->
		</nav><!-- mainNav -->

		<section>
			<?php if(isset($this->breadcrumbs)):?>
				<?php $this->widget('zii.widgets.CBreadcrumbs', array(
					'links'=>$this->breadcrumbs,
				)); ?><!-- breadcrumbs -->
			<?php endif?>

			<?php echo $content; ?>
		</section>
		
		<!--
		<div class="clear"></div>

		<div id="footer">
			Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
			All Rights Reserved.<br/>
			<?php echo Yii::powered(); ?>
		</div>
		-->

	</div><!-- page -->

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap.min.js"></script>

<!-- Plugin JavaScript -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.easing.min.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.fittext.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/wow.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/creative.js"></script>

</body>
</html>
