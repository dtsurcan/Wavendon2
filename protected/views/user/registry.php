<?php
/* @var $this SiteController */
/* @var $model RegistryForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Join us';
$this->breadcrumbs=array(
	'Join us',
);
?>

<h1>Join us</h1>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'registry-form',
    'type'=>'horizontal',
	'enableClientValidation'=>true,	
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	
	<?php echo $form->dropDownListRow($model, 'title_id', CHtml::listData( UserTitles::model()->findAll(), 'id', 'name') ); ?>
	
	<?php echo $form->textFieldRow($model,'first_name'); ?>
	
	<?php echo $form->textFieldRow($model,'middle_name'); ?>
	
	<?php echo $form->textFieldRow($model,'last_name'); ?>
	
	<?php echo $form->textFieldRow($model,'passport_number'); ?>
	
	<?php echo $form->textFieldRow($model,'driving_license_number'); ?>
	
	<?php echo $form->textFieldRow($model,'email'); ?>
	
	<?php echo $form->passwordFieldRow($model,'password'); ?>
    
    <?php echo $form->passwordFieldRow($model,'password_repeat'); ?>

	<?php if(CCaptcha::checkRequirements()): ?>
		<?php echo $form->captchaRow($model,'verifyCode',array(
            'hint'=>'Please enter the letters as they are shown in the image above.<br/>Letters are not case-sensitive.',
        )); ?>
	<?php endif; ?>
	
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>'Registry',
        )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
