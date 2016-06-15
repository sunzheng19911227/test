<?php
$a = '{"appeal_sign":"1","trade_state_name":"支付成功","trade_status":"2","trade_type":"9","trade_type_name":"C2C转账","trans_id":"1000000000201512301339643185","uid":"1119259677","user_type":"2"}'; 
$a = htmlspecialchars_decode($a);
echo $a;
$b = json_decode($a);
var_dump($b);
?>