<?php
require_once 'message/response/AbstractBaseMessage.php';
/**
 * 文本消息
 * @author Administrator
 *
 */
class TextMessage extends AbstractBaseMessage{
	private $content ;
	/**
	 * 
	 * @param unknown_type $fromUsername
	 * @param unknown_type $toUsername
	 * @param unknown_type $content 消息内容
	 */
	public function __construct($toUsername,$fromUsername,$content){
//		 echo "子类方法2..\n";
		$this->content = $content ;
		parent::__construct($toUsername,$fromUsername);
	}
/**
	 * 
	 */
	protected function getMessageContent() {
		return "<Content><![CDATA[{$this->content}]]></Content>";
	}

/**
	 * 
	 */
	protected function getMessageType() {
		return "text" ;
	}


}