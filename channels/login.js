function validatePassword()
{
	var username = $("username").value;
    var password = $("password").value;
    
  new Ajax.Request( "verifyLogin.php", 
  { 
    method: "get", 
    parameters: {uname:username, pass:password},
    onSuccess: function(ajax) {
		return checkPassword(ajax);
	},
	onFailure: function(ajax) {
		
		return false;
	}
  } );
}

function checkPassword(ajax)
{
    var r = ajax.responseText;
	console.log(r);

    if(r == 'valid')
        {
			$('username').style.backgroundColor="white";
			$('password').style.backgroundColor="white";

			return true;
        } else{
			$('username').style.backgroundColor="red";
			$('username').style.color="white";
			$('username').focus();
			
			$('password').style.backgroundColor="red";
			$('password').style.color="white";
			
			alert("invalid username or password");
        
			return false;
        }
}
