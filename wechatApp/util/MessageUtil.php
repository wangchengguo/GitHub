<?php
require_once 'message/response/ImageMessage.php';
require_once 'message/response/MusicMessage.php';
require_once 'message/response/TextImageMessage.php';
require_once 'message/response/TextMessage.php';
require_once 'message/response/VideoMessage.php';
require_once 'message/response/VoiceMessage.php';
class MessageUtil {
	/**
	 * 不可实例化
	 */
	private function __construct(){}
/**
     * 发送文本消息
     * @param unknown_type $fromUsername
     * @param unknown_type $toUsername
     * @param unknown_type $time
     * @param unknown_type $contentStr
     */
    public function sendTextMessage($toUsername, $fromUsername, $contentStr){
		$textMessage = new TextMessage($toUsername,$fromUsername,$contentStr);
		echo $textMessage->getMessage();
    }
    /**
     * 发送一条图文信息
     * @param $fromUsername
     * @param $toUsername
     * @param $time
     * @param $title
     */
    public function sendOneTextImageMessage($toUsername,$fromUsername,$title,$description, $picUlr,$url) {
    	echo "send a imageTextMessage";
    	$message = new TextImageMessage($toUsername,$fromUsername,$title,$description, $picUlr,$url);
    	echo $message->getMessage();
    }
    /**
     * 发送多条文本图片消息
     * @param unknown_type $fromUsername
     * @param unknown_type $toUsername
     * @param Array $items ArticleItem数组
     */
    public function sendMoreTextImageMessage($toUsername,$fromUsername, $items) {
    	$message = new TextImageMessage($toUsername,$fromUsername,$items);
    	echo $message->getMessage();
    }
    /**
     * 发送声音消息
     * @param unknown_type $toUsername
     * @param unknown_type $fromUsername
     * @param unknown_type $mediaId
     */
    public function sendVoiceMessage($toUsername,$fromUsername,  $mediaId) {
    	$message = new VoiceMessage($toUsername,$fromUsername,$mediaId);
    	echo $message->getMessage();
    }
    /**
     * 发送视频消息
     * @param unknown_type $fromUsername
     * @param unknown_type $toUsername
     * @param unknown_type $mediaId
     * @param unknown_type $title
     * @param unknown_type $description
     */
    public function sendVideoMessage($fromUsername,$toUsername,$mediaId,$title,$description) {
    	$message = new VideoMessage($fromUsername,$toUsername,$mediaId,$title,$description);
    	echo $message->getMessage();
    }
    /**
     * 发送音乐消息
     * @param $fromUsername
     * @param $toUsername
     * @param $title
     * @param $description
     * @param $musicUrl
     * @param $hQMusicUrl
     * @param $thumbMediaId
     */
    public function sendMusicMessage($fromUsername,$toUsername,$title,$description,$musicUrl,$hQMusicUrl,$thumbMediaId) {
    	$message = new MusicMessage($fromUsername,$toUsername,$title,$description,$musicUrl,$hQMusicUrl,$thumbMediaId);
    	echo $message->getMessage();
    }
    public function sendImageMessage($fromUsername,$toUsername,$mediaId) {
    	$message = new ImageMessage($fromUsername,$toUsername,$mediaId);
    	echo $message->getMessage();
    }
    
}