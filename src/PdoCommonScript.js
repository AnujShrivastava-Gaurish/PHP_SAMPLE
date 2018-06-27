/* test*/
$(function()
{
	var valid="";
	/*
		It execute when focus is remove on each input field which has input class also on keyPress.
	*/
	$('.input').on({
		blur:function()
		{
			$.checkEmptyField($(this));
			$.checkInputLength($(this));
			$.checkDate($(this));
			$.checkConfirmPassword($(this));
		},
		keypress:function(event)
		{
			return $.checkKeyValidation($(this),event);
		}
	});
	$('#add').blur(function(){$.checkEmptyField($(this));$.checkInputLength($(this));});
	$('.checkBox').click(function(){$.checkRadioCheck($(this))});
	$('.radio').click(function(){$.checkRadioCheck($(this))});
	$('#city').on({
		blur:function()
		{
			$.checkCity($(this));
		},
		change:function()
		{
			$.checkCity($(this));
		}
	});
	
	//This will be execute when click on START ALL OVER button.
	$('#Reset').click($.allClean);
	
	$('.submit').click(function(){
		
		// This will exicute when button value is "CLICK TO SUBMIT"
		if($(this).val()=="CLICK TO SUBMIT")
		{
			$('form').submit(function(){
				if(($.checkEmptyField($('#fname')) & $.checkEmptyField($('#lname')) & 
					$.checkEmptyField($('#date')) & $.checkEmptyField($('#pass')) & 
					$.checkEmptyField($('#cpass')) & $.checkEmptyField($('#add')) &
					$.checkCity($('#city')) & $.checkInputLength($('#fname')) & 
					$.checkInputLength($('#lname')) & $.checkInputLength($('#pass')) & 
					$.checkInputLength($('#add')) & $.checkDate($('#date')) & 
					$.checkRadioCheck($('.checkBox')) &	$.checkRadioCheck($('.radio')) & 
					$.checkCity($('#city')) & $.checkConfirmPassword($('#cpass')) & 
					$.checkEmptyField($('#email')) && $.checkEmailId($('#email')) &&
					 $.checkExistEmail($('#email'),'submit')			
					))
				{
					return true;
				}
				else
				{
					return false;
				}
			});
		}
		// This will exicute when button value is "SAVE TO CHANGE"
		if($(this).val()=="SAVE TO CHANGE")
		{
			$('form').submit(function(){
				if(($.checkEmptyField($('#fname')) & $.checkEmptyField($('#lname')) & 
					$.checkEmptyField($('#date')) & $.checkEmptyField($('#pass')) & 
					$.checkEmptyField($('#cpass')) & $.checkEmptyField($('#add')) &
					$.checkCity($('#city')) & $.checkInputLength($('#fname')) & 
					$.checkInputLength($('#lname')) & $.checkInputLength($('#pass')) & 
					$.checkInputLength($('#add')) & $.checkDate($('#date')) & 
					$.checkRadioCheck($('.checkBox')) &	$.checkRadioCheck($('.radio')) & 
					$.checkCity($('#city')) & $.checkConfirmPassword($('#cpass')) & 
					$.checkEmptyField($('#uemail')) && $.checkEmailId($('#uemail')) &&
					 $.checkExistEmail($('#uemail'),'update')			
					))
				{
					return true;
				}
				else
				{
					return false;
				}
			});
		}
		
	});
	
	//This event occur no blur event
	$('#email, #uemail').blur(function()
	{
		//This will execute when a instance is $('#email') 
		if($(this).is($('#email')))
		{
			if($.checkEmptyField($(this)) && $.checkEmailId($(this)))
			{
				/*
					This function execute when $(this) is $('#email') button= submit
				*/
				$.checkExistEmail($(this),'submit');
			}
		}
		
		//This will execute when a instance is $('#uemail') 
		if($(this).is($('#uemail')))
		{
			if($.checkEmptyField($(this)) && $.checkEmailId($(this)))
			{
				/*
					This function execute when $(this) is $('#uemail') button= update
				*/
				$.checkExistEmail($(this),'update');
			}
			
		}
		
	});
	
	/*
		This will execute when delete button is click.
	*/
	$('.delete').click(function()
	{
		var result = confirm("Want to delete?");
		if(result)
		{
			var email=$.trim($(this).parent().parent().children().filter(".email").text());
			var e=email.toString();
			var data = 'email='+ e +'&click='+ $(this).val();
			var o=$.ajax({
						url:"PdoCheck.php",
						method:"POST",
						data: 'email='+ e +'&click='+ $(this).val(),
						async:false,
						success: function(data){},
			});
			console.log(o);
			if(o.responseText=="true")
			{
				$(this).parent().parent().remove();
			}
			else
			{
				alert("CAN'T DELETE");
			}
		}
					
	});
	
});

