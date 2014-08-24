<?php

$appid="wx1c43a6d93b1caef6";//填写appid
$secret="337609db44e50f87da7a81931e00aec7";//填写secret

$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$secret}";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$a = curl_exec($ch);


$strjson=json_decode($a);
$token = $strjson->access_token;
$post="{
     \"button\":[
     {	
          \"type\":\"click\",
          \"name\":\"当季水果\",
            \"sub_button\":[
            {
               \"type\":\"click\",
               \"name\":\"优惠信息\",
               \"key\":\"key_yhxx\"
            },
            {
               \"type\":\"click\",
               \"name\":\"热销水果\",
               \"key\":\"key_rxsg\"
            }
           
            ]
      },
      {	
          \"type\":\"click\",
          \"name\":\"店铺信息\",
           \"sub_button\":[
            {
               \"type\":\"click\",
               \"name\":\"店铺地址\",
               \"key\":\"key_dpdz\"
            },
            {
               \"type\":\"click\",
               \"name\":\"联系电话\",
               \"key\":\"key_lxdh\"
            }
            
            ]
      },
        
           {
           \"type\":\"click\",
           \"name\":\"生活帮手\",
           \"sub_button\":[
            {
               \"type\":\"click\",
               \"name\":\"天气查询\",
               \"key\":\"key_tqcx\"
            },
            {
               \"type\":\"click\",
               \"name\":\"百度翻译\",
               \"key\":\"key_bdfy\"
            },
            {
               \"type\":\"click\",
               \"name\":\"搞笑图片\",
               \"key\":\"key_gxtp\"
            },
            {
               \"type\":\"click\",
               \"name\":\"每日笑话\",
               \"key\":\"key_mrxh\"
            }]
       }]
 }";  //提交内容
$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token={$token}"; //查询地址 
$ch = curl_init();//新建curl
curl_setopt($ch, CURLOPT_URL, $url);//url  
curl_setopt($ch, CURLOPT_POST, 1);  //post
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);//post内容  
curl_exec($ch); //输出   
curl_close($ch); 

?>