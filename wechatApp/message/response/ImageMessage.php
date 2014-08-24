<?php
require_once 'message/response/AbstractBaseMessage.php';
/**
 * 图片消息
 * @author Administrator
 *
 */

class ImageMessage extends AbstractBaseMessage{
	private $mediaId ;
	/**
	 * 
	 * @param unknown_type $fromUsername
	 * @param unknown_type $toUsername
	 * @param unknown_type $mediaId 通过上传多媒体文件，得到的id。
	 */
	public function __construct($toUsername,$fromUsername,$mediaId){
		$this->mediaId = $mediaId ;
		parent::__construct($toUsername,$fromUsername);
	}
	protected function getMessageType() {
			return "image" ;
		}
/**
	 * 
	 */
	protected function getMessageContent() {
		return "<Image>
				<MediaId><![CDATA[{$this->mediaId}]]></MediaId>
				</Image>";
	}

}