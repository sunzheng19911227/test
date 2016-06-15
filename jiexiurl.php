<?php
 $str = "https://vgw.baofoo.com/payindex?MemberID=100000178&TerminalID=10000001&InterfaceVersion=4.0&KeyType=1&PayID=3001&TradeDate=20160603151144&TransID=PAYDEV20160603000070&OrderMoney=1000000.00&ProductName=利投宝03&Amount=1&Username=gfghg&AdditionalInfo=null&PageUrl=http://10.150.20.146/&ReturnUrl=http://114.251.170.232:8081/Pay/app/pay/fresh/GatewayPay/gatewayPayBaoFuResult.do&Signature=ec52b199193380929eb9b49e816deba5&NoticeType=1";
$parse = parse_url($str);
var_dump($parse);
parse_str($parse['query'],$pass);
var_Dump($pass);
// 获取?号全部
$key = strpos($str, '?');
var_Dump($key);
$header_url = substr($str, 0, $key);
var_dump($header_url);
$pass['Url'] = $header_url;
var_Dump($pass);
?>