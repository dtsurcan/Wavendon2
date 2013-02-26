<?php
/* @var $this UserController */

$this->breadcrumbs=array(
	'Change profile',
);
?>
<h1>Change profile</h1>

<p>
	
<?php 

// 1-tab
ob_start();
$this->widget('editable.EditableDetailView', array(
    'data'   => $user,
    'url'    => $this->createUrl('user/update'), //common submit url for all fields
    'params' => array('YII_CSRF_TOKEN' => Yii::app()->request->csrfToken), //params for all fields
    'attributes' => array(
        array(
            'name' => 'title_id',
            'editable' => array(
                'type'   => 'select',
                'source' => CHtml::listData( UserTitles::model()->findAll(), 'id', 'name'),
            )
        ),
        array(
            'name' => 'first_name',
            'editable' => array(
                'type'       => 'text',
                'inputclass' => 'input-large',
                'validate'   => 'function(value) {
                    if(!value) return "User First Name is required (client side)"
                }'
            )
        ),
        array(
            'name' => 'middle_name',
            'editable' => array(
                'type'       => 'text',
                'inputclass' => 'input-large',
                'validate'   => 'function(value) {
                    if(!value) return "User Middle Name is required (client side)"
                }'
            )
        ),
        array(
            'name' => 'last_name',
            'editable' => array(
                'type'       => 'text',
                'inputclass' => 'input-large',
                'validate'   => 'function(value) {
                    if(!value) return "User Last Name is required (client side)"
                }'
            )
        ),
        array(
            'name' => 'passport_number',
            'editable' => array(
                'type'       => 'text',
                'inputclass' => 'input-large',
                'validate'   => 'function(value) {
                    if(!value) return "Passport Number is required (client side)"
                }'
            )
        ),
        array(
            'name' => 'driving_license_number',
            'editable' => array(
                'type'       => 'text',
                'inputclass' => 'input-large',
                'validate'   => 'function(value) {
                    if(!value) return "Driving License Number is required (client side)"
                }'
            )
        ),
        array(
            'name' => 'note',
            'editable' 	=> array(
                'type'  	=> 'textarea'
            )
        ),
    )
));

$personal_data = ob_get_contents();
ob_end_clean();

//2-tab
	// Form to upload
		ob_start();
		$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		    'id'=>'copy-driving-form',
		    'type'=>'horizontal',
		    'htmlOptions' => array('enctype' => 'multipart/form-data'),
		    'enableAjaxValidation'=>false,
		)); ?>
		 
		<fieldset>
			<?php echo $form->fileFieldRow($copy_driving, 'link'); ?>
		</fieldset>
		 
		<div class="form-actions">
		    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Submit')); ?>
		    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Reset')); ?>
		</div>
		 
		<?php $this->endWidget(); 
		
		$copy_driving_data = ob_get_contents();
		ob_end_clean();
	
	// Images
		ob_start();
		$this->widget('bootstrap.widgets.TbThumbnails', array(
		    'dataProvider'=>$dataCopiesOfDriving,
		    'template'=>"{items}\n{pager}",
		    'itemView'=>'_thumb_wd',
		));
		$copy_driving_images = ob_get_contents();
		ob_end_clean();
	
	// Form control images	
		ob_start();
		$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		    'id'=>'delete-driving-form',
		    'type'=>'horizontal',
		)); ?>
		
		<div class="controls select-all">
			<label class="checkbox">
				<?php echo CHtml::checkBox('selectAll', false, array('class'=>'selectAll')); ?> Select all images
			</label>
		</div>

		<fieldset>
			<?php echo $copy_driving_images; ?>
		</fieldset>
		 
		<div class="form-actions">
		    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Delete')); ?>
		    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Reset')); ?>
		</div>
		 
		<?php $this->endWidget(); 
		
		$copy_drivig_control_form = ob_get_contents();
		ob_end_clean();

