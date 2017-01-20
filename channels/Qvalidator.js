function check(){
	var valid=true;
	var error="";
	
	var quote = document.getElementById("quote").value;
	var patQ = /^[0-9]+\.[0-9]{2}$/;
	var r1 = patQ.test(quote);
	if(quote == ''){		
		error = error + "quote field is empty\n";
		valid = false;
	}else if(r1 == false){
		error = error + "qoute is in incorrect format\n";
		valid = false;
	}
	
	var date = document.getElementById("date").value;
	var patD = /^[0-9]{2}\/([0-9]{2})\/[0-9]{4}$/;
	var r2 = patD.test(date);
	if(date == ''){		
		error = error + "date field is empty\n";
		valid = false;
	}else if(r2 == false){
		error = error + "date is in incorrect format\n";
		valid = false;
	}
	
	var time = document.getElementById("time").value;
	var patT = /^[0-2]|[1-9]:[0-5][0-9][AaPp][Mm]$/;
	var r3 = patT.test(time); 
	if(time == ''){		
		error = error + "timefield is empty\n";
		valid = false;
	}else if(r3 == false){
		error = error + "time is in correct format\n";
		valid = false;
	}
	
	if(valid == false){
		alert(error);
		return false;
	}else{
		return true;
	}
	
}

function qc(quote){
	
	new Ajax.Request("Qvalidator.php",
	{
		method: "get",
		parameters: {quote:quote},
		onSuccess: displayResultQ
		
	});	
}

function displayResultQ(ajax){
	
	var result = ajax.responseText;
	$('commentQ').innerHTML = result;
	
}

function dc(date){
	
	new Ajax.Request("Qvalidator.php",
	{
		method: "get",
		parameters: {date:date},
		onSuccess: displayResultD
		
	});	
}

function displayResultD(ajax){
	
	var result = ajax.responseText;
	$('commentD').innerHTML = result;
	
}


function tc(time){
	
	new Ajax.Request("Qvalidator.php",
	{
		method: "get",
		parameters: {time:time},
		onSuccess: displayResultT
		
	});	
}

function displayResultT(ajax){
	
	var result = ajax.responseText;
	$('commentT').innerHTML = result;
	
}













