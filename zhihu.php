<?php

$url = 'https://www.zhihu.com/people/sun-zheng-46-81/followees';
//$url = 'http://www.zhihu.com/people/sun-zheng-46-81/about';
$cookieSuccess = '_za=00bbed7b-8aa4-4e4e-b929-dfb767215323; udid="ADCAYS4LlQmPTv_X218h6m31MwCiYUMPBoA=|1457509416"; _zap=43992d0d-86c4-49ac-9b0c-9c28c0beb253; _ga=GA1.2.1638522027.1453707194; d_c0="AJAAQz4dpgmPTsTWSDHJH3LT7aw18Nf4Qk4=|1461200764"; q_c1=a1acbfbe21084816b7206a4b97adc2be|1463967910000|1448849395000; _xsrf=2f6c6a28eddedbaf445ce2940faf7cfc; login="Y2QwOGU4YmRmMjdiNDlhM2JjMjVkYjdlN2JkZjRiOGU=|1465713831|c0d58b476153cd83a60fa8d2a1836ff14c037906"; l_cap_id="YTc4NDU2N2RlZGQzNDA0Y2IxNmFlYjcxOGU5YWEwYzM=|1465713842|c77ebf103508114c3c5478df4ab1f92728140259"; cap_id="ZmU0YWZkMzQ3ZDdkNDMyODk5ZTE4OTA5NWZkMmJkMTk=|1465713842|c2eab4ec12c2298caff545b19c7b8128b790c724"; a_t="2.0AACA53VEAAAXAAAAt5GEVwAAgOd1RAAAAJAAQz4dpgkXAAAAYQJVTbeRhFcAHGe1gE5JM5X09sfC6-bkJEclLGu1WFy8WhU3A8thnFemj19frZ6SIw=="; z_c0=Mi4wQUFDQTUzVkVBQUFBa0FCRFBoMm1DUmNBQUFCaEFsVk50NUdFVndBY1o3V0FUa2t6bGZUMng4THI1dVFrUnlVc2F3|1465713847|6b6d7f5fbc13a12666f60ea0ebd8e48f79213521; n_c=1; __utmt=1; s-q=%E7%88%AC%E8%99%AB; s-i=1; sid=qs8msceg; s-t=autocomplete; __utma=51854390.1638522027.1453707194.1465713625.1465713844.3; __utmb=51854390.49.9.1465719333578; __utmc=51854390; __utmz=51854390.1465713844.3.3.utmcsr=google|utmccn=(organic)|utmcmd=organic|utmctr=(not%20provided); __utmv=51854390.100-1|2=registration_date=20141217=1^3=entry_date=20141217=1';

// $param = array(
//   'http'=>array(
//     'method'=>"GET",
//     'header'=>"Cookie: ".$cookieSuccess."\r\n"
//   )
// );

//echo file_get_contents($url,'false',stream_context_create($param));
//exit;

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_COOKIE, $cookieSuccess);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
$result = curl_exec($ch);
if (!$result) {
    print curl_errno($ch) .': '. curl_error($ch);
}
//echo $result;
//$ss = '<h2 class="zm-list-content-title"><a data-tip="p$t$wu-zi-yu-82" href="https://www.zhihu.com/people/wu-zi-yu" class="zg-link" title="吾自虞">吾自虞</a></h2>';
preg_match_all('/<a\s*.*href\s*=\s*"https:\/\/www.zhihu.com\/[a-zA-Z]+\/([\-a-zA-Z0-9]+)"\s*.*>.*<\/a>/',$result,$tt);
var_dump($tt);

?> 
