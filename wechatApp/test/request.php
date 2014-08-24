<?php
require 'message/processor/messageProcessFactory.php';
$postStr ="<xml>
 <ToUserName><![CDATA[hafei]]></ToUserName>
 <FromUserName><![CDATA[zhangsan]]></FromUserName> 
 <CreateTime>1348831860</CreateTime>
 <MsgType><![CDATA[image]]></MsgType>
 <Content><![CDATA[3]]></Content>
 <MsgId>1234567890123456</MsgId>
 </xml>
 ";
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