<?php
require_once  'util/util.php';
require_once 'message/response/AbstractBaseMessage.php';
require_once 'util/MessageUtil.php';
/**
 * 消息处理基类
 * @author Administrator
 *
 */
 abstract class AbstractMessageProcessor {
	protected $postObj;
	protected  $fromUsername;
	protected  $toUsername ;
	protected  $keyword ;
	protected  $msgType; //��Ϣ���� event,text;
	protected $time ;
	protected  $basePath = "http://ybhanxiao.eicp.net/wechatApp/";
	public function __construct($postObj){
		$this->postObj = $postObj;
        $this->parsePostObject();
        $this->time = time();
	}
	/**
	 * 解析post对象
	 * 需要解析其他对象，重写此方法
	 */
	protected function parsePostObject(){
		$this->fromUsername = $this->postObj->FromUserName;
        $this->toUsername = $this->postObj->ToUserName;
        $this->keyword = trim($this->postObj->Content);
        $this->msgType = $this->postObj->MsgType; //消息类型 event,text;
	}
	/**
	 * 回复消息
	 * @param $message
	 */
	abstract  public function sendMessage();

}
/**
 * 文本消息处理器
 * @author Administrator
 *
 */
class TextMessageProcessor extends AbstractMessageProcessor {
	/**
	 * @param unknown_type $message
	 */
	public function sendMessage() {
					if(!empty( $this->keyword ))
	                {	
                        if(strpos($this->keyword, "天气") !== false){
                            $ctity = str_replace("天气","",$this->keyword);
                            if(!empty($ctity)){
                            
                             	$message = getWeather($ctity);
		               			 MessageUtil::sendTextMessage($this->fromUsername, $this->toUsername,  $message);
                            
                            
                            }else {
                           		 $message = "请回复格式：\n 天气+地点,例如:天气成都 ";
               		  			MessageUtil::sendTextMessage($this->fromUsername, $this->toUsername,  $message);
                            }
                                
                        
                        }else if(strpos($this->keyword, "翻译") !== false){
                        
                         	$ctity = str_replace("翻译","",$this->keyword);
                            if(!empty($ctity)){
                            
                             	$message = tanslate($ctity);
		               			 MessageUtil::sendTextMessage($this->fromUsername, $this->toUsername, $message);
                            
                            
                            }else {
                           		 $message = "请回复格式：\n 翻译+要翻译的词 ";
               		  			 MessageUtil::sendTextMessage($this->fromUsername, $this->toUsername,  $message);
                            }
                        
                        }else if("1" == $this->keyword){
                        		 $message = "主菜单：\n 翻译：翻译+要翻译的词\n天气预报:天气+地点  \n 笑话:2 \n搞笑图片 3\n 主菜单:1";
               		  			 MessageUtil::sendTextMessage($this->fromUsername, $this->toUsername,  $message);
                        	
                        } else if("2" == $this->keyword){
                        		$message =getjoke();
               		  			 MessageUtil::sendTextMessage($this->fromUsername, $this->toUsername,  $message);
                        }else if("3" == $this->keyword){
                        	   sendJokeImage($this->fromUsername, $this->toUsername);
                        }else if("4" == $this->keyword){
                        		$mediaId = "n7HVI2spZKcafRBTErrgm-ptqdY_F5MzSueTLJch1TpeM8l07hITsoZlM5BuPfg7";//是记录在微信服务器中的id 不能是本地服务器的图片资源{$this->basePath}/res/images/erweima.jpg" ;
                        	    MessageUtil::sendImageMessage($this->fromUsername, $this->toUsername,  "n7HVI2spZKcafRBTErrgm-ptqdY_F5MzSueTLJch1TpeM8l07hITsoZlM5BuPfg7");
                        }else if("5" == $this->keyword){
                        		$title = "愿得一人心(剧场版)-李行亮,雨宗林";
                        		$description = ",愿得一人心(剧场版)在线试听,MP3免费下载,愿得一人心(剧场版)歌词下载_百度音乐-听到极致";
                        		$musicUrl="{$this->basePath}/res/music/父亲.mp3";
                        		$hQMusicUrl=$musicUrl;
                        		$thumbMediaId = "";
                        	    MessageUtil::sendMusicMessage($this->fromUsername,$this->toUsername,$title,$description,$musicUrl,$hQMusicUrl,null);
                        }else if("6" == $this->keyword){
               		  			 MessageUtil::sendTextMessage($this->fromUsername, $this->toUsername,  $this->fromUsername);
                        }else{
                         		$message = talk($this->keyword);
               		  			 MessageUtil::sendTextMessage($this->fromUsername, $this->toUsername, $message);
                        }
	                	
		           
	                }else{
		                 MessageUtil::sendTextMessage($this->fromUsername, $this->toUsername, "input some thing...");
	                }
	}

}
/**
 * Event类型消息处理器
 * @author Administrator
 *
 */