/*
	$.checkEmptyField(input) is used to check whether all input field is empty or not.
	
*/

$.checkEmptyField=function(input)
{
	if(input.is($('#add')))
	{
		if($('#add').val()=='')
		{
			input.addClass("errorBorder");
			input.parent().next().children().text("THIS FIELD IS REQUIRED");
			return false;
		}
		else
		{
			input.removeClass("errorBorder");
			input.parent().next().children().text("");
			return true;
		}
	}
	else
	{
		var Value=input.val().trim();
		if(Value=='')
		{
			input.addClass("errorBorder");
			input.parent().next().children().text("THIS FIELD IS REQUIRED");
			return false;
		}
		else
		{
			input.removeClass("errorBorder");
			input.parent().next().children().text("");
			return true;
		}
	}
}

/*	
	$.checkKeyValidation(input) is check the enter a key is valid or not on keyPress event.
	This check date field, password field, email field, first and last name field.
 */
$.checkKeyValidation=function(input,event)
{
	//This logic for first and last name field.
	if(input.is($('#fname')) || input.is($('#lname')))
	{
		var charCode = (event.which) ? event.which : event.keyCode;
		
		/*	(97 to 122 is - 'A' to 'Z')(65 to 90 is - 'a' to 'z') (32 is - "Space") (8 is - "Backspace") 
			(9 is - "Tab") (37 is -> Left arrow key) (39 is -> right arrow key)
		*/
			
		if((charCode >= 97 && charCode <=122) || (charCode >= 65 && charCode <=90) || (charCode ==32) || (charCode ==8) || (charCode==9) || (charCode==37) || (charCode==39))
		{
			return true;
		}
		return false;
	}
	
	//This logic for email, password, confirm, password, and address field.
	else
		if(input.is($('#email')) || input.is($('#pass')) || input.is('#cpass') || input.is($('#add')))
		{
			var charCode = (event.which) ? event.which : event.keyCode;
				
			/*	It allow (alphabet, special character number etc.
				(48 - 57 is -> (0 - 9)) (97 to 122 is - 'A' to 'Z')(65 to 90 is - 'a' to 'z')(64 is -> @)
				(92 - 95 is-> (\ ] ^ _ )) (35 - 39 is-> (# $ % & ')) (33 is -> !) (46 is -> dot(.))
				(8 is -> Backspace) (9 is -> Tab)
			*/

			if ((charCode >= 48 && charCode <=57) || (charCode >= 97 && charCode <=122) || (charCode >= 64 && charCode <=90) || (charCode ==95 || (charCode >=35 && charCode <=39) || charCode==33 || charCode==46 ) || charCode==8 || charCode==9)
			{
				return true;
			}
			return false;
		}
		
		//This logic for date field.
		else
		{
			var charCode = (event.which) ? event.which : event.keyCode;
				
			//	It not allow (alphabet, special character (@ # $ % ^ & *) etc.)

			if (charCode != 45 && charCode != 189 && charCode > 31
				&& (charCode < 48 || charCode > 57))
			{
				return false;
			}
			return true;
		}
}

/*	
	$.checkInputLength(input) is used  to check the length of input in first name, last name,
	password, address input field.
*/