//3-tab
	// Form to upload
		ob_start();
		$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		    'id'=>'copy-passport-form',
		    'type'=>'horizontal',
		    'htmlOptions' => array('enctype' => 'multipart/form-data'),
		    'enableAjaxValidation'=>false,
		)); ?>
		 
		<fieldset>
			<?php echo $form->fileFieldRow($copy_passport, 'link'); ?>
		</fieldset>
		 
		<div class="form-actions">
		    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Submit')); ?>
		    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Reset')); ?>
		</div>
		 
		<?php $this->endWidget(); 
		
		$copy_passport_data = ob_get_contents();
		ob_end_clean();

	// Images
		ob_start();
		$this->widget('bootstrap.widgets.TbThumbnails', array(
		    'dataProvider'=>$dataCopiesOfPassport,
		    'template'=>"{items}\n{pager}",
		    'itemView'=>'_thumb_wd',
		));
		$copy_passport_images = ob_get_contents();
		ob_end_clean();
		
	// Form control images	
		ob_start();
		$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		    'id'=>'delete-passport-form',
		    'type'=>'horizontal',
		)); ?>
		
		<div class="controls select-all">
			<label class="checkbox">
				<?php echo CHtml::checkBox('selectAll', false, array('class'=>'selectAll')); ?> Select all images
			</label>
		</div>

		<fieldset>
			<?php echo $copy_passport_images; ?>
		</fieldset>
		 
		<div class="form-actions">
		    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Delete')); ?>
		    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Reset')); ?>
		</div>
		 
		<?php $this->endWidget(); 
		
		$copy_passport_control_form = ob_get_contents();
		ob_end_clean();
		
//4-tab
	// Form to upload
		ob_start();
		$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		    'id'=>'photos-form',
		    'type'=>'horizontal',
		    'htmlOptions' => array('enctype' => 'multipart/form-data'),
		    'enableAjaxValidation'=>false,
		)); ?>
		 
		<fieldset>
			<?php echo $form->fileFieldRow($photos, 'link'); ?>
		</fieldset>
		 
		<div class="form-actions">
		    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Submit')); ?>
		    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Reset')); ?>
		</div>
		 
		<?php $this->endWidget(); 
		
		$photos_data = ob_get_contents();
		ob_end_clean();

	// Images
		ob_start();
		$this->widget('bootstrap.widgets.TbThumbnails', array(
		    'dataProvider'=>$dataPhotos,
		    'template'=>"{items}\n{pager}",
		    'itemView'=>'_thumb_wd',
		));
		$photo_images = ob_get_contents();
		ob_end_clean();

	// Form control images	
		ob_start();
		$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		    'id'=>'delete-photos-form',
		    'type'=>'horizontal',
		)); ?>
		
		<div class="controls select-all">
			<label class="checkbox">
				<?php echo CHtml::checkBox('selectAll', false, array('class'=>'selectAll')); ?> Select all images
			</label>
		</div>

		<fieldset>
			<?php echo $photo_images; ?>
		</fieldset>
		 
		<div class="form-actions">
		    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Delete')); ?>
		    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Reset')); ?>
		</div>
		 
		<?php $this->endWidget(); 
		
		$photos_control_form = ob_get_contents();
		ob_end_clean();
		
// Tabs
$this->widget('bootstrap.widgets.TbTabs', array(
    'type'=>'tabs',
    'placement'=>'above', // 'above', 'right', 'below' or 'left'
    'tabs'=>array(
        array('label'=>'Personal data', 'content'=> $personal_data, 'active'=>true),
        array('label'=>'Copy of Driving Licence', 'content'=> $copy_driving_data.$copy_drivig_control_form
		 ),
        array('label'=>'Copy of Passport', 'content'=> $copy_passport_data.$copy_passport_control_form),
        array('label'=>'Photos', 'content'=> $photos_data.$photos_control_form),
    ),
)); 

?>

</p>

<script type="text/javascript">
	$(document).ready(function() {
		$(".fancybox").fancybox();

		wdSelectAll('.selectAll');
		
		$('form').each(function(){
			$(this).bind('submit', function(){
				if ($(this).attr('id') == 'delete-driving-form' || 
					$(this).attr('id') == 'delete-passport-form' ||
					$(this).attr('id') == 'delete-photos-form')
				{
					var form = $(this);
					var fieldset = form.find('fieldset');
					var ids = new Array();
					fieldset.find("[type='checkbox']").each(function(){
						if ($(this).is(':checked'))
						{
							ids[ids.length] = $(this).val();
						}
					})
				
				if (ids.toString().length > 0)
				{	
					if (confirm('You really want to delete?')){
						wdAjax('<?php echo Yii::app()->createUrl('/user/removeImage');?>', 
							{ ids : ids.toString(), type : $(this).attr('id') }, 
						 	function(data){
								if(data.resp == 'ok'){
									fieldset.find("[type='checkbox']").each(function(){
										if ($(this).is(':checked'))
										{
											$(this).parents('li').remove();
										}
									})
							 	}	 
							}
						);
					}
				}
					return false;
				}
			})
		})

	});
</script>