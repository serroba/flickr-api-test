<?php
namespace Lib\Flickr;


class FlickrSearch extends \Lib\Flickr
{
	public function __construct(array $params = []) {
		$this->page_size = \Config\Config::getInstance()->flickr['page_size'];
		$this->page = isset($params['page_number']) ? (int) $params['page_number'] : 1;
		parent::__construct($params);
	}

	protected function setMethod() {
		$this->method = 'flickr.photos.search';
	}

	public function run($query = null) {
		$keyword = filter_var($query, FILTER_SANITIZE_MAGIC_QUOTES);
		$params = ['text' => $keyword, 'per_page' => $this->page_size, 'page' => $this->page];
		$flickr_images = [];
		$xml_result = simplexml_load_string(file_get_contents($this->builUrl($params)));
		$this->setAttributes(reset($xml_result->photos->attributes()));
		foreach($xml_result->photos->photo as $photo){
			$flickr_images[] = new \Lib\FlickrImage(reset($photo->attributes()));
		}

		return $flickr_images;
	}

	private function setAttributes(array $attributes = []){
		foreach($attributes as $attr => $value){
			if($this->isValidAttr($attr)){
				$this->$attr = $value;
			}
		}
	}

	private function isValidAttr($attr){
		return in_array($attr, ['page', 'pages', 'perpage', 'total']);
	}

	public function getPaginationData(){
		return [
			'page' => $this->page,
			'pages' => $this->pages,
			'perpage' => $this->perpage,
			'total' => $this->total
		];
	}

}