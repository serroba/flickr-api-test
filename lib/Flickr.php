<?php
namespace Lib;

abstract class Flickr
{
	protected $secret;
	protected $key;
	protected $base_url = 'https://www.flickr.com/services/rest/?';
	protected $method ;
	protected $format;
	
	
	public function __construct(array $params = []) {
		$this->secret = \Config\Config::getInstance()->flickr['secret'];
		$this->key = \Config\Config::getInstance()->flickr['key'];
		$this->format = 'rest';
		$this->setMethod();
	}

	/**
	 * 
	 * @param type $format
	 * @return string
	 * @todo give support to multiple formats
	 */
//	public function getValidFormat($format = null){
//		if(in_array($format, ['json'])){
//			return $format;
//		}
//		return 'json';
//	}
			
	
	abstract protected function setMethod();
	
	protected function builUrl(array $params = [])
	{
		$params['method'] = $this->method;
		$params['api_key'] = $this->key;
		$params['format'] = $this->format;
		return $this->base_url . http_build_query($params);
	}
	
	abstract public function run($params = null);
}