/*
	createAccount.js
	Rasheedd Okiji
*/

function validation()
{    
    //declare variable and initialized as necessary
    var firstname = $("first").value;
    var lastname = $("last").value;
    var email = $("email").value;
    var username = $("user").value;
    var password = $("pass").value;
    var repassword = $("repass").value;
    var street = $("street").value;
    var city = $("city").value;
    var zipcode = $("zipcode").value;
    var state = $("state").value;
    var userType = $("userType").checked;
    var artistBackground = $("artistBackground").value;
    
    
    var pattern1 = /^[A-z]+$/;     //pattern for first and last name
    var pattern2 = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;  //pattern for email
    var pattern3 = /^[A-z]+[0-9]*$/;      //pattern for username
    var pattern4 = /[A-z0-9]+/;           //pattern for password
    var pattern5 = /^[0-9]+\s[A-z]+/;     //pattern for street
    var pattern6 = /^[A-z]+\s*[A-z]*$/;            //pattern for city and state
    var pattern7 = /^[0-9]{5}$/;          //pattern for zipcode
    
    
    var result1 = pattern1.test(firstname);     //check first name
    var result2 = pattern1.test(lastname);     //check last name
    var result3 = pattern2.test(email);         //check for email
    var result4 = pattern3.test(username);      //check for username
    var result5 = pattern4.test(password);      //check for password
    var result6 = pattern4.test(repassword);    //matching password check
    var result7 = pattern5.test(street);        //check for street
    var result8 = pattern6.test(city);          //check for city
    var result9 = pattern7.test(zipcode);       //check for zipcode
    var result10 = pattern6.test(state);        //check for state
 
    
    //validating result for first name
    if(validate(result1, $("first").id, "First name") == false)
        {
            
            return false;
        }
    
    //validating result for last name
    if(validate(result2, $("last").id, "Last name") == false)
        {
            return false;
        }
    
    //validating result for email
    if(validate(result3, $("email").id, "email address") == false)
        {
            return false;
        }
    
    //validating result for user
    if(validate(result4, $("user").id, "username") == false)
        {
            return false;
        }
    else if(taken == true)
        {
            alert("username has been taken, please try again");
            $("user").style.backgroundColor= "red";
            $("user").select();
            return false;
        }
    $("user").style.backgroundColor= "white";
    
    //validating result for password
    if(validate(result5, $("pass").id, "password") == false)
        {
            return false;
        }else{
            if(validate(result6, $("repass").id, "repassword") == false)
            {
                return false;
            }else if(password != repassword) //confirm that both password are the same
            {
                alert("password not equal, please try again");
                $("repass").style.backgroundColor= "red";
                $("repass").select();
                
                return false;
            }
            $("repass").style.backgroundColor= "white"; //change color back to default color
            
        }
    
    //validating result for street
    if(validate(result7, $("street").id, "street") == false || street.length > 50)
        {
            if(street.length > 50)
                {
                    alert("input that you enter is greater that 50, please try again");
                    $("street").style.backgroundColor= "red";
                    $("street").select();
                    
                }
            return false;
        }
        $("street").style.backgroundColor= "white"; //change color back to default color
    
    //validating result for city
    if(validate(result8, $("city").id, "city") == false)
        {
            
            return false;
        }
    
    //validating result for zipcode
    if(validate(result9, $("zipcode").id, "zipcode") == false)
        {
            
            return false;
        }
    
    //validating result for state
    if(validate(result10, $("state").id, "state") == false)
        {
            
            return false;
        }
    
    //validating the user type
    if($("userType").checked == false && artistBackground == "")
        {
            alert("Please provide your background information");
            $("artistBackground").style.backgroundColor= "red";
            $("artistBackground").select();
            return false;
        }
    $("artistBackground").style.backgroundColor= "white";
    
    alert("all good");
    return true;
}


function validate(result, fieldValue, fieldName)
{
    var input = $(fieldValue).value;
    
    if(result == false)
        {
            if($(fieldValue).value == "")
                {
                    alert("You have note enter any input for "+fieldName+", Please try again");
                    $(fieldValue).style.backgroundColor= "red";
                    $(fieldValue).select();
                    return false;
                }
            alert("invalid "+fieldName);
            $(fieldValue).style.backgroundColor= "red";
            $(fieldValue).select();
            return false;
        }else if(input.length > 20 && fieldName != "street")    //checking the size of all inputs except street
            {
                alert("The input you entered is too long, please try again");
                $(fieldValue).style.backgroundColor= "red";
                $(fieldValue).select();
                return false;
            }
        else if(input.length > 50 && fieldName == "street") //checking the size of input for street
            {
                alert("The input you entered is too long, please try again");
                $(fieldValue).style.backgroundColor= "red";
                $(fieldValue).select();
                return false;
            }
    
    $(fieldValue).style.backgroundColor= "white";
    
    return true;
    
}

//function that change user type
function changeUser()
{
   //if x is false, the user is an artist
    var x = $("userType").checked;
    
    if(x == false)
        {
            $("artistA").style.display = "inline"; 
            $("customer").style.display = "none"; 
            $("artist").style.display = "inline";
        }else{
            $("customer").style.display = "inline"; 
            $("artist").style.display = "none";
            $("artistA").style.display = "none";
        }
}

//Ajax request for username validation
function validateUsername(incomingValue){
  new Ajax.Request( "avail.php", 
  { 
    method: "get", 
    parameters: {name:incomingValue},
    onSuccess: displayResult
  } );
}
//function to be executed when request is successful
function displayResult(ajax)
{
	var r = ajax.responseText;
	$('msgbox').innerHTML = r;
	if(r == 'taken'){
		$('msgbox').style.backgroundColor="red";
		$('msgbox').style.color="white";
		$('msgbox').focus();
        taken = true;
		
	}
	else{
		$('msgbox').style.backgroundColor="green";
		$('msgbox').style.color="white";
        taken = false;
	}
}