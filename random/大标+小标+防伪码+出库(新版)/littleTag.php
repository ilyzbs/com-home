<?php 

$urlFile = fopen("xiaoURL1118.txt","w+");
$codeFile = fopen("code1118.txt","w+");
$xiaoTag = fopen("xiaoTag1118.txt","w+");
/**待修改**/
//url
$url = "http://jbh.xitong315.com/admin/g/s?st=m&p=";
//小标总数
$tagSum = 12745;
//小标最高位数字
$littleHeighNum = '0';
/**:待修改**/
$link="";
$len="";
$Str[2] = "01234567891234567890123456";

$generator = function() use ( $Str ) {
	$ret = '';
	for ( $i = 0; $i < 11; ++ $i )
		$ret .= $Str[2][mt_rand( 0, 25 )];
		//待修改 --防伪码最高位数字
		return '0'.$ret;
};

$buffer = array();
for ( $k = 0; $k < $tagSum; ++ $k ) {
	$current = $generator();
	if ( ! isset( $buffer[$current] ) )
		$buffer[$current] = 0;
	else -- $k;
}
$ret = array_keys($buffer);
for($j= 1;$j<=$tagSum;$j++){
	$len = strlen($j);
	for($l=0;$l<10-$len;$l++){
		$link .='0';
	}
	$num = $littleHeighNum.$link.$j;
	$outputCode = $num.",".$url.$num.",".$ret[$j-1]."\r\n";
	$output = $ret[$j-1]."\r\n";
	$aout = $num."\r\n";
	$f = fwrite($urlFile,$outputCode);
	$d = fwrite($codeFile, $output);
	$xiaoTagc = fwrite($xiaoTag, $aout);
	$link="";
}
echo '生成数量为'.$j.'条';
fclose($urlFile);
fclose($codeFile);
fclose($xiaoTag);

?>