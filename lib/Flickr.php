<?php
namespace Lib;

class Flickr
{
	private $secret;
	private $key;
	private $base_url = 'https://www.flickr.com/services/rest/?';
	private $method = 'flickr.photos.search';
	
	public function __construct() {
		$this->secret = \Config\Config::getInstance()->flickr['secret'];
		$this->secret = \Config\Config::getInstance()->flickr['key'];
	}
	
	private function builUrl(array $params = [])
	{
		$params['method'] = $this->method;
		return $this->base_url . http_build_query($params);
	}
	
	public function findImages($query)
	{
		$keyword = filter_var($query, FILTER_SANITIZE_MAGIC_QUOTES);
		var_dump($this->builUrl(['text' => $keyword]));die;
	}
}