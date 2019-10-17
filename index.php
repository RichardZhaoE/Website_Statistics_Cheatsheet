
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="Scripts/Scripts.js"></script>
<title>Statistics Cheat Sheet</title>
</head>

<body>

Seperate Numbers with spaces or commas.<br />
Number Arrays with / or a new line.
<form name="textForm" id="textForm" onSubmit="return false;">
	<textarea cols="50" rows="5" id="textBox" name="textBox"/>4,4.5,5,5.5,6\n60,70,70,80,80</textarea>
    <br />
	<input type="submit" value="Clear Textbox" onclick="clearBox();"/>
	<input type="submit" value="Calculate" onclick="calculate();"/>
    
    <br /> <br /> <br />
    Binomial Distribution: P(X=<input id="x" type="text" size="5"/>, | n=<input id="y" type="text" size="5"/>,π=<input id="z" type="text" size="5"/>)
    <br />
    X: Number of Probability(Seperate by commas to add each) n: Sample Size /  | π: Probability of each
    <br />
	<input type="submit" value="Clear Values" onclick="clearBox2();"/>
	<input type="submit" value="Calculate" onclick="calculate2();"/>
    
    <br /> <br /> <br />
    Confidence Interval: X=<input id="CIEMean" type="text" size="5"/>, o =<input id="CIEStdDev" type="text" size="5"/>, n=<input id="CIESize" type="text" size="5"/>, Confidence Interval: <select id="CIEZ">
    <option value="1.28,80">80%</option>
    <option value="1.645,90">90%</option>
    <option value="1.96,95">95%</option>
    <option value="2.33,98">98%</option>
    <option value="2.58,99">99%</option>
    <option value="3.08,99.8">99.8%</option>
    <option value="3.27,99.9">99.9%</option></select>
    Type <select id="Type">
    <option value="Confidence">Confidence Interval</option>
    <option value="StudentT">Student T</option>
    <option value="PopPort">Population Proportion</option>
    <option value="SampSize">Determine Sample Size</option>
    <option value="SampProport">Determine Sample Size (Proportion)</option></select>
    <br />
    X: Mean / Sampling Error Range (±) | n: Sample Size | o: Standard Deviation (Not needed for population proportion)
    <br />
	<input type="submit" value="Clear Values" onclick="clearBox3();"/>
	<input type="submit" value="Calculate" onclick="calculate3();"/>
</form>

<div id="contents">
	<!--<script>calculate();</script>-->
</div>

<!-- <?php include("calculations.php"); ?> -->


</body>
</html>