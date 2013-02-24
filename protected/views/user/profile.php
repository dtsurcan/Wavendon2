<?php
/* @var $this UserController */

$this->breadcrumbs=array(
	'My profile',
);
?>
<h1>My profile</h1>

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

ob_start();
$this->widget('bootstrap.widgets.TbThumbnails', array(
    'dataProvider'=>$dataCopiesOfDriving,
    'template'=>"{items}\n{pager}",
    'itemView'=>'_thumb',
));
$copy_driving_images = ob_get_contents();
ob_end_clean();

//3-tab
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

ob_start();
$this->widget('bootstrap.widgets.TbThumbnails', array(
    'dataProvider'=>$dataCopiesOfPassport,
    'template'=>"{items}\n{pager}",
    'itemView'=>'_thumb',
));
$copy_passport_images = ob_get_contents();
ob_end_clean();

//4-tab
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

ob_start();
$this->widget('bootstrap.widgets.TbThumbnails', array(
    'dataProvider'=>$dataPhotos,
    'template'=>"{items}\n{pager}",
    'itemView'=>'_thumb',
));
$photo_images = ob_get_contents();
ob_end_clean();

$this->widget('bootstrap.widgets.TbTabs', array(
    'type'=>'tabs',
    'placement'=>'above', // 'above', 'right', 'below' or 'left'
    'tabs'=>array(
        array('label'=>'Personal data', 'content'=> $personal_data, 'active'=>true),
        array('label'=>'Copy of Driving Licence', 'content'=> $copy_driving_data.$copy_driving_images ),
        array('label'=>'Copy of Passport', 'content'=> $copy_passport_data.$copy_passport_images),
        array('label'=>'Photos', 'content'=> $photos_data.$photo_images),
    ),
)); 

?>

</p>

<script type="text/javascript">
	$(document).ready(function() {
		$(".fancybox").fancybox();
		
		$(".remove-image").each(function(){
			$(this).bind('click', function(){
				if (confirm('You really want to delete?')){
					wdAjax('<?php echo Yii::app()->createUrl('/user/removeImage');?>', 
						{ id : $(this).attr('data'), type : $(this).attr('data-type') }, 
					 	function(data){
							if(data.resp == 'ok'){
								
						 	}	 
						}
					);
				}
			})
		})
	});
</script>