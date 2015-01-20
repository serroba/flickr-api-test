<?php foreach ($images as $image):?>
<?php // var_dump($image);?>
<div>
	<a href="<?=$image->image_sizes['original']['source']?>" target="_blank">
		<img src="<?=$image->image_sizes['thumbnail']['source']?>">
	</a>
</div>
<?php endforeach; ?>

