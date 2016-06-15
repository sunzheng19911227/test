<?php


	$url = 'http://www.niurenqushi.com/app/simsimi/ajax.aspx';
	$param['txt'] = '111';
	$result = http_post($url,$param);
	var_dump($result);
	
	function http_post($url,$param,$header = ''){
		$oCurl = curl_init();
		if (is_string($param)) {
			$strPOST = $param;
		} else {
			$aPOST = array();
			foreach($param as $key=>$val){
				$aPOST[] = $key."=".urlencode($val);
			}
			$strPOST =  join("&", $aPOST);
		}
        if($header != '')
            curl_setopt($oCurl, CURLOPT_HTTPHEADER, $header);
		curl_setopt($oCurl, CURLOPT_URL, $url);
		curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt($oCurl, CURLOPT_POST,true);
		curl_setopt($oCurl, CURLOPT_POSTFIELDS,$strPOST);
		$sContent = curl_exec($oCurl);
		$aStatus = curl_getinfo($oCurl);
        //$this->log->write('http_post , url:'.$url.', header:'.json_encode($header).', strPOST:'.$strPOST.', Status:'.$aStatus['http_code']);
		if(intval($aStatus["http_code"]) == 200){
			return $sContent;
		}else{
			return false;
		}
	}
?>