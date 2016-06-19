<?php 

$urlFile = fopen("xiaoURL1118.txt","w+");
$codeFile = fopen("code1118.txt","w+");
$aa = fopen("aa1118.txt","w+");
$url = "http://fw.szzao.com/fjm/index.php/Admin/G/s/?st=m&p=";
$link="";
$len="";
$Str[2] = "01234567891234567890123456";

$generator = function() use ( $Str ) {
	$ret = '';
	for ( $i = 0; $i < 11; ++ $i )
		//待修改
		$ret .= $Str[2][mt_rand( 0, 25 )];
	return "1".$ret;
};

$buffer = array();
//待修改
for ( $k = 0; $k < 127450; ++ $k ) {
	$current = $generator();
	if ( ! isset( $buffer[$current] ) )
		$buffer[$current] = 0;
	else -- $k;
}
$ret = array_keys($buffer);
for($j= 1;$j<=127450;$j++){
	$len = strlen($j);
	for($l=0;$l<10-$len;$l++){
		$link .='0';
	}
	$num = '1'.$link.$j;
	$outputCode = $num.",".$url.$num.",".$ret[$j-1]."\r\n";
	$output = $ret[$j-1]."\r\n";
	$aout = $num."\r\n";
	$f = fwrite($urlFile,$outputCode);
	$d = fwrite($codeFile, $output);
	$aac = fwrite($aa, $aout);
	$link="";
}
echo '生成数量为'.$j.'条';
fclose($urlFile);
fclose($codeFile);
fclose($aa);

?>