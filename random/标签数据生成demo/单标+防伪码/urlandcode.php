<?php
header("content-type:text/html;charset=utf-8");
set_time_limit(0);
ini_set("memory_limit","1000M");
// $letters = range( 'a', 'z' );
// echo "letters=";var_dump($letters);die();

//插入的干扰码的数量
// $insertLength = 5;
//从第几位开始截取
// $prefixLength = 3;
//生成的数据总数
// $dataNum = 100;
//有效密码的长度
// $CodeLength = 10;

$Str[0] = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$Str[1] = "abcdefghijklmnopqrstuvwxyz";
$Str[2] = "01234567891234567890123456";

//待修改
$addstring = function() use ( $Str ) {
	$retstring = '';
	for ( $i = 0; $i < 5; ++ $i ){
		$retstring .= $Str[mt_rand(0, 2)][mt_rand( 0, 25 )];
	}
	return $retstring;
};

//待修改
$strbuffer =array();
for ( $i = 0; $i <130000; ++ $i ) {
	$strcurrent = $addstring();
	if ( ! isset( $strbuffer[$strcurrent] ) ){
		$strbuffer[$strcurrent] = 0;
	}else {
		-- $i;
	}
}
$retstring = array_keys($strbuffer);
$retstr_cout = count($retstring);

$generator = function() use ( $Str ) {
	$ret = '';
	for ( $i = 0; $i < 12; ++ $i ) {
		$ret .= $Str[mt_rand(0, 2)][mt_rand( 0, 25 )];
	}
	return $ret;
};

//待修改
$buffer = array();
for ( $i = 0; $i < 130000; ++ $i ) {
	$current = $generator();
	if ( ! isset( $buffer[$current] ) ){
		$buffer[$current] = 0;
	}else{
		-- $i;
	}
}
$ret = array_keys($buffer);

$urlFile = fopen("Url20151026.txt", "w+");
$codeFile = fopen("Code20151026.txt", "w+");

$link = "http://fw.szzao.com/yzt/?";
//待修改
//随机数的起始位设置
$batch = "A";
$index = 0;
$i = 1;
//起始编号的最小数设置
$k = 1;
//大标最小数设置
$bigTag = 1;
$littleTagNum = 60;
$changeNum = 0;
$m = 0;
$bigTagCode = "200000000001";
$ret_cout = count($ret);

//取生成的随机数前前三位和和后两位
for($b = 0;$b < $ret_cout;$b ++){
	$strA = substr($retstring[$b],0,3);
	$strB = substr($retstring[$b],3);
	
	if($i > 0){
		//待修改
		//设置编号长度和起始数
		$len = strlen($k);
		$ling = "";
		for($j = 0;$j < 7 - $len;$j++){
			$ling .= "0";
		}
		$m_proid = "A".$ling.$k++;
		//待修改
		//设置编号长度和起始数
	}else{
		$len = strlen($i);
		$ling = "";
		for($j = 0;$j < 7 - $len;$j++){
			$ling .= "0";
		}
		$m_proid = "A".$ling.$i++;
	}

	if($changeNum == $littleTagNum){
		$changeNum = 0;
		$bigTagLen = strlen($bigTag);
		$ling = "";
		
		//待修改
		//设置大标的长度和起始数
		for ($j = 0;$j < 11 - $bigTagLen;$j ++){
			$ling .= "0";
		}
		//待修改
		$bigTagCode = '2' . $ling.$bigTag++;
	}
	$changeNum ++;
	//18位的随机数是这样生成的：取生成5位数的$retstring的前三位作为头，后2位作为尾，中间的12位随机数是从$ret中取
	//$strA得到随机数的前三位
	//$ret是随机生成的12位数的字符串
	//$strB是取$ret的后两位
	$outputCode = $m_proid.",".$batch.$strA.$ret[$b].$strB.",".date("Y-m-d H:i:s")."\r\n";
	$outputUrl = $m_proid.",".$link.$batch.$strA.$ret[$b].$strB."\r\n";
	
	$fstat1 = fwrite($codeFile,$outputCode);
	$fstat2 = fwrite($urlFile,$outputUrl);
	
	$index++;
}

echo "数据量：".$index;
echo "<br/>".$changeNum;
echo "<br/>done!";
fclose($urlFile);