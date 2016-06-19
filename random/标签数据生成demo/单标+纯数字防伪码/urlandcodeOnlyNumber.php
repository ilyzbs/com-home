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

$generator = function() use ( $Str ) {
	$ret = '';
	for ( $i = 0; $i < 11; ++ $i ) 
	//待修改
	$ret .= $Str[2][mt_rand( 0, 25 )];
	// 	$ret .= $letters[mt_rand( 0, 25 )];
	// echo $ret;die();
	return $ret;
};

$buffer = array();
//待修改
for ( $i = 0; $i < 100000; ++ $i ) {
	$current = $generator();
// 	echo "123===";var_dump($current);die();
	if ( ! isset( $buffer[$current] ) )
		$buffer[$current] = 0;
		else -- $i;
}
$ret = array_keys($buffer);

$urlFile = fopen("Url20151009.txt","w+");
$codeFile = fopen("Code20151009.txt","w+");

//待修改
$link = "http://fw2.carrian.net/?";
//待修改
$batch = "0";
$index = 1;
$i = 1;
$k = 1;
$ret_cout =count($ret);

for($b = 0;$b < $ret_cout;$b++){
	
/*	$len=strlen($k);
	$ling="";
	for($j = 0;$j < 7-$len;$j++){
		$ling.="0";
	}
	$m_proid = "D".$ling.$k++;*/
	
	if($i > 0){
		$len=strlen($k);
		$ling="";
		for($j = 0;$j < 7-$len;$j++){
			$ling.="0";
		}
		$m_proid = "0".$ling.$k++;
	}
	
	//彩色变动由1 2 3 4随机组合决定
	$m_rand = "";
	for ($m = 0;$m < 4;$m ++){
		$m_rand .= mt_rand(1, 4);
	}
	
	$outputCode = $m_proid.",".$batch.$ret[$b].",".date("Y-m-d H:i:s")."\r\n";
	$outputUrl = "http://fw.szzao.com/qms".",".$batch.$ret[$b]."\r\n";
	
	$fstat1 = fwrite($codeFile,$outputCode);
	$fstat2 = fwrite($urlFile,$outputUrl);
	
	$index++;
}

echo "数据量：".$index;
echo "<br/>done!";
fclose($urlFile);
fclose($codeFile);