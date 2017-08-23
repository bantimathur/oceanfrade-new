$("document").ready(function() {
	
		$("#frmlogin").validate({
			ignore: ":hidden",
			rules:{
				email:{
					required:true
				}
			},
			messages:{
				email:{
					required:'Please enter proper email'
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