<?php 
require_once 'MessageProcessor.php';
/**
 * 消息处理器工厂类
 * @author Administrator
 *
 */
class MessageProcessFactory {
	/**
	 * 创建处理器工厂方法
	 * @param unknown_type $postObj
	 */
	static function createMessageProcess($postObj) {
		$messageType = $postObj->MsgType;
		switch ($messageType){
			case "event":{
				return  new EventMessageProcessor($postObj);
			}
			case "text" :{
				return  new TextMessageProcessor($postObj);
			}
			case "image":{
				return  new ImageMessageProcessor($postObj);
			}
			case "voice" :{
				return  new VoiceMessageProcessor($postObj);
			}
			case "video":{
				return  new VideoMessageProcessor($postObj);
			}
			case "location" :{
				return  new LocationMessageProcessor($postObj);
			}
			case "link":{
				return  new LinkMessageProcessor($postObj);
			}
			default:{
				return  new TextMessageProcessor($postObj);
			}
		}
	}
}

?>