<?php

require_once __DIR__ . '/../config/Config.php';
use Config\Config;
use Lib\Flickr;



if(!empty($keyword = filter_input(INPUT_GET, 'q'))){
	$page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT) ? : 0;
	$flickr = new Flickr\FlickrSearch(['page_number' => $page]);
	\Includes\Helpers::render('templates/header', ['title' => 'Flickr API Test']);
	\Includes\Helpers::render('templates/search-form');
	\Includes\Helpers::render('body', ['images' => $flickr->run($keyword)]);
	\Includes\Helpers::render('templates/pagination', ['pagination' => $flickr->getPaginationData(), 'keyword' => $keyword]);
	\Includes\Helpers::render('templates/footer');

} else {
	\Includes\Helpers::render('templates/header', ['title' => 'Flickr API Test']);
	\Includes\Helpers::render('templates/search-form');
	\Includes\Helpers::render('templates/footer');

}