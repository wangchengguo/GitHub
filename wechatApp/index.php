<?php
/**
  * wechat php test
  */

//define your token
define("TOKEN", "weixin");
require 'message/processor/messageProcessFactory.php';
$wechatObj = new wechatCallbackapiTest();
$wechatObj->responseMsg();
//$wechatObj->valid();


class wechatCallbackapiTest
{
	public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
        	echo $echoStr;
        	exit;
        }
    }

    public function responseMsg()
    {
		//get post data, May be due to the different environments
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
      	//extract post data
		if (!empty($postStr)){
                
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                $keyword = trim($postObj->Content);
                
                $type = $postObj->MsgType; //��Ϣ���� event,text;
                $time = time();
//                $contentStr = "发送者：{$fromUsername}\n接收者:{$toUsername}\n 内容:{$keyword}\n MsgType:{$type}";
//                $this->sendTextMessage($fromUsername, $toUsername, $time, $contentStr);          
//                break;
				
                $messageProcessor = MessageProcessFactory::createMessageProcess($postObj);
                if($messageProcessor!=null){
                	$messageProcessor->sendMessage();
                }
			

        }else {
        	echo "";
        	exit;
        }
    }
   
	/**
	 * token��֤
	 */	
	private function checkSignature()
	{
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];	
        		
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
}

?>