class EventMessageProcessor extends AbstractMessageProcessor {
	/**
	 * 
	 */
	public function sendMessage() {
	 				 $customEvent = $this->postObj->Event;//subscribe CLICK
               		  $eventKey = $this->postObj->EventKey ;//�¼���ť
               		  if($customEvent == "subscribe"){
		               	  	$picUlr = "{$this->basePath}/res/images/erweima.jpg" ;
					    	$url = "{$this->basePath}/res/images/erweima.jpg" ;
					    	$description = "你好，欢迎关注程序员.\n主菜单：\n翻译：翻译+要翻译的词\n天气预报:天气+地点 \n笑话:2\n搞笑图片: 3\n主菜单:1";
					    	$title = "欢迎关注程序员";
                 			MessageUtil::sendOneTextImageMessage($this->fromUsername, $this->toUsername,$title,$description, $picUlr,$url);
               		  }else if($customEvent == "CLICK") {
               		  	switch ($eventKey){
               		  		case "key_dpdz" : {
								$message="<a href ='http://api.map.baidu.com/geocoder?address=成都五块石客运站&output=html&src=hanfei|shuiguo'>我的位置</a>";
               		  			MessageUtil::sendTextMessage($this->fromUsername, $this->toUsername,  $message);
								break ;
               		  		}
               		  		case  "key_rxsg" : {
               		  			$picUlr = "http://mmbiz.qpic.cn/mmbiz/lp77EI7LTyp9C6bGT7zxlASgSGibIbTpRFwuruZFgnvDQlPIv7rAZ7ibAV6vCl6dgc1dgIMiaic3icbFcctvccMh0ibA/0" ;
						    	$url = "http://mp.weixin.qq.com/s?__biz=MzA4NjM5NDQyOQ==&mid=201608824&idx=1&sn=c96cab1d0fb61a174c617a02099651b9#rd" ;
						    	$description = "蓝莓营养价值 ①花青素：\n是一种非常重要的植物水溶性色素，属于纯天然的抗衰老营补充剂，是目前人类发现的最有效的抗氧化生物活性剂。②总酸和有机酸：具有广泛的生物学活性，特别在抗肿瘤等方面作用突出。";
						    	$title = "热销水果信息";
               	  				MessageUtil::sendOneTextImageMessage($this->fromUsername, $this->toUsername, $title,$description, $picUlr,$url);
               		  			break ;
               		  		}
               		  	}
               		  	
               		  }
	}

	
}
/**
 * 图片类型消息处理器
 * @author Administrator
 *
 */
class ImageMessageProcessor extends AbstractMessageProcessor{
	private $mediaId;
	protected function parsePostObject(){
		$this->mediaId = $this->postObj->MediaId;
		parent::parsePostObject();
	}
	/**
	 * 
	 */
	public function sendMessage() {
		$message = "你发送的是图片";
        MessageUtil::sendTextMessage($this->fromUsername, $this->toUsername, $message);
	}

	
}
/**
 * 声音类型消息处理器
 * @author Administrator
 *
 */
class VoiceMessageProcessor extends AbstractMessageProcessor{
	/**
	 * 
	 */
	public function sendMessage() {
		$message = "你发送的是声音";
       MessageUtil::sendTextMessage($this->fromUsername, $this->toUsername, $message);
	}

	
}
/**
 * 视频类型消息
 * @author Administrator
 *
 */
class VideoMessageProcessor extends AbstractMessageProcessor{
	/**
	 * 
	 */
	public function sendMessage() {
		$message = "你发送的视频";
        MessageUtil::sendTextMessage($this->fromUsername, $this->toUsername, $message);
	}

	
}
/**
 * 地理位置消息类型
 * @author Administrator
 *
 */
class LocationMessageProcessor extends AbstractMessageProcessor{
	/**
	 * 
	 */
	public function sendMessage() {
		$message = "你发送的地理位置";
        MessageUtil::sendTextMessage($this->fromUsername, $this->toUsername,  $message);
	}

	
}
/**
 * 连接类型消息
 * @author Administrator
 *
 */
class LinkMessageProcessor extends AbstractMessageProcessor{
	/**
	 * 
	 */
	public function sendMessage() {
		$message = "你发送的是连接";
        MessageUtil::sendTextMessage($this->fromUsername, $this->toUsername, $message);
	}

	
}
?>