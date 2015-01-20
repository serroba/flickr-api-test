<?php

namespace Lib;

class FlickrImage
{

	public function __construct(array $params = [])
	{
		foreach ($params as $key => $value){
			if($this->isValidKey($key)){
				$this->$key = $value;
			}
		}
		$this->setImageSizes();
	}
	
	public function isValidKey($key)
	{
		return in_array($key, ['id', 'owner', 'secret', 'server', 'farm', 'title', 'ispublic', 'isfriend', 'isfamily']);
	}
	
	private function setImageSizes()
	{
		$this->image_sizes = \Lib\Flickr\FlickrImageSizes::create($this->id);
		
	}
	
}