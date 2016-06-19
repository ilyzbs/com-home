<?php
header("content-type:text/html;charset=utf-8");
$bigTagFile = fopen("bigTag20150714.txt", "w+");

$k = 1;
//待修改
$m = 1;
$index = 0;
$bigTag = 2;
//待修改
$littleTagNum = 20;
$changeNum = 0;
//待修改
$outputBigTag = "1,000000000001,A0000001,A0000020,20,".date("Y-m-d H:i:s")."\r\n";

//待修改
for($b = 0;$b < 100000;$b ++){

	$len = strlen($k);
	$ling = "";
	for($j = 0;$j < 7 - $len;$j++){
		$ling .= "0";
	}
	$m_proid = "A".$ling.$k++;
	
	if($changeNum == $littleTagNum){
		$changeNum = 0;
		$bigTagLen = strlen($bigTag);
		$ling = "";
		//待修改
		for ($j = 0;$j < 11 - $bigTagLen;$j ++){
			$ling .= "0";
		}$ling = '0'.$ling;
		$bigTagCode = $ling . $bigTag++;
		//待修改
		$n = $k + 18;
		$len2 = strlen($n);
		$ling2 = "";
		for($l = 0;$l < 7 - $len2;$l++){
			$ling2 .= "0";
		}
		$m_proid2 = "A" . $ling2 . $n++;
		$m_num = $n - $k + 1;
		$outputBigTag = ++ $m.",".$bigTagCode.",".$m_proid.",".$m_proid2.",".$m_num.",".date("Y-m-d H:i:s")."\r\n";
		$fstat3 = fwrite($bigTagFile, $outputBigTag);
	}
	$changeNum ++;
	$index ++;
}
echo "数据量：".$index;
echo "<br/>".$changeNum;
echo "<br/>done!";
fclose($bigTagFile);
