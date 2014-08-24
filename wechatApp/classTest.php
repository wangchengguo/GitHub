<?php 
require 'message/response/AbstractBaseMessage.php';
//$arr = array("foo", "bar", "hallo", "world");
$art = new ArticleItem("a","v","c","d");
$arr = array($art,$art);
$message = new TextMessage("a","d","d");
echo $message->getMessage();
?>