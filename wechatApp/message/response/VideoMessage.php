<?php
require_once 'message/response/AbstractBaseMessage.php';
/**
 * 视频消息
 * @author Administrator
 *
 */
class VideoMessage extends AbstractBaseMessage{
	private $mediaId ;
	private $title;
	private $description;
	/**
	 * 
	 * @param unknown_type $fromUsername
	 * @param unknown_type $toUsername
	 * @param unknown_type $mediaId 通过上传多媒体文件，得到的id。
	 * @param unknown_type $title 视频消息的标题
	 * @param unknown_type $description 视频消息的描述
	 */
	public function __construct($toUsername,$fromUsername,$mediaId,$title,$description){
		$this->mediaId = $mediaId ;
		$this->title = $title;
		$this->description = $title;
		parent::__construct($toUsername,$fromUsername);
	}
	protected function getMessageType() {
			return "video" ;
		}
/**
	 * 
	 */
	protected function getMessageContent() {
		return "<Video>
			<MediaId><![CDATA[{$this->mediaId}]]></MediaId>
			<Title><![CDATA[{$this->title}]]></Title>
			<Description><![CDATA[{$this->description}]]></Description>
			</Video> ";
	}

}