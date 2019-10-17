<?php

//$text = "4,4.5,5,5.5,6\n60,70,70,80,80/7, 10, 13, 16, 19";
$x = $_POST['text'];
$o = $_POST['text2'];
$n = $_POST['text3'];
$z = $_POST['text4'];
$num = explode(",", $z);
$studentT = $_POST['type'];

echo "<br/><br/>";
$stdErr = calcStdErr($o, $n);
if($studentT ==  "StudentT") //Using Student T
{
	echo "Degrees of Freedom: " . ($n-1) . ". Upper Tail: " . (1 - $num[1]/100)/ 2 ." <br>";
	echo $x . " ± ( x )(" . $o . "/sqrt(" .$n . ")). <br/>";
	echo $x . " ± ( x )(".$stdErr.")";
}
else if($studentT == "Confidence")//Not using student T
{
	$stdErrZ = $stdErr*$num[0];
	$upper = $x + $stdErrZ;
	$lower = $x - $stdErrZ;

	echo $x . " ± " . $num[0] . "(" . $o ."/sqrt(" .$n . ")). <br/>";
	echo $lower ." <= m <= ". $upper;
}
else if($studentT == "PopPort")
{
	$proportion = $x / $n;
	$dev = calcPortDev($proportion, $n);
	$lower = $proportion - $num[0]*$dev;
	$upper = $proportion + $num[0]*$dev;
	echo $lower . "<= π <= ". $upper;
}
else if($studentT == "SampSize")
{
	$sampSize = power($o, 2)*power($num[0], 2);
	$sampSize = $sampSize / power($x, 2);
	echo $sampSize;
}
else if($studentT == "SampProport")
{
	$sampSize = power($num[0], 2);
	if($n == "")
		$n = .5;
	$sampSize = $sampSize * $n * (1-$n);
	$sampSize = $sampSize / power($x, 2);
	echo $sampSize;
}
else
{
	echo "Error";
}

function power($base, $exp)
{
	return pow($base, $exp);	
}
	
	
function calcPortDev($port, $size)
{
	return sqrt($port*(1-$port)/$size);	
}

function calcStdErr($x, $y)
{
	return $x/sqrt($y);	
}


?>