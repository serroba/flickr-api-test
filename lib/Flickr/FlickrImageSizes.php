<?php

namespace Lib\Flickr;

class FlickrImageSizes extends \Lib\Flickr
{
	protected function setMethod() {
		$this->method = 'flickr.photos.getSizes';
	}
	
	public function run($params = null){
		$sizes = simplexml_load_string(file_get_contents($this->builUrl(['photo_id' => $params['id']])))->sizes;
		$this->setThumbnail($sizes);
		$this->setOriginal($sizes);
	}
	
	public function setThumbnail($images_size){
		foreach($images_size->size as $image_size){
//			var_dump(reset($image_size->attributes())['label'], reset($image_size->attributes()));
			if(reset($image_size->attributes())['label'] == 'Thumbnail'){
				$this->thumbnail = reset($image_size->attributes());
			}
		}
	}
	
	public function setOriginal($images_size){
		foreach($images_size->size as $image_size){
			if(reset($image_size->attributes())['label'] == 'Original'){
				$this->original = reset($image_size->attributes());
				return;
			}
		}
		foreach($images_size->size as $image_size){
			if(reset($image_size->attributes())['label'] == 'Large'){
				$this->original = reset($image_size->attributes());
				return;
			}
		}
		
	}
	
	static public function create($id){
		$instance = new FlickrImageSizes;
		$instance->run(['id' => (int)$id]);
		return ['thumbnail' => $instance->thumbnail, 'original' => $instance->original];
	}
}
