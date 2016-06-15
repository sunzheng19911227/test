<?php
$string = '-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCvTpZS7/AzQQgq3KG4re5py77d
ntPhzSNc0pQUNK37lm1X727r/K9yKK7n32oAENwQPbdJ89758pIxU8RJhGKDE6Cy
69QAG2EH+Dr8TAgkMIWmJe0scMQf6cwyMVeVUfeVOUe7IM2O4Tx7gmbjOYnfBdzI
ZaSIAehxgxlF4eJg9wIDAQAB
-----END PUBLIC KEY-----';
var_Dump(file_get_contents('public_key.pem'));
$publicKey = openssl_pkey_get_public(file_get_contents('public_key.pem'));
var_dump($publicKey);
//$securityKey = ('eB5KKkNK6OlSob4WDjPwT0vV5O9KXrbRdtwtElrrpNySUn3nLU9UjcrR8qV3XpgapV4nmsWWjQiu%0D%0ATg0u92nZUlTETOHIAuNBDx9UMqDyueBYxkpk2DOhp4BUjVUn8L4tW9zcYJjGgV%2BH%2F4hCqkrmTA16%0D%0ArjFfbE2wrxrxjfsol7k%3D%0D%0A');
$securityKey = $_REQUEST['securityKey'];
$securityParam = $_REQUEST['securityParam'];
var_dump($securityKey);
//$securityKey = urldecode('Ea2JI3Z1Cpc6gTKnaMzndrMGNymYotP8YSCCn0XGKgLl8GOys5QxwkV0Cv7KQVQHB7uEQmu9O%2B51%0D%0ARPRPMwhOwP3AVVnTVNyQSooOP0kTvzQgIjSD7InCbgvYVI%2BFl5DlAdxl05cwN6CvYM%2BXyvqVvJ2Q%0D%0APVnT4SfFmM1ArrtJYZw%3D%0D%0A');
//$publicKey ='MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCTLvcjNMZLNlRdItgwZLLdkcvsO9nnB9WDAfUhLpSB4ktmTRlGDXGp1+HaQzD5CDwrLB7iyijbHjMhNJp+kUMgF46lW2X41NFsP+P21/Ytayq89K6CwgWDj85VmEiW6jKkUQuaZtrifbme2YMWDnIjN7X4mvXUE1NZzHUNEWsVDQIDAQAB';
//$publicKey ='MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCvTpZS7/AzQQgq3KG4re5py77dntPhzSNc0pQUNK37lm1X727r/K9yKK7n32oAENwQPbdJ89758pIxU8RJhGKDE6Cy69QAG2EH+Dr8TAgkMIWmJe0scMQf6cwyMVeVUfeVOUe7IM2O4Tx7gmbjOYnfBdzIZaSIAehxgxlF4eJg9wIDAQAB';
//$publicKey = openssl_pkey_get_public(base64_decode($publicKey));
//var_dump($publicKey);
//exit;
openssl_public_decrypt(base64_decode($securityKey), $decryptData, $publicKey);
var_dump($decryptData);

$decrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $decryptData, base64_decode($securityParam), MCRYPT_MODE_ECB, $iv = '');
var_dump($decrypted);
$json = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $decrypted), true );
var_Dump($json);

//  public function decrypt($str){
//        //AES, 128 ECB模式加密数据
//        $screct_key = $this->_secrect_key;
//        $str = base64_decode($str);
//        $screct_key = base64_decode($screct_key);
//        $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128,MCRYPT_MODE_ECB),MCRYPT_RAND);
//        $encrypt_str =  mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $screct_key, $str, MCRYPT_MODE_ECB, $iv);
//        $encrypt_str = trim($encrypt_str);
//        $encrypt_str = $this->stripPKSC7Padding($encrypt_str);
//        return $encrypt_str;
//      
//    }

//$securityParam=$_REQUEST['securityParam'];
//$securityKey=$_REQUEST['securityKey'];
//$publicKey = openssl_pkey_get_public(file_get_contents('pem/publicKey.pem'));  
//if (openssl_public_decrypt(base64_decode($securityKey), $decryptData, $publicKey)) {  
//	$aes = new AES();
//	$aes->set_key($decryptData);
//	$aes->require_pkcs5();
//	$dec = json_decode($aes->decrypt($securityParam),true);
//	$this->bindUserInfo($dec['user']['mobilePhone'],'',4);
//} else {  
//	Yii::app()->end();
//}