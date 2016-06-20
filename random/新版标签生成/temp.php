<?php
header("content-type:text/html;charset=utf-8");
$tagFile = fopen("tagData.txt", "w+");
$codeFile = fopen("codeData.txt", "w+");
//小标的起始数字
$k = 1;
//id的起始数字
$m = 1;
//大标的起始数字
$bigTag = 1;
//设置一个大标下小标的数量
$littleTagNum = 25;
//小标最高位数字
$littleHeightNum = '0';
//大标最高位数字
$bigHeightNum = '1';
//大小标签总数
$tagSum = 120000;
//大标签总数
$bigTagSum = 4616;
//小标签总数
$littleTagSum = $tagSum-$bigTagSum;
//url
$bigTagurl = "http://jbh.xitong315.com/admin/g/s?st=b&p=";
$littleTagurl = "http://jbh.xitong315.com/admin/g/s?st=m&p=";
$Str[2] = "01234567891234567890123456";
$changeNum = 0;
$index = 0;
//防伪码
$generator = function() use ( $Str ) {
	$ret = '';
	for ( $ii = 0; $ii < 11; ++ $ii )
		$ret .= $Str[2][mt_rand( 0, 25 )];
		//待修改 --防伪码最高位数字
		return '0'.$ret;
};

$buffer = array();
for ( $kk = 0; $kk < $littleTagSum+16; ++ $kk ) {
	$current = $generator();
	if ( ! isset( $buffer[$current] ) )
		$buffer[$current] = 0;
	else -- $kk;
}
$ret = array_keys($buffer);

//大标
for($i = 1;$i<=$bigTagSum;$i++){
	$bigTagLen = strlen($bigTag);
	$ling = "";
	for ($j = 0;$j < 9 - $bigTagLen;$j ++){
		$ling .= "0";
	}
	$ling = $bigHeightNum.$ling;
	$bigTagCode = $ling . $bigTag++;
	//小标
	for($l = 0;$l<$littleTagNum;$l++){
		$len = strlen($k);
		$ling = "";
		for($j = 0;$j < 10 - $len;$j++){
			$ling .= "0";
		}
		$m_proid = $littleHeightNum.$ling.$k++;
		
		$outputUrl = $bigTagurl.$bigTagCode.','.$bigTagCode.','.$littleTagurl.$m_proid.','.$m_proid.','.$ret[$changeNum]."\r\n";
		$codeUrl = $ret[$changeNum]."\r\n";
		$fstat4 = fwrite($tagFile, $outputUrl);
		$result = fwrite($codeFile, $codeUrl);
		$changeNum++;
	}
	$index++;
}
$sum = $changeNum +$index;
echo "大标数据量：".$index;
echo "<br/>";
echo "小标数据量：".$changeNum;
echo "<br/>";
echo '总共'.$sum.'数据量';
fclose($tagFile);