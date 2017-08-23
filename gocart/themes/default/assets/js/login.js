$("document").ready(function() {
	
		$("#frmlogin").validate({
			ignore: ":hidden",
			rules:{
				username:{
					required:true,
					email:true
				},
				"password":{
					required:true
				}
			},
			messages:{
				username:{
					required:'Please enter username/email'
				},
				"password":{
					required:'Please enter password'
				}
			}
		});
		
		$("#login").click(function() {
			var vld = $("#frmlogin").valid();
			if(!vld) {
				return false;
			} else {
				$("#frmlogin").submit();
			}
		});
		
});