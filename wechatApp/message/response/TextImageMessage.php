<?php
require_once 'message/response/AbstractBaseMessage.php';
require_once 'message/response/bean/ArticleItem.php';
/**
 * 图片文本信息
 * @author Administrator
 *
 */
class TextImageMessage extends AbstractBaseMessage{
	private $params ;
	/**
	 * 
	 * @param unknown_type $fromUsername
	 * @param unknown_type $toUsername
	 * @param unknown_type $params
	 * @param unknown_type $description
	 * @param unknown_type $picUrl
	 * @param unknown_type $url
	 */
	public function __construct(){
		$args  = func_get_args();
		$arglen = count($args);
		if($arglen ==3) {
			call_user_func_array(array($this,"__construct1"),$args);		
		}else if($arglen == 6){
			call_user_func_array(array($this,"__construct2"),$args);	
		}else {
			die("args length is not 3 or 6");
		}
		
	}
	/**
	 * 
	 * @param unknown_type $fromUsername
	 * @param unknown_type $toUsername
	 * @param unknown_type $params ArticleItem或ArticleItem数组
	 */
	public function __construct1($toUsername,$fromUsername,$params) {
		if(!is_array($params) && !($params instanceof ArticleItem)){
				die("Argument 3 must be an instance of Array or ArticleItem");
			}
		$this->params = $params ;
		parent::__construct($toUsername,$fromUsername);
	}
	/**
	 * 
	 * @param unknown_type $fromUsername
	 * @param unknown_type $toUsername
	 * @param unknown_type $title
	 * @param unknown_type $description
	 * @param unknown_type $picUrl
	 * @param unknown_type $url
	 */
	public function __construct2($toUsername,$fromUsername,$title,$description,$picUrl,$url) {
			$this->title = $title;
			$this->description =$description;
			$this->picUrl = $picUrl;
			$this->url = $url;
			parent::__construct($toUsername,$fromUsername);
	}
	protected function getMessageType() {
			return "news" ;
		}
	
/**
	 * 
	 */
	protected function getMessageContent() {
		print_r($this->params);
		if(is_array($this->params)){
			$len = count($this->params) ;
			$str = "<ArticleCount>{$len}</ArticleCount>
					<Articles>";
		 		 for ($i=0;$i<count($this->params);$i++){
		 		 	if($this->params[$i] instanceof ArticleItem){
		 		 		$str=$str."<item>
										<Title><![CDATA[{$this->params[$i]->tilte}]]></Title> 
										<Description><![CDATA[{$this->params[$i]->description}]]></Description>
										<PicUrl><![CDATA[{$this->params[$i]->picUrl}]]></PicUrl>
										<Url><![CDATA[{$this->params[$i]->url}]]></Url>
									</item>" ;
		 		 	}else {
		 		 		die("数组中第{$i}个元素不是 ArticleItem类型");
		 		 	}
			    }
						
			$str=$str."</Articles>";
			return $str;
		}elseif ($this->params instanceof ArticleItem){
			return "<ArticleCount>1</ArticleCount>
					<Articles>
						<item>
						<Title><![CDATA[{$this->params->tilte}]]></Title> 
						<Description><![CDATA[{$this->params->description}]]></Description>
						<PicUrl><![CDATA[{$this->params->picUrl}]]></PicUrl>
						<Url><![CDATA[{$this->params->url}]]></Url>
						</item>
					</Articles>";
		}else {
			return "<ArticleCount>1</ArticleCount>
					<Articles>
						<item>
						<Title><![CDATA[{$this->title}]]></Title> 
						<Description><![CDATA[{$this->description}]]></Description>
						<PicUrl><![CDATA[{$this->picUrl}]]></PicUrl>
						<Url><![CDATA[{$this->url}]]></Url>
						</item>
					</Articles>";
		}
	}

}