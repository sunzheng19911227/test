<?php
$y_money = 70000;    //   最初的工资(年薪)

$f_money = 8000;     //   最初的房价
$f_size = 130;

$surplus_money_total = 0;    //  手上的钱

for($i=20;$i<50;$i++){
	$surplus = $y_money * 0.5 ;    //   每年剩余一半
	$surplus_money_total += $surplus;     //  所有剩余的钱
	//  如果每年剩余的钱做投资，
	$tozi = $surplus_money_total * 0.09;    //  每年的钱拿来投资,年化率9%
	$surplus_money_total += $tozi;
	$fangjia_total = $f_money * $f_size;    //  当时房子的价格
	$sf = $fangjia_total * 0.3 ;            //   当时房子的首付
	if($surplus_money_total >= $sf){
		echo '购房OK:';
	} else {
		echo '购房NO:';
	}
	echo ',年龄:'.$i.',年薪:'.$y_money.',月薪:'.($y_money/12).',手里剩余money:'.$surplus_money_total.',投资:'.$tozi.',房价:'.$f_money.',房子总价:'.$f_money * $f_size;
	echo "<br/>";
	if($surplus_money_total >= $sf)
		break;
	$y_money += ($y_money * 0.5);
	$f_money += ($f_money * 0.3);
}
?>