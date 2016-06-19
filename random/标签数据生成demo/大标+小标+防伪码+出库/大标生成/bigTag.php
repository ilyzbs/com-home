<?php
header("content-type:text/html;charset=utf-8");
$bigTagFile = fopen("bigTag20151118.txt", "w+");
$bigTagUrl = fopen("bigTagUrl20151118.txt", "w+");

$k = 1;
//待修改
$m = 1;
$index = 0;
$bigTag = 2;
//待修改
$littleTagNum = 50;
$changeNum = 0;
//待修改
$outputBigTag = "1,2000000001,10000000001,10000000050,50,".date("Y-m-d H:i:s")."\r\n";
$url = "http://fw.szzao.com/fjm/index.php/Admin/G/s/?st=b&p=";

//待修改
for($b = 0;$b < 127450;$b ++){

	$len = strlen($k);
	$ling = "";
	//待修改
	for($j = 0;$j < 10 - $len;$j++){
		$ling .= "0";
	}
	$m_proid = "1".$ling.$k++;
	
	if($changeNum == $littleTagNum){
		$changeNum = 0;
		$bigTagLen = strlen($bigTag);
		$ling = "";
		//待修改
		for ($j = 0;$j < 9 - $bigTagLen;$j ++){
			$ling .= "0";
		}$ling = '2'.$ling;
		$bigTagCode = $ling . $bigTag++;
		//待修改
		$n = $k + 48;
		$len2 = strlen($n);
		$ling2 = "";
		for($l = 0;$l < 10 - $len2;$l++){
			$ling2 .= "0";
		}
		$m_proid2 = "1" . $ling2 . $n++;
		$m_num = $n - $k + 1;
		$outputBigTag = ++ $m.",".$bigTagCode.",".$m_proid.",".$m_proid2.",".$m_num.",".date("Y-m-d H:i:s")."\r\n";
		$outputBigTagUrl = $bigTagCode.",".$url.$bigTagCode."\r\n";
		$fstat3 = fwrite($bigTagFile, $outputBigTag);
		$fstat4 = fwrite($bigTagUrl, $outputBigTagUrl);
	}
	$changeNum ++;
	$index ++;
}
echo "数据量：".$index;
echo "<br/>".$changeNum;
echo "<br/>done!";
fclose($bigTagFile);
