function change(){
	
	var div = document.getElementById("cont");
	
	div.style.color="black";
	div.style.backgroundColor="lightblue";
}

function check()
{
	
	var valid=true;
	var error="";
	
	/*
	if(uname == ''){		
		error = error + "You did not put a tittle for your feedback. Example: Excellent, Good, poor..., \n";
		valid = false;
	}
	*/
	
	var comment = document.getElementById("comment").value;
	if(comment == ""){		
		alert("You did not put any feeback. Please write a feedback message");
		return false;
	}
	
	return true;
	
}
