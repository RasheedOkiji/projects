function focusSearch() {
	if($('city') != undefined) {
		$('city').focus();
	}
	
	showResults();
}

function showHint(string) {	
	if (string.length==0) { 
		$('hint').hide();
		return;
	}
  
	new Ajax.Request( "searchHint.php", { 
		method: "get", 
		parameters: {city:string},
		onSuccess: ajaxSuccess
	});
}

function clearHint() {
	$('hint').fade();
}

function showResults() {
	var i = 450;
	$$("tr.search-row").each(function(element) {
		setInterval(function(){ element.appear(); }, i);
		i += 500; 
	});
}

//function to execute when ajax request is successful
function ajaxSuccess(ajax) {
	$("hint").innerHTML = ajax.responseText;
	
	$$("span.city").each(function(element) {
		element.observe("click", function(event) {
			$('city').value = element.innerHTML;
			element.style.color = '#dd80ff';
			//console.log(element.innerHTML);
		});
	});
	$('hint').appear();
}
//function to execute when ajax request is unsuccessful
function ajaxFailure() {
	alert("Ajax request failed.");
}

