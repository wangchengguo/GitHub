<?php
/**
 * 回复消息基类
 * @author Administrator
 *
 */
abstract  class  AbstractBaseMessage {
	protected $message;
	protected  $fromUsername;
	protected  $toUsername ;
	protected  $time ;
	/**
	 * 获取消息模板
	 */
	protected abstract function getMessageContent();
	/**
	 * 
	 * @param unknown_type $fromUsername 消息发送者
	 * @param unknown_type $toUsername 消息接收者
	 */
	public function __construct($toUsername,$fromUsername){
		 $this->time = time();
		 $this->fromUsername = $fromUsername;
		 $this->toUsername = $toUsername;
//		 echo "父类方法1..\n".$this->toUsername;
	}
	public function getMessage() {
		$messageType = $this->getMessageType();
		$tpl_header = "<xml>
						<ToUserName><![CDATA[{$this->toUsername}]]></ToUserName>
						<FromUserName><![CDATA[{$this->fromUsername}]]></FromUserName>
						<CreateTime>{$this->time}</CreateTime>
						<MsgType><![CDATA[{$messageType}]]></MsgType>";
		$tpl_footer = "</xml>";
		$this->message = $tpl_header.$this->getMessageContent().$tpl_footer;
		return  $this->message;
	}
	protected  abstract  function getMessageType();
}
