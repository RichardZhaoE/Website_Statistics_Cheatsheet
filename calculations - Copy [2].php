<?php

//$text = "4,4.5,5,5.5,6\n60,70,70,80,80/7, 10, 13, 16, 19";
$text = $_POST['text'];
$samples = array();
$numbers = array();
$delimiter = array(",", " ");
$sampDelimiter = array('/','\r\n','\n\r','\n','\r');

$samples = multiExplode($sampDelimiter, $text);

foreach($samples as $index => &$num)
{
	$samples[$index] = multiExplode($delimiter, $samples[$index]);
	$samples[$index] = filterList($samples[$index]);
	$numbers = $samples[$index];
	
	echo "<div id='calculations'>";
	echo "<br><br>List #".($index + 1). "<br>Inputted List: ". echoSortedList($numbers).".</br>";
	sort($numbers);
	echo "Sorted List: ". echoSortedList($numbers).".</br>";
	echo "Mean: ". cMean($numbers).".</br>";
	echo "Mode: ". cMode($numbers).".</br>";
	echo "Median: ". cMedian($numbers).".</br>";
	echo "Range: ". cRange($numbers).".</br>";
	echo "<br>";
	echo "Sample Variance: S^2 = ". cSampleVariance($numbers).".</br>";
	echo "Sample Standard Deviation: S = ". cSampleStandardDeviation($numbers).".</br>";
	echo "Population Variance: S^2 = ". cPopulationVariance($numbers).".</br>";
	echo "Population Standard Deviation: S = ". cPopulationStandardDeviation($numbers).".</br>";
	echo "Coefficient of Variation: S / (Mean) = ". cCoefficientOfVariation($numbers)."%.</br>";
	echo "Quartile Ranges: ". cQuartileRanges($numbers). "<br>";
	echo "Z Scores: <br>";
	echo cZScores($numbers);
	echo "--------------------------------------------------";
	echo "</div>";
	

}

if(count($samples) > 1)
{
	echo "<br><img src='1.jpg' width='10%' height='10%'>     ||    <img src='2.jpg'  width='10%' height='10%'>";
	covarianceCombinations($samples);
}

function multiExplode($delimiters,$string) 
{
    return explode($delimiters[0],strtr($string,array_combine(array_slice($delimiters, 1), array_fill(0, count($delimiters)-1,array_shift($delimiters)))));
}

function filterList($array)
{
	foreach($array as $number => &$num)
	{
		if(!is_numeric($num))
			unset($array[$number]);
	}
	$array = array_values($array);
	return $array;
}


function echoSortedList($array)
{
	$string = "";
	for($i= 0; $i < count($array); $i++)
	{
		if($i < count($array) - 1)
			$string = $string.$array[$i].", "; 
		else
			$string = $string.$array[$i]; 
	}
	return $string;
}

function cMean($array)
{
	$total = 0;
	for($i= 0; $i < count($array); $i++)
	{
		$total = $array[$i] + $total;
	}
	return $total / count($array);
}

function cMode($array)
{
	$total = 0;
	$array = array_count_values($array); 
    arsort($array); 
    foreach($array as $num => $array){
		$total = $num; 
		break;
	} 
	return $total;
}

function cMedian($array)
{
	$middle = round(count($array) / 2); 
	$median = $array[$middle-1]; 
	return $median;
}

function cRange($array)
{
	$low = $array[0]; 
    rsort($array); 
    $high = $array[0]; 
	return $high - $low;
	
}

function cSampleVariance($array)
{
	$mean = cMean($array);
	$total = 0;
	for($i= 0; $i < count($array); $i++)
	{
		$total = $total + pow($array[$i] - $mean, 2);
	}
	$sVariance = $total/(count($array) - 1);
	return $sVariance;
	
}

function cSampleStandardDeviation($array)
{
	$sVariance = cSampleVariance($array);
	return sqrt($sVariance);
	
}

function cPopulationVariance($array)
{
	$mean = cMean($array);
	$total = 0;
	for($i= 0; $i < count($array); $i++)
	{
		$total = $total + pow($array[$i] - $mean, 2);
	}
	$pVariance = $total/ count($array);
	return $pVariance;
	
}

function cPopulationStandardDeviation($array)
{
	$pVariance = cPopulationVariance($array);
	return sqrt($pVariance);
	
}


function cCoefficientOfVariation($array)
{
	$mean = cMean($array);
	$sampDeviation = cSampleStandardDeviation($array);
	return $sampDeviation / $mean * 100;
}

function covarianceCombinations($array)
{
	for($i= 0; $i < count($array); $i++)
	{
		for($i2= 0; $i2 < count($array); $i2++)
		{
			//if($i != $i2 && $i2 > $i)
			//{
				$covariance = cCovariance($array[$i], $array[$i2]);
				echo "<br>Covariance(".($i+1).",".($i2+1)."): ". $covariance. "   ||    Coefficient Of Correlation: "
				.cCoefficientofCorrelation($covariance,$array[$i], $array[$i2]);
			//}
		}
	}
}


function cCovariance($array1, $array2)
{
	if(count($array1) == count($array2))
	{
		$total;
		$mean1 = cMean($array1);
		$mean2 = cMean($array2);
		for($i= 0; $i < count($array1); $i++)
		{
			$total = $total + (($array1[$i] - $mean1)*($array2[$i] - $mean2));
		}
		return $total / (count($array1) - 1);
	}else
	{
		return NULL;	
	}
	return NULL;
}


function cCoefficientofCorrelation($num, $array1, $array2)
{
	$s1 = cSampleStandardDeviation($array1);
	$s2 = cSampleStandardDeviation($array2);
	return $num / ($s1 * $s2);
}

function cQuartileRanges($array)
{
	$num = count($array);
	$qRange = ($num + 1) / 4;
	return "Q1(".$qRange.") Q2(". $qRange*2 .") Q3(".$qRange * 3 .")";	
}

function cZScores($array)
{
	$mean = cMean($array);
	$sDeviation = cSampleStandardDeviation($array);
	echo "<table border='1px' cellpadding='3px'><tr><td>Value</td>";
	foreach($array as $number => $num)
	{
		echo "<td>".$num."</td>";
	}
	echo "</tr><tr><td>Z Score</td>";
	foreach($array as $number => $num)
	{
		echo "<td>".($num - $mean) / $sDeviation."</td>";
	}
	echo "</tr></table>";
}

?>