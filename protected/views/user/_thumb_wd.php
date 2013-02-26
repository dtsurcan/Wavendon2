<?php 
	switch (get_class($data)) {
		case 'UserCopiesOfDriving':
			
			$link = '/images/copy/driving/';
			$group = 'driving';
			
			break;
		case 'UserCopiesOfPassport':
			
			$link = '/images/copy/passport/';
			$group = 'passport';
			
			break;
		case 'UserPhotos':
			
			$link = '/images/photos/';
			$group = 'photos';
			
			break;
		default:
			
			break;
	}
?>
<li class="span3">
	<div class="control-remove">
		<input type="checkbox" name="<?php echo $group; ?>" value="<?php echo $data->id; ?>" />
	</div>
    <a href="<?php echo $link.$data->user_id.'/'.$data->link; ?>" class="thumbnail fancybox" rel="<?php echo $group; ?>" title="<?php echo $data->date_create; ?>">
        <img src="<?php echo $link.$data->user_id.'/'.$data->link; ?>" alt="">
    </a>
</li>