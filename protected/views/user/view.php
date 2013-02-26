<?php
/* @var $this UserController */

$this->breadcrumbs=array(
	'User profile',
);
?>

	<?php if ($not_found): ?>

		<?php $this->beginWidget('bootstrap.widgets.TbHeroUnit',array(
		    'heading'=>'User not found.',
		)); ?>
		<p>Sorry, but this user is not registered with us</p>

		<?php $this->endWidget(); ?>
		
	<?php else: ?>


<h1><?php echo $user->title->name." ".$user->first_name." ".$user->middle_name." ".$user->last_name; ?></h1>

<?php $this->widget('bootstrap.widgets.TbLabel', array(
    'type'  => 'info', // 'success', 'warning', 'important', 'info' or 'inverse'
    'label' => $user->getRole()->role->name,
)); ?>

<h3>Personal data</h3>
<p>
	<legend>Driving License Number</legend><?php echo !empty($user->driving_license_number)?$user->driving_license_number:'No results found.'; ?>
</p>	
<p>
	<legend>Passport Number</legend><?php echo !empty($user->passport_number)?$user->passport_number:'No results found.'; ?>
</p>	
<p>
	<legend>Note</legend><?php echo !empty($user->note)?$user->note:'No results found.'; ?>
</p>
<h3>Copy of Driving Licence</h3>
<?php
	$this->widget('bootstrap.widgets.TbThumbnails', array(
	    'dataProvider'=>$dataCopiesOfDriving,
	    'template'=>"{items}\n{pager}",
	    'itemView'=>'_thumb',
	));
?>

<h3>Copy of Passport</h3>
<?php
	$this->widget('bootstrap.widgets.TbThumbnails', array(
	    'dataProvider'=>$dataCopiesOfPassport,
	    'template'=>"{items}\n{pager}",
	    'itemView'=>'_thumb',
	));
?>

<h3>Photos</h3>
<?php
	$this->widget('bootstrap.widgets.TbThumbnails', array(
	    'dataProvider'=>$dataPhotos,
	    'template'=>"{items}\n{pager}",
	    'itemView'=>'_thumb',
	));
?>

<script type="text/javascript">
	$(document).ready(function() {
		$(".fancybox").fancybox();
	})
</script>

<?php endif; ?>
