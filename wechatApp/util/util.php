<?php
 
    /**
     * 天气获取
     * @param $keyword
     */
     function getWeather($keyword) {
        
    		 /**   xml实现
      			$weatherurl = "http://api.map.baidu.com/telematics/v3/weather?location={$keyword}&output=xml&ak=jX9xcNnXgkO2iq5IhGsqN5bg";
                $weatherStr = file_get_contents($weatherurl);
                $weatherXmlObj = simplexml_load_string($weatherStr);
              
                $place = $weatherXmlObj->results[0]->currentCity;//城市
                $today =$weatherXmlObj->results[0]->weather_data->date;
                $weather = $weatherXmlObj->results[0]->weather_data->weather;
                $wind = $weatherXmlObj->results[0]->weather_data->wind;
                $temperature = $weatherXmlObj->results[0]->weather_data->temperature;
                $contentStr = "{$place}{$today}天气:{$weather},风力:{$wind},温度:{$temperature}";
                return $contentStr ;
             */
				$weatherurl = "http://api.map.baidu.com/telematics/v3/weather?location={$keyword}&output=json&ak=jX9xcNnXgkO2iq5IhGsqN5bg";
        		
                $weatherStr = file_get_contents($weatherurl);
                $jobject = json_decode($weatherStr);
               // print_r($jobject);
                $weather_data =$jobject->results[0]->weather_data;
				$place = $jobject->results[0]->currentCity;//城市
				$contentStr = "{$place}:\n" ;
			    for ($i=0;$i<count($weather_data);$i++){
	                $today =$weather_data[$i]->date;
	                $weather = $weather_data[$i]->weather;
	                $wind =$weather_data[$i]->wind;
	                $temperature = $weather_data[$i]->temperature;
	                $dayPictureUrl = $weather_data[$i]->dayPictureUrl;
	                $nightPictureUrl = $weather_data[$i]->nightPictureUrl;
              	    $contentStr ="{$contentStr}". "{$today}天气:{$weather},风力:{$wind},温度:{$temperature}";
			    }
                return $contentStr ;
                
    }
    /**
     * 翻译
     * @param $words
     */
     function tanslate($words){
    
        $url = "http://openapi.baidu.com/public/2.0/bmt/translate?client_id=jX9xcNnXgkO2iq5IhGsqN5bg&q={$words}&from=auto&to=auto";
       $result  = file_get_contents($url);
        $jobject = json_decode($result,true);
//    	print_r($jobject);
		 $content =$jobject['trans_result'][0]['src'].":\n";
		for ($i=0;$i<count($jobject['trans_result']);$i++){
			$index =$i+1;
			$content="{$content}"."[{$index}] {$jobject['trans_result'][$i]['dst']}\n";
			echo "hah";
		}
		return  $content;
       // return "{$jobject['trans_result'][0]['src']}:\n{$jobject['trans_result'][0]['dst']}";
    }
    /**
     * 聊天机器人
     * @param $msg
     */
 	 function  talk($msg){
    	$url = "http://xjjapi.duapp.com/api/show.action?m=chat&msg={$msg}";
    	 $result  = file_get_contents($url);
    	 return $result ;
    }
    /**
     * 讲笑话
     */
     function getjoke(){
    
        $url = "http://xjjapi.duapp.com/api/show.action?m=joke";
        $result  = file_get_contents($url);
        $content="";
        if(!empty($result) and $result!="sorry，无此api"){
	        $jobject = json_decode($result,true);
        	$content = "【{$jobject['title']}】 {$jobject['contextText']}";
        }else {
        	$content= "从前有座山，山里有座庙，庙里有个你大爷！飞哥幽默么？";
        }
//        print_r($jobject);
//        echo $jobject->contextText;
        return $content;
    }
    /**
     * 获取百思不得姐搞笑图片
     * @param $keyword
     */
	function sendJokeImage($fromUsername, $toUsername) {
        	 $url = "http://xjjapi.duapp.com/api/show.action?m=image";
	        $result  = file_get_contents($url);
	        $jobject = json_decode($result,true);
	        $title = $jobject['context'];
	        $description = $jobject['type'];
	        $picUlr = $jobject['imgUrl'];
	        $url = $jobject['imgUrl'];
       		MessageUtil::sendOneTextImageMessage($fromUsername, $toUsername, $title,$description, $picUlr,$url);
                
    }