$.checkInputLength=function(input)
{
	//This logic check the length of first and last name input.
	if((input.is($('#fname')) || input.is($('#lname'))) && (input.val()!='') )
	{
		var Value=input.val();
		if(Value.length>45)
		{
			input.addClass("errorBorder");
			input.parent().next().children().text("CHARECTER LENGTH MAXIMUM 45 CHARECTER");
			return false;
		}
		else
		{
			input.removeClass("errorBorder");
			input.parent().next().children().text("");
			return true;
		}
	}
	//This logic check the length of address input.
	else
		if((input.is($('#add'))) && (input.val()!=''))
		{
			var Value=input.val().length;
			if(Value<10)
			{
				$('#add').addClass("errorBorder");
				$('#add').parent().next().children().text("CHARACTER LENGTH MINIMUM 10 CHARACTER");
				return false;
			}
			else
			{
				input.removeClass("errorBorder");
				input.parent().next().children().text("");
				return true;
			}
		}
	//This logic check the length of password input.
	else
		if((input.is($('#pass'))) && (input.val()!=''))
		{
			var Value=input.val();
			if(Value.length>10)
			{
				input.removeClass("errorBorder");
				input.parent().next().children().text("");
				return true;
			}
			else
			{
				input.addClass("errorBorder");
				input.parent().next().children().text("PASSWORD LENGTH MINIMUM 10 CHARECTER");
				return false;
				
			}
		}
}

/*	
	$.checkEmailId(input) is used to check whether the email id is correct or not.
*/
$.checkEmailId=function(emailId)
{
	if((emailId.is($('#email')) || emailId.is($('#uemail'))) && (emailId.val()!=''))
	{
		var Value=emailId.val().trim();
		//this logic take @ must important.
		if (Value.indexOf('@') == -1)
		{
			emailId.addClass("errorBorder");
			emailId.parent().next().children().text("INVALID EMAIL ID");
			return false;
		} 
		else 
		{
			var parts = Value.split('@');
			var domain = parts[1];
			// After @ (.) is must important.
			if (domain.indexOf('.') == -1) 
			{
				emailId.addClass("errorBorder");
				emailId.parent().next().children().text("INVALID EMAIL ID");
				return false;
			}
			else
			{
				var domainParts = domain.split('.');
				var ext = domainParts[1];
				if (ext.length > 4 || ext.length < 2) 
				{
					emailId.addClass("errorBorder");
					emailId.parent().next().children().text("INVALID EMAIL ID");
					return false;
				}
			}
		}
		emailId.removeClass("errorBorder");
		emailId.parent().next().children().text("");
		return true;
	}
}

/*	
	$.checkDate(input) is used to check whether the given date input is correct or not.
*/
$.checkDate=function(input)
{
	if((input.is($('#date'))==true) && (input.val()!=''))
	{
		var date=input.val().split("-");
		if(date[0]>=1000)
		{
			if(((date[2]>=01 && date[2]<=30)&&(date[1]==04 || date[1]==06 || date[1]==09 || date[1]==11)) || ((date[2]>=01 && date[2]<=31)&&(date[1]==01 || date[1]==03 || date[1]==05 || date[1]==07 ||date[1]==08 || date[1]==10||date[1]==12)) || (((date[2]>=01 && date[2]<=28) && date[1]==02) && ((date[0]%4!=0) || (date[0]%4==0))) || ((date[2]==29 && date[1]==02) && (date[0]%4==0) ) )
			{
				input.removeClass("errorBorder");
				input.parent().next().children().text("");
				return true;
			}
			else
			{
				input.addClass("errorBorder");
				input.parent().next().children().text("INVALID DATE");
				return false;
			}
		}
		else
		{
			input.addClass("errorBorder");
			input.parent().next().children().text("INVALID DATE");
			return false;
		}
	}
}


