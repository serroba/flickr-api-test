<div>
<?php if ($pagination['page'] > 1) :?>
	<?php $query = ['q' => $keyword, 'page' => $pagination['page'] - 1]?>
	<a href="<?= '/?' . http_build_query($query)?>">Previous Page</a>
<?php endif;?>
	...
<?php if($pagination['page'] < $pagination['pages']):?>
	<?php $query = ['q' => $keyword, 'page' => $pagination['page'] + 1]?>
	<a href="<?= '/?' . http_build_query($query)?>">Next Page</a>
<?php else:?>
	<span>End of results<span>
<?php endif; ?>
</div>