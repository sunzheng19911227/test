<?php
//header ("Content-type: image/png");
$url = '1.jpg';
$text = '1111111111222222222333333333344444444444455555555556666666666666666666677777777777777777888888888888888';
$test = mb_convert_encoding($text, 'UTF-8', 'UTF-8');
//$text = "前段时间练习使库时，为了文本的自动换行纠结了很久。";
$text = autowrap(18, 0, "abc.ttf", $text, 330); // 自动换行处理
var_dump($text);
$bg = imagecreatefromjpeg($url);
$color = imagecolorallocatealpha($bg,150,150,150,0);
$x = 200;     //  初始
$y = 670;    
$y_add = 48;   //  每次递增
foreach($text as $t){
    imagettftext($bg, 18, 0, $x, $y, $color, "abc.ttf", $t);
    $x -= 90;
    $y += $y_add;
}
//imagejpeg($bg,'images/3.jpg');
//imagejpeg($bg);
//imagedestroy($bg);

function autowrap($fontsize, $angle, $fontface, $string, $width) {
	// 这几个变量分别是 字体大小, 角度, 字体名称, 字符串, 预设宽度
	$content = "";
	// 将字符串拆分成一个个单字 保存到数组 letter 
	for ($i=0;$i<mb_strlen($string);$i++) {
		$letter[] = mb_substr($string, $i, 1);
	}
    $str = array();
	foreach ($letter as $key=>$l) {
		$teststr = $content." ".$l;
		$testbox = imagettfbbox($fontsize, $angle, $fontface, $teststr);
		// 判断拼接后的字符串是否超过预设的宽度
		if (($testbox[2] > $width) && ($content !== "")) {
			$content .= "\n";
            $str[] = $content;
            $content = '';
		}elseif($key + 1 == count($letter)){
		      $str[] = $content;
		}
	    $content .= $l;
	}
    //echo $content;
	return $str;
}
?>