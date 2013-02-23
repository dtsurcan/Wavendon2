<?php
/* @var $this UserController */

$this->breadcrumbs=array(
	'My profile',
);
?>
<h1>My profile</h1>

<p>
	
<?php

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

$this->widget('bootstrap.widgets.TbTabs', array(
    'type'=>'tabs',
    'placement'=>'above', // 'above', 'right', 'below' or 'left'
    'tabs'=>array(
        array('label'=>'Personal data', 'content'=> $personal_data, 'active'=>true),
        array('label'=>'Copy of Driving Licence', 'content'=>'image of Copy of Driving Licence'),
        array('label'=>'Copy of Passport', 'content'=>'image of Copy of Passport'),
        array('label'=>'Photos', 'content'=>'images'),
    ),
)); 

?>

</p>
