<?php

require_once __DIR__ . '/../config/Config.php';
use Config\Config;
use Lib\Flickr;


$params = Config::getInstance()->flickr['secret'] . 
		'api_key' . Config::getInstance()->flickr['key'].
		'perms' . 'read';
$signature = md5($params);
var_dump($params, $signature);
$url  = "http://flickr.com/services/auth/?api_key=".Config::getInstance()->flickr['key']. "&perms=read&api_sig=$signature";
var_dump($url);die;

// determine which page to render
$page = filter_input(INPUT_GET, 'page') ? : 'index';
// show page
switch ($page) {
    case 'index':
        \Includes\Helpers::render('templates/header', ['title' => 'Flickr API Test']);
        
        \Includes\Helpers::render('templates/footer');
        break;
}