<?php
require_once 'message/response/AbstractBaseMessage.php';
/**
 * 音乐消息
 * @author Administrator
 *
 */
class MusicMessage extends AbstractBaseMessage{
	private $musicUrl ;
	private $hQMusicUrl ;
	private $thumbMediaId ;
	private $title;
	private $description;
	/**
	 * 
	 * @param unknown_type $fromUsername
	 * @param unknown_type $toUsername
	 * @param unknown_type $title 音乐标题
	 * @param unknown_type $description音乐描述
	 * @param unknown_type $musicUrl音乐链接
	 * @param unknown_type $hQMusicUrl高质量音乐链接，WIFI环境优先使用该链接播放音乐
	 * @param unknown_type $thumbMediaId缩略图的媒体id，通过上传多媒体文件，得到的id
	 */
	public function __construct($toUsername,$fromUsername,$title,$description,$musicUrl,$hQMusicUrl,$thumbMediaId){
		$this->title = $title;
		$this->description = $title;
		$this->musicUrl = $musicUrl ;
		$this->hQMusicUrl = $hQMusicUrl;
		$this->thumbMediaId = $thumbMediaId;
		parent::__construct($toUsername,$fromUsername);
	}
	protected function getMessageType() {
			return "music" ;
		}
/**
	 * 
	 */
	protected function getMessageContent() {
		if($this->thumbMediaId == null){
			return "<Music>
					<Title><![CDATA[{$this->title}]]></Title>
					<Description><![CDATA[{$this->description}]]></Description>
					<MusicUrl><![CDATA[{$this->musicUrl}]]></MusicUrl>
					<HQMusicUrl><![CDATA[{$this->hQMusicUrl}]]></HQMusicUrl>
					</Music>";
		}
		return "<Music>
				<Title><![CDATA[{$this->title}]]></Title>
				<Description><![CDATA[{$this->description}]]></Description>
				<MusicUrl><![CDATA[{$this->musicUrl}]]></MusicUrl>
				<HQMusicUrl><![CDATA[{$this->hQMusicUrl}]]></HQMusicUrl>
				<ThumbMediaId><![CDATA[{$this->thumbMediaId}]]></ThumbMediaId>
				</Music>";
	}

}