/*	
	$.checkRadioCheck(input) is used to check whether at least one hobby is check and
	Gender is also select.
*/
$.checkRadioCheck=function(input)
{
	//This logic is for checkBox.
	if(input.is($('.checkBox')))
	{
		var count=$('.checkBox').filter(':checked').length;
		if(count>=1)
		{
			input.parent().parent().next().children().text("");
			return true;
		}
		else
		{
			input.parent().parent().next().children().text("CHOOSE ATLEAST ONE"); 
			return false;
		}
	}
	//This logic is for Radio button.
	else
		if(input.is($('.radio')))
		{
			var count=$('.radio').filter(':checked').length;
			if(count==1)
			{
				input.parent().parent().next().children().text("");
				return true;
			}
			else
			{
				$(".radio").parent().parent().next().children().text("CHOOSE GENDER");
				return false;
			}
		}
}

/*	
	checkConfirmPassword(input) is used to check whether the password and confirm 
	password is matched or not.
*/
	$.checkConfirmPassword=function (input)
	{
		if(($('#cpass').val()!='') && (input.is(($('#cpass')))))
		{
			if(($('#cpass').val()==$('#pass').val()))
			{
				$('#cpass').removeClass("errorBorder");
				$('#cpass').parent().next().children().text("");
				return true;
			}
			else
			{
				$('#cpass').addClass("errorBorder");
				$('#cpass').parent().next().children().text("PASSWORD DOES NOT MATCH");
				return false;
			}
		}
	}
	
/*	
	$.checkCity(input) is used to check whether any city select or not on click and change event.
*/
$.checkCity=function(input)
{
	if(input.is($('#city')))
	{
		if(input.val()=="--SELECT--")
		{
			$('#city').addClass("errorBorder");
			$('#city').parent().next().children().text("CHOOSE CITY");
			return false;
		}
		else
		{
			input.removeClass("errorBorder");
			input.parent().next().children().text("");
			return true;
		}
	}
}
	
/*	
	$.allClean() is used to clear all the field.
*/	
$.allClean=function ()
{
	$('.error').each(function()
	{
		$(this).text("");
	});
	$('.removeBorder').each(function()
	{
		$(this).removeClass("errorBorder");
	});
}	

/*
	$.checkExistEmail(input,Button) is used to check whether the email is exist in database or not.
*/
$.checkExistEmail=function(input,Button)
{
	//var email=null;
	
	//This will execute when input is $('#email') and Button=="submit"
	
	if(input.is($('#email')) && Button=="submit")
	{
			var submitForm=$.ajax({
						url:"check.php",
						method:"POST",
						data: "email="+input.val()+"&Blur=sblur",
						async: false,     //this is off the Asynchronization 
						beforeSend: function(){
							$('#email').parent().next().children().text("LOADING.........");
						},
						success: function(response)
						{
							if(response=="true")
							{
								input.addClass("errorBorder");
								input.parent().next().children().text("ALREADY EXIST");
							}
							else
							{
								input.removeClass("errorBorder");
								input.parent().next().children().text("");
							}
						},
			});
			if(submitForm.responseText=="true")
			{
				return false;
			}
			else
			{
				return true;
				 
			}
	}
	
	//This will execute when input is $('#uemail') and Button=="update"
	else 
		if(input.is($('#uemail')) && Button=="update")
		{
			//var email1= input.val();
			//var id=$('#id').val();	
			var update=$.ajax({
						url:"PdoCheck.php",
						method:"POST",
						data: "email="+input.val()+"&Blur=ublur"+"&id="+$('#id').val(),
						async: false,     //this is off the Asynchronization 
						beforeSend: function(){
							$('#uemail').parent().next().children().text("LOADING.........");
						},
						success: function(response)
						{
							if(response=="true")
							{
								input.addClass("errorBorder");
								input.parent().next().children().text("ALREADY EXIST");
							}
							else
							{
								input.removeClass("errorBorder");
								input.parent().next().children().text("");
							}
						},
			});
			if(update.responseText=="true")
			{
				return false;
			}
			else
			{
				return true;
			}
		}
}



