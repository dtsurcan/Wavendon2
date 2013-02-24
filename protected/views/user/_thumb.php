<?php 
	switch (get_class($data)) {
		case 'UserCopiesOfDriving':
			
			$link = '/images/copy/driving/';
			$group = 'driving';
			$type = 1;
			
			break;
		case 'UserCopiesOfPassport':
			
			$link = '/images/copy/passport/';
			$group = 'passport';
			$type = 2;
			
			break;
		case 'UserPhotos':
			
			$link = '/images/photos/';
			$group = 'photos';
			$type = 3;
			
			break;
		default:
			
			break;
	}
?>
<li class="span3">
	
	<div class="control-remove">
		<div class="alert alert-error">
			<button type="button" class="close remove-image" data="<?php echo $data->id; ?>" data-type="<?php echo $type; ?>">&times;</button>			
			Click to remove
		</div>
	</div>
    <a href="<?php echo $link.$data->user_id.'/'.$data->link; ?>" class="thumbnail fancybox" rel="<?php echo $group; ?>" title="<?php echo $data->date_create; ?>">
        <img src="<?php echo $link.$data->user_id.'/'.$data->link; ?>" alt="">
    </a>
</li>