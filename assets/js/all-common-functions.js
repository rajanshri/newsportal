// checks that an input string looks like a valid email address.
var isEmail_re       = /^\s*[\w\-\+_]+(\.[\w\-\+_]+)*\@[\w\-\+_]+\.[\w\-\+_]+(\.[\w\-\+_]+)*\s*$/;

function isEmail(s){
   return String(s).search (isEmail_re) != -1;
}

function checkEmailAvailability(user_email){	
	var email_availability = false;
    if(user_email !=''){
		$.ajax({
		  url: base_url+"ajax-check-email-avilability",
		  type: "POST",
		  data: "user_email="+user_email,
		  dataType: "json",
		  async:false,
		  success: function(resp){
				 if(resp.ErrorCode == 0){
					  email_availability = true;
				 }
		  }
		});		
    }
	
	return email_availability;
}

function signupValidation(){
	$('#succ_message_container').html('').hide();
	$('#err_message_container').html('').hide();
		
	var message_txt = '';
	
	var user_name = $.trim($('#user_name').val());
	var user_email = $.trim($('#user_email').val());
	
	if(user_name == ''){
		message_txt = 'The Full Name field is required.';
	}else if(user_email == ''){
		message_txt = 'The Email field is required.';
	}else if(user_email != '' && isEmail(user_email) == false){
		message_txt = 'The Email field must contain a valid email address.';
	}else if(user_email != '' && checkEmailAvailability(user_email) == false){
		message_txt = 'This email id is already exist in our site. Please login.';
	}else{
		return true;
	}
	
	if(message_txt!=""){		
		$('#succ_message_container').animate({height: 'hide', width: 'hide', opacity: 'hide'}, 300);
		$('#err_message_container').animate({height: 'show', width: 'show', opacity: 'show'}, 300);
		$('#err_message_container').html(message_txt);
		setTimeout("$('#err_message_container').html('').hide();",50000);
		return false;
	}
}

function deleteNews(news_id, news_title){
	$('#succ_message_container').html('').hide();
	$('#err_message_container').html('').hide();
	
	val=confirm('Are you sure to delete the news having titled : "'+news_title+'" ?');

	if(val){
		$.ajax({
		  url: base_url+"ajax-delete-news",
		  type: "POST",
		  data: "news_id="+news_id,
		  dataType: "json",
		  async:false,
		  success: function(resp){
				 if(resp.ErrorCode == 0){
					$('#news_'+news_id).remove();
					$('#err_message_container').animate({height: 'hide', width: 'hide', opacity: 'hide'}, 300);
					$('#succ_message_container').animate({height: 'show', width: 'show', opacity: 'show'}, 300);
					$('#succ_message_container').html(resp.Message);
					setTimeout("$('#succ_message_container').html('').hide();",50000);
					return false;
				 }else{
					$('#succ_message_container').animate({height: 'hide', width: 'hide', opacity: 'hide'}, 300);
					$('#err_message_container').animate({height: 'show', width: 'show', opacity: 'show'}, 300);
					$('#err_message_container').html(resp.Message);
					setTimeout("$('#err_message_container').html('').hide();",50000);
					return false;	 
				 }
		  }
		});
	}
	return false;
}