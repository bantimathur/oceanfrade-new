$("document").ready(function() {
	
	  $("#frmregister").validate({
			ignore: ":hidden",
			rules:{
				username:{
					required:true
				},
				password:{
					required:true,
					minlength:8,
					maxlength:8
				},
				scode:{
					required:true,
					minlength:8,
					maxlength:8
				},
				phonenumber:{
					required:true,
					number:true
				},
				email:{
					required:true,
					email:true
				},
				buisenessname:{
					required:true,
					maxlength:100
				},
				name:{
					required:true,
					maxlength:100
				}
			},
			 messages:{
				username:{
					required:'Please enter username/email'
				},
				password:{
					required:'Please enter password'
				},
				phonenumber:{
					required:'Please enter phone number',
					number : 'Please enter numeric value'
				},
				email:{
					required:'Please enter email',
					email:'Please enter email',
				},
				buisenessname:{
					required:'Please enter buiseness name',
					maxlength : 'Maximum length must be 100 characters only'
				},
				name:{
					required:'Please enter name',
					maxlength : 'Maximum length must be 100 characters only'
				}
			}
	  });
	
	$("#register").click(function() {
		
		var vld = $("#frmregister").valid();
		if(!vld) {
			return false;
		} else {
			var params = {};
			params['email'] = $("#email").val();
			params['username'] = $("#username").val();
			var url = site_url+"secure/check_unq_email_username";
			
			$.ajax({
				   type: "POST",
				   url: url,
				   data: params,
				   success: function(res){
					   var data = $.parseJSON(res);
					   if(data['succ'] == 1) {
						   $("#frmregister").submit();
					   } else {
						   if(data['email'] == "Yes") {
							   $("#emailErr").html("Email already exists.");
						   }
						   if(data['username'] == "Yes") {
							 $("#usernameErr").html("Username already exists");  
						   }
					   }
					}
			});
			//$("#frmregister").submit();
		}
		
	});
	
	$("#reset").click(function() {
		$("#frmregister").find('input[type="text"]').val('');		
	});
	
	
});
