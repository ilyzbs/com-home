<?php
header("content-type:text/html;charset=utf-8");
$bigTagFile = fopen("bigTag20160620.txt", "w+");
$bigTagUrl = fopen("bigTagUrl20160620.txt", "w+");
//初始化状态
/*$k = 1;
$m = 1;
$bigTag = 1;
$littleTagNum = 50;
$littleHeightNum = '1';
$bigHeightNum = '2';
$tagSum = 120000;
$url = "http://www.jbh.xitong315.com/admin/g/s?st=b&p=";*/

/**待修改**/
//小标的起始数字
$k = 1;
//id的起始数字
$m = 1;
//大标的起始数字
$bigTag = 2;
//设置一个大标下小标的数量
$littleTagNum = 25;
//小标最高位数字
$littleHeightNum = '0';
//大标最高位数字
$bigHeightNum = '1';
//标签总数
$tagSum = 115400;
//url
$url = "http://jbh.xitong315.com/admin/g/s?st=b&p=";
/**:待修改**/
$changeNum = 0;
$index = 0;
$unknown = $littleTagNum-2; 
$outputBigTag;
//实例
/*$outputBigTag = "1,2000000001,10000000001,10000000050,50,".date("Y-m-d H:i:s")."\r\n";*/

//待修改
for($b = 0;$b < $tagSum;$b ++){

	$len = strlen($k);
	$ling = "";
	for($j = 0;$j < 10 - $len;$j++){
		$ling .= "0";
	}
	$m_proid = $littleHeightNum.$ling.$k++;
	
	if($changeNum == $littleTagNum){
		$changeNum = 0;
		$bigTagLen = strlen($bigTag);
		$ling = "";
		for ($j = 0;$j < 9 - $bigTagLen;$j ++){
			$ling .= "0";
		}$ling = $bigHeightNum.$ling;
		$bigTagCode = $ling . $bigTag++;
		//待修改
		$n = $k + $unknown;
		$len2 = strlen($n);
		$ling2 = "";
		for($l = 0;$l < 10 - $len2;$l++){
			$ling2 .= "0";
		}
		$m_proid2 = $littleHeightNum . $ling2 . $n++;
		$m_num = $n - $k + 1;
		$outputBigTag = ++$m.",".$bigTagCode.",".$m_proid.",".$m_proid2.",".$m_num.",".date("Y-m-d H:i:s")."\r\n";
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
