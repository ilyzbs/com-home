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
};

//待修改
$strbuffer =array();
for ( $i = 0; $i <100000; ++ $i ) {
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
for ( $i = 0; $i < 100000; ++ $i ) {
	$current = $generator();
	if ( ! isset( $buffer[$current] ) ){
		$buffer[$current] = 0;
	}else{
		-- $i;
	}
}
$ret = array_keys($buffer);

$urlFile = fopen("Url20150714.txt", "w+");
$codeFile = fopen("Code20150714.txt", "w+");
// $bigTagFile = fopen("bigTag20141020.txt", "w+");

$link = "http://fw.szzao.com/yl/?";
$batch = "A";
$index = 0;
$i = 1;
$k = 1;
$bigTag = 2;
//待修改
$littleTagNum = 20;
$changeNum = 0;
$m = 0;
$bigTagCode = "000000000001";
$ret_cout = count($ret);

for($b = 0;$b < $ret_cout;$b ++){
	$strA = substr($retstring[$b],0,3);
	$strB = substr($retstring[$b],3);
	
	if($i > 0){
		$len = strlen($k);
		$ling = "";
		for($j = 0;$j < 7 - $len;$j++){
			$ling .= "0";
		}
		//待修改
		$m_proid = "A".$ling.$k++;
	}else{
		$len = strlen($i);
		$ling = "";
		for($j = 0;$j < 7 - $len;$j++){
			$ling .= "0";
		}
		//待修改
		$m_proid = "A".$ling.$i++;
	}

	if($changeNum == $littleTagNum){
		$changeNum = 0;
		$bigTagLen = strlen($bigTag);
		$ling = "";
		
		//待修改
		for ($j = 0;$j < 11 - $bigTagLen;$j ++){
			$ling .= "0";
		}
		//待修改
		$bigTagCode = '0' . $ling.$bigTag++;
	}
	$changeNum ++;

	$outputCode = $m_proid.",".$batch.$strA.$ret[$b].$strB.",".date("Y-m-d H:i:s")."\r\n";
	//$outputUrl = $bigTagCode.",".$link.$batch.$strA.$ret[$b].$strB.",".$m_proid."|".$m_rand."\r\n";
	$outputUrl = $bigTagCode.",".$link.$batch.$strA.$ret[$b].$strB.",".$m_proid."\r\n";
	
	$fstat1 = fwrite($codeFile,$outputCode);
	$fstat2 = fwrite($urlFile,$outputUrl);
	
	$index++;
}

echo "数据量：".$index;
echo "<br/>".$changeNum;
echo "<br/>done!";
fclose($urlFile);