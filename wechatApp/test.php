<?php
	echo bsbdqjImage("成都");
//    echo talk("你好啊");
    function getjoke(){
    
        $url = "http://xjjapi.duapp.com/api/show.action?m=joke";
        $result  = file_get_contents($url);
        $jobject = json_decode($result,true);
//        print_r($jobject);
//        echo $jobject->contextText;
        return "【{$jobject['title']}】 {$jobject['contextText']}";
    }
    
    function  talk($msg){
    	$url = "http://xjjapi.duapp.com/api/show.action?m=chat&msg={$msg}";
    	 $result  = file_get_contents($url);
    	 return $result ;
    }
    function ts($words){
     $url = "http://openapi.baidu.com/public/2.0/bmt/translate?client_id=jX9xcNnXgkO2iq5IhGsqN5bg&q={$words}&from=auto&to=auto";
        $result  = file_get_contents($url);
        $jobject = json_decode($result,true);
   		 $content =$jobject['trans_result'][0]['src'].":\n";
		for ($i=0;$i<count($jobject['trans_result']);$i++){
			$index =$i+1;
			$content="{$content}"."[{$index}] {$jobject['trans_result'][$i]['dst']}\n";
			echo "hah";
		}
		return  $content;
//        return "{$jobject['trans_result'][0]['src']}:\n{$jobject['trans_result'][0]['dst']}";
    }
    function getWeather($keyword) {
        
        		$weatherurl = "http://api.map.baidu.com/telematics/v3/weather?location={$keyword}&output=json&ak=jX9xcNnXgkO2iq5IhGsqN5bg";
        		
                $weatherStr = file_get_contents($weatherurl);
                $jobject = json_decode($weatherStr);
               // print_r($jobject);
                $weather_data =$jobject->results[0]->weather_data;
				$place = $jobject->results[0]->currentCity;//城市
				$contentStr = "" ;
			    for ($i=0;$i<count($weather_data);$i++){
	                $today =$weather_data[$i]->date;
	                $weather = $weather_data[$i]->weather;
	                $wind =$weather_data[$i]->wind;
	                $temperature = $weather_data[$i]->temperature;
              	    $contentStr ="{$contentStr}". "{$place}{$today}天气:{$weather},风力:{$wind},温度:{$temperature}";
			    }
                return $contentStr ;
                
    }
    function bsbdqjImage($keyword) {
        
        	 $url = "http://xjjapi.duapp.com/api/show.action?m=image";
	        $result  = file_get_contents($url);
	        $jobject = json_decode($result,true);
	        echo $jobject['context'];
	        echo $jobject['imgUrl'];
             return $contentStr ;
                
    }