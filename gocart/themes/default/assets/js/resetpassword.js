$("document").ready(function() {
	
		$("#frmlogin").validate({
			ignore: ":hidden",
			rules:{
				password:{
					required:true,
					minlength:8,
					maxlength:8
				}
			},
			messages:{
				password:{
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