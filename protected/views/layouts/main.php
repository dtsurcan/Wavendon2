<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<?php Yii::app()->bootstrap->register(); ?>
	
	<!-- Add bootstrap-editable -->
	<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-editable.css" rel="stylesheet">
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap-editable.min.js"></script>
	
	<!-- Add mousewheel plugin (this is optional) -->
	<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/addition/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
	
	<!-- Add fancyBox -->
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/addition/fancybox/source/jquery.fancybox.css?v=2.1.4" type="text/css" media="screen" />
	<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/addition/fancybox/source/jquery.fancybox.pack.js?v=2.1.4"></script>
	
	<!-- Optionally add helpers - button, thumbnail and/or media -->
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/addition/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
	<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/addition/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/addition/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.5"></script>
	
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/addition/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
	<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/addition/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

    <!-- Add custom -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/common.js"></script>
	
</head>

<body>

<?php $this->widget('bootstrap.widgets.TbNavbar',array(
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
                array('label'=>'Home', 'url'=>array('/site/index')),
                array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
                array('label'=>'Contact', 'url'=>array('/site/contact'), 'visible'=>Yii::app()->user->isGuest),
                array('label'=>'Profile', 'url'=>array('/user/profile'), 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>'Join us', 'url'=>array('/user/registry'), 'visible'=>Yii::app()->user->isGuest),
                array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                array('label'=>'Logout ('.(@Yii::app()->user->getUser()->first_name).')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
            ),
        ),
    ),
)); ?>

<div class="container" id="page">

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		<?php echo Yii::app()->params['copyrightInfo']; ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
