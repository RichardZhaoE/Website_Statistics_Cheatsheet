<?php

//$text = "4,4.5,5,5.5,6\n60,70,70,80,80/7, 10, 13, 16, 19";
$x = $_POST['text'];
$y = $_POST['text2'];
$z = $_POST['text3'];


$delimiter = array(",", " ");
$possibilities = multiExplode($delimiter, $x);


if(count($possibilities) > 1)
{
	$answer = 0;
	foreach($possibilities as $num)
	{
		$answer = $answer + solve($num, $y, $z);	
	}
	echo "<br><br>Result: ";
	echo $answer;
	
}else{
	echo "<br><br>Result: ";
	echo solve($x, $y, $z);
	echo "<br>Mean: ";
	echo mean($y,$z);
	echo "<br>Variance: ";
	echo variance($y,$z);
	echo "<br>STD Deviation:";
	echo stdDev(variance($y,$z));
	
}


function solve($x, $y, $z)
{
	$facx = factorial($x);
	$facy = factorial($y);

	$part1 = $facy/($facx*factorial($y-$x));
	$part2 = power($z, $x);
	$part3 = power(1-$z,$y-$x);
	$ans = $part1*$part2*$part3;
	return $ans;
}


function multiExplode($delimiters,$string) 
{
    return explode($delimiters[0],strtr($string,array_combine(array_slice($delimiters, 1), array_fill(0, count($delimiters)-1,array_shift($delimiters)))));
}

function power($base, $exp)
{
	return pow($base, $exp);	
}


function factorial($num)
{
	if($num == 0)
		return 1;
	return $num * factorial($num - 1);
}


function mean($num, $num2)
{
	return $num * $num2;	
}


function variance($num, $num2) //s^2
{
	$mean = mean($num, $num2);
	$variance = $mean * (1 - $num2);
	return $variance;
}

function stdDev($variance) //s
{
	return sqrt($variance);	
}


?>