<?php 
/**
*
* 2015/11/19
* 常炎隆
* porschegt23@foxmail.com
*
*/

header("Content-Type: text/html;charset=gbk");
//error_reporting(0);
$cookieVerify = dirname(__FILE__)."/zhihuVertify.tmp";
$cookieSuccess = dirname(__FILE__)."/zhihuSuccess.tmp";
define('USERNAME', '452017791@qq.com'); // 改为自己的用户名
define('PASSWORD', 'sunzheng1991'); // 改为自己的密码
define('_Zhihu_URL', 'http://www.zhihu.com/');
session_start();

/**********
_xsrf:8f677ad0d6da9a563a0331e8b7a527e7
password:
captcha:fzyd
remember_me:true
email:
***********/
$headers_login = array(
		'Accept'=> 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
        'Accept-Encoding'=> 'gzip, deflate, sdch',
        'Accept-Language'=> 'en-US,en;q=0.8,zh-CN;q=0.6,zh;q=0.4,zh-TW;q=0.2',
        'Connection'=> 'keep-alive',
        'Host'=> 'www.zhihu.com',
        'User-Agent'=> 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.130 Safari/537.36', 
        'Referer'=> 'http://www.zhihu.com/'
        ); 

if($_SESSION['go'] != 1){

	// 获取cookie并保存
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, _Zhihu_URL);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieVerify); // 存入cookie
	$rs = curl_exec($ch);
	curl_close($ch); 
 
	// 带上cookie抓取验证码，必须带上cookie，否则验证码不对应
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, _Zhihu_URL.'captcha.gif?r='.time());
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieVerify); // 带上cookie
	$rs = curl_exec($ch);
	// 把验证码在本地生成，二次拉取验证码可能无法通过验证
	@file_put_contents("zhihuVertify.jpg",$rs); // 读取rs到图片文件里面
	curl_close($ch); 
	// 手工验证码表单
	echo "<form action=\"\" method=\"post\"><input type=\"text\" name=\"vcode\"><img src=\"zhihuVertify.jpg\" /><br><input type=\"submit\" value=\"ok\"></form>";
	$_SESSION['go'] = 1;
}else{
	// 登录
	$ch = curl_init(); 
	$verify = $_POST["vcode"];
	$url = _Zhihu_URL.'login/email'; 
 
	// 返回结果存放在变量中，不输出 
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers_login); 
	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieVerify); // 带上cookie
	curl_setopt($ch, CURLOPT_HEADER, 1); 
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120); 
	curl_setopt($ch, CURLOPT_POST, true); 

	/****
	_xsrf:8f677ad0d6da9a563a0331e8b7a527e7
	password:
	captcha:fzyd
	remember_me:true
	email:
	****/
	$fields_post = array("password"=> PASSWORD, "email"=> USERNAME, "remember_me"=>'true', "captcha" => $verify ,"_xsrf"=>"8f677ad0d6da9a563a0331e8b7a527e7"); 
	$fields_string = ""; 
	foreach($fields_post as $key => $value){ 
		$fields_string .= $key . "=" . $value . "&"; 
	} 

	$fields_string = rtrim($fields_string , "&"); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers_login); 
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieSuccess); // 存入cookie
	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	var_dump(curl_getinfo($ch));
	$result = curl_exec($ch);
	printf_dump($result);
	curl_close($ch);

	$data = file_get_contents('https://www.zhihu.com/people/sun-zheng-46-81');
	var_Dump($data);
	
	//request('GET','https://www.zhihu.com/people/sun-zheng-46-81');
	$url = 'https://www.zhihu.com/people/sun-zheng-46-81';
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLOPT_COOKIE, $cookieSuccess);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers_login);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	var_dump(curl_getinfo($ch));
	$result = curl_exec($ch);
	var_Dump($result);exit;
	return $result;

	// echo $fields_string;
	session_destroy();
	// // 登录成功,查看success.tmp cookie文件有相应用户名等信息

	// echo _Zhihu_URL.'captcha.gif?r='.intval(time()*1000);
}

function printf_dump($v){
	echo "<pre>";
	echo ($v);
	echo "</pre>";
}

function request($method, $url, $fields = array())
{
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_COOKIE, $cookieSuccess);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	if ($method === 'POST')
	{
		curl_setopt($ch, CURLOPT_POST, true );
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	}
	$result = curl_exec($ch);
	var_Dump($result);exit;
	return $result;
}
?> 
