$("document").ready(function() {

	$("#reset-frame2").click(function() {
		var old_type = $("#type").val();		
		var old_order_number = $("#order_number").val();
		$("#frmshipp").find('input:text').val('');
		$("#frmshipp").find('textarea').val('');
		$("#type").val(old_type);
		$("#order_number").val(old_order_number);	
$("div.err").hide();	
	});

    $("#bill_country").msDropdown();
      $("#frmshipp").validate({
		  ignore: ":hidden",
        rules:{
            shipped_on:{
                required:true
            },
			ship_company :{
				lastname : true
			},	
            ship_firstname:{
                required:true,
				namewithdot : true
            },
			bill_firstname :{
				required:true,
				namewithdot : true
			},
			bill_company :{
				lastname : true
			},
            ship_address1:{
                required:true
            },
            ship_city:{
                required:true,
				city : true
            },
			 bill_city:{
                required:true,
				city : true
            },
            ship_zone:{
                required:true
            },
            ship_zip : {
               required:true,
			   maxlength : 6,
			   minlength : 6
            },
             ship_email : {
               required:true,
               email : true
            },
			  bill_email : {
              // required:true,
               email : true
            },
             ship_phone : {
               required:true,
			   phonenumber : true
            },
			  bill_phone : {
               required:true,
			   phonenumber : true
            },
			  bill_zip : {
              // required:true,
			   maxlength : 1000
			  
            },
            pick_phone :{
                phonenumber : true
            },
			 pick_postalcode :{
				 maxlength : 6,
			   minlength : 6
            }
     
        },
        messages:{
            vEmail:{
                required:'Please enter email address'
            },
			ship_company :{
				lastname : 'Please enter company name'
			},
			bill_company :{
				lastname : 'Please enter company name'
			},
			  ship_firstname:{
                required:'Please enter proper name',
				namewithdot : 'Please enter proper name'
            },
			            ship_zip : {
               required:'Please enter 6 digits code',
			   maxlength : 'Please enter 6 digits code',
			   minlength : 'Please enter 6 digits code',
			   number : 'Please enter number only'
            },
			 pick_postalcode :{
                  maxlength : 'Please enter 6 digits code',
			   minlength : 'Please enter 6 digits code',
            },
			 bill_zip : {
              //required:'Please enter 6 digits code',
			   maxlength : 'Please enter 6 digits code',
			   minlength : 'Please enter 6 digits code',
			   number : 'Please enter number only'
            },
            vName:{
                required:'Please enter your name'
            },tDescription:{
                required:'Plese enter description'
            },
            vPhoneNumber:{
                required:"Please enter phone number"
            },
            vCity:{
                required:"Please enter city"
            },           
            vCode : {
               required:'Please enter proper sum of these number'
            }
      },
        errorPlacement: function(error, element) {
            if(element.attr("name") == "ship_firstname") {
                  error.appendTo("#ship_firstnameErr"); 
            } else if(element.attr("name") == "ship_firstname") {
                  error.appendTo("#ship_firstnameErr"); 
            } else {
                  var n = element.attr("name");
                  error.appendTo("#"+n+"Err");
            }                                            
        }
    });
     

  $('#contactu').live('keyup', function (evt) {       
          var e = evt || event;
          var code = e.keyCode || e.which;
          if (code === 13) {  // 13 is the js key code for Enter
             $("#contactu").trigger("click");
          }
        });

     $("#contactu").click(function() {
          var vld = $("#frmshipp").valid();
     
          if (!vld) {
            return false;
          } else {
			      needToConfirm = false;
            $('#type').val('contactus');
            $("#frmshipp").submit();
          }
     });
     
 $('#paynow').live('keyup', function (evt) {       
          var e = evt || event;
          var code = e.keyCode || e.which;
          if (code === 13) {  // 13 is the js key code for Enter
             $("#paynow").trigger("click");
          }
        });
     
      $("#paynow").click(function() {
          var vld = $("#frmshipp").valid();
          if (!vld) {
            return false;
          } else {
			        needToConfirm = false;
              $('#type').val('paynow'); 
                      
                $("#frmshipp").ajaxSubmit({
                  url: $("#frmshipp").attr('action'),
                  dataType: 'json',
                  success: function(data) {
                        
                       //$("#frmshipp").reset();  
                       $("#step2").hide();
                       $("#step3").show(); 
                       $("#orderpre").val(data.order_number); 
                       window.scrollTo(0, 0);          
                  }
                });
          }
      });
          
      $("#displaypickupinfo").live("click",function() {            
            $('#pickupcontainer').toggle();
      });
      
        $('#displaypickupinfo').live('keyup', function (evt) {       
          var e = evt || event;
          var code = e.keyCode || e.which;
          if (code === 13) {  // 13 is the js key code for Enter
             $("#displaypickupinfo").trigger("click");
          }
        });



      
});
      