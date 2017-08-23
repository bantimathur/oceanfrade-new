$("document").ready(function() {
    
      $("#frmqueastion").validate({
        rules:{
            contact_name:{
                required:true
            },
            phonenumber:{
                required:true
            },
            contact_email :{
                required:true,
                email:true
            },
             queastion :{
                required:true
            }
        },
        messages:{
            contact_name:{
                required:'Please enter name'
            },
            phonenumber:{
                required:'please enter phone number'
            },
            contact_email :{
                required:'please enter email'
            },
             queastion :{
                required:'Please enter queastion'
            }
      },
        errorPlacement: function(error, element) {
            if (element.attr("name") == "contact_name"){
              error.appendTo("#contact_nameErr");  
            } else if (element.attr("name") == "phonenumber"){
              error.appendTo("#phonenumberErr");  
            }  else if (element.attr("name") == "contact_email"){
              error.appendTo("#contact_emailErr");  
            }   else if (element.attr("name") == "queastion"){
              error.appendTo("#queastionErr");  
            }                                          
        }
    });
     
    
      $("#queastion_save").click(function() {
          var vld = $("#frmqueastion").valid();          
          if (!vld) {
            return false;
          } else {
            var formdata = $("#frmqueastion").serialize();
			
            var url = site_url+"quote/send_email_quastion";         
            $.post(url, { formdata: formdata },
                function(data) {
                  $("#frmqueastion").find("input[type=text], textarea").val("");
                  $("#succmsgforq").show();
                  setTimeout(function() {
                        $("#succmsgforq").hide();
                        //$("#cancelmodal").trigger('click');
                  },3000)
            });
          }
            
     });
});