<?php
	$cookie_file=tempnam('./temp','cookie');
	$ch = curl_init();
	$url1 = "http://i.youxinpai.com/auctionhall/listforeveryone.aspx";
	curl_setopt($ch,CURLOPT_URL,$url1);
	curl_setopt($ch,CURLOPT_HTTP_VERSION,CURL_HTTP_VERSION_1_1);
	curl_setopt($ch,CURLOPT_HEADER,0);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);
	curl_setopt($ch, CURLOPT_ENCODING ,'gzip'); //加入gzip解析
	//设置连接结束后保存cookie信息的文件
	curl_setopt($ch,CURLOPT_COOKIEJAR,$cookie_file);
	//$content=curl_exec($ch);
	 
	curl_close($ch);
	 
	$ch3 = curl_init();
	$url3 = "http://i.youxinpai.com/AjaxObjectPage/ListForEveryAuctionList.ashx";
	//http://i.youxinpai.com/auctionhall/listforeveryone.aspx
	$curlPost = array('list'=>'','t'=>2,'tvaid'=>0,'cid'=>0,'d'=>96);
		
	curl_setopt($ch3,CURLOPT_URL,$url3);
	curl_setopt($ch3,CURLOPT_POST,1);
	curl_setopt($ch3,CURLOPT_POSTFIELDS,$curlPost);
	 
	//设置连接结束后保存cookie信息的文件
	curl_setopt($ch3,CURLOPT_COOKIEFILE,$cookie_file); 
	curl_setopt($ch3,CURLOPT_RETURNTRANSFER,1);
	$content1 = curl_exec($ch3);
	curl_close($ch3);
	//echo $json;
	var_dump(json_decode($content1,true));
	die;
?>