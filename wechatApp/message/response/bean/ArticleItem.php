<?php
/**
 * 图片文本消息项
 * @author Administrator
 *
 */
class ArticleItem {
	public $tilte;
	public $description;
	public $picUrl;
	public $url;
	/**
	 * 图片
	 * @param unknown_type $tilte
	 * @param unknown_type $description
	 * @param unknown_type $picUrl
	 * @param unknown_type $url
	 */
	public function __construct($tilte,$description,$picUrl,$url){
		$this->tilte = $tilte;;
		$this->description = $description;
		$this->picUrl = $picUrl;
		$this->url=$url;
	}
}