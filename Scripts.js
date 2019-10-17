function calculate()
{
	$("#contents").html("<img src='loader.gif'>");
	$.ajax({
		url: "calculations.php",
                type: "POST",
                data: {
					text: $("#textBox").val(),
                },
                success: function(response)
                {	
					$("#contents").html(response);
					$('#contents').show();
                }
	});
}
function calculate2()
{
	$("#contents").html("<img src='loader.gif'>");
	$.ajax({
		url: "calculations2.php",
                type: "POST",
                data: {
					text: $("#x").val(),
					text2: $("#y").val(),
					text3: $("#z").val(),
                },
                success: function(response)
                {	
					$("#contents").html(response);
					$('#contents').show();
                }
	});
}

function calculate3()
{
	$("#contents").html("<img src='loader.gif'>");
	var student = $('input[id=studentT]:checked').map(function()
	{
		return $("#studentT").val();
	}).get();
	$.ajax({
		url: "confidenceIntervalCalcs.php",
                type: "POST",
                data: {
					text: $("#CIEMean").val(),
					text2: $("#CIEStdDev").val(),
					text3: $("#CIESize").val(),
					text4: $("#CIEZ").val(),
					type: $("#Type").val(),
                },
                success: function(response)
                {	
					$("#contents").html(response);
					$('#contents').show();
                }
	});
}

function clearBox3()
{
	document.getElementById("CIEMean").value = '';
	document.getElementById("CIEStdDev").value = '';
	document.getElementById("CIESize").value = '';
}


function clearBox2()
{
	document.getElementById("x").value = '';
	document.getElementById("y").value = '';
	document.getElementById("z").value = '';
}

function clearBox()
{
	document.getElementById("textBox").value = '';
}

function keepOpen()
{
	return false;
}