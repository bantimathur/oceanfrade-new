$("document").ready(function() {
    //alert(22);
	

	
		$("#bill_country").live("change",function() {			
			$("#bill_countryErr").html('');
		});
         $(function() {
                $( "#shipped_on" ).datepicker({
                            showOn: "button",
						  buttonImage: "http://shipmyfreight.ca/LCL/images/calendar.gif",
						  buttonImageOnly: true,
						  buttonText: "Select date",
						  dateFormat : "yy-mm-dd",
						  minDate : new Date(),
						   onSelect: function(dateText, inst) {
								$("#shipped_onErr").html('');
                $('#ship_firstname').focus();
							}
                        });
        });
		var codeArray = ["48","49","50","51","52","53","54","55","56","57"];
		/*$('.valid_id').live("keyup",function(event){
				alert(isNaN($(this).val()));
			if(isNaN($(this).val())) {
				event.preventDefault();
			}
		}); */
		
		
		$('.valid_id,.fradeitm').live("keypress",function(event){
		var iKeyCode = (event.which) ? event.which : event.keyCode;
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
            return false;
			if($('#dimension:checked').val() != "cm/kg") {
				var restr = $(this).attr('restr');
			} else {
					var restr = $(this).attr('restrkg');
			}
			
				var num = '';
				var number = $(this).val();
				var code = event.keyCode;
				var value = $(this).val();
					   
				for(var i=0;i<(codeArray.length);i++){
					if(code == codeArray[i]){
						num = i;
					}
				}
						
				number = number + num;	
				//alert(number);
				if(number > parseInt(restr)){
					event.preventDefault();
				}
				
				if(value.length > 1){
					//event.preventDefault();
				} 
	
   
		});
	
     $("#frmsendq").validate({
        rules:{
            sender_email:{
                required:true,
                email:true
            }  
          },
          errorPlacement: function(error, element) {
               if (element.attr("name") == "sender_email"){                 
                 error.appendTo("#sender_emailErr");  
               }                                             
          }
       
     });
    
     var index = 0;
    
     
     var zone_id = $("#countries").val();
     var eOrigin = $(".org:checked").val();    
     fetchRec(zone_id,eOrigin);
    
    
    $('.getport').live("change",function() {
        var zone_id = $("#countries").val();
        var eOrigin = $(".org:checked").val();
        //alert(zone_id);
        fetchRec(zone_id,eOrigin);
    });
    
    //code for add more functionality
    $(".delete_row").live("click",function() {
        var rel = $(this).attr('rel');
        
      
		  $("#rw_"+rel).remove();      
           index = index - 1;
		   $('#maxreched').html('');
		   $('.skidrow').each(function () {
               var rel = $(this).attr('rel');
               calculate_q(rel);
          });
        
    });


    $('#addmore').live('keyup', function (evt) {       
        var e = evt || event;
        var code = e.keyCode || e.which;
        if (code === 13) {  // 13 is the js key code for Enter
           $("#addmore").trigger("click");
        }
    });
   

     $("#addmore").click(function() {
          
          if (parseInt(index) >= 14) {
			  $('#maxreched').html('Maximum row reached');
            return false;
          }
          var cytab = $("#addmore").attr('tabindex');           
          //cytab = parseInt(cytab) + 1;

		      index = index + 1;
          var rel = $(this).attr('rel');
          var str = '<tr class="skidrow"  rel="'+index+'" id="rw_'+index+'"><td><input tabindex="'+cytab+'" type="text" name="iNoOfSkids[]" id="iNoOfSkids_'+index+'"  value="" maxlength="2" restr="10" class="fradeitm lengthclass valid_id"></td>';
               cytab = parseInt(cytab) + 1;
               str += '<td><input type="text" tabindex="'+cytab+'" name="iLength[]" id="iLength_'+index+'"  value="" maxlength="3" restr="90" restrkg="229" class="fradeitm lengthclass valid_id"></td>';
               cytab = parseInt(cytab) + 1;
               str +=  '<td><input type="text" tabindex="'+cytab+'" name="iWidth[]" id="iWidth_'+index+'"  value="" maxlength="3" restr="90" restrkg="229" class="fradeitm lengthclass valid_id"></td>';
               cytab = parseInt(cytab) + 1;
               str += '<td><input type="text" tabindex="'+cytab+'" name="iHeight[]" id="iHeight_'+index+'"  value="" maxlength="3" restr="84" restrkg="213" class="fradeitm lengthclass valid_id"></td>';
              cytab = parseInt(cytab) + 1;
               str += '<td><input type="text" tabindex="'+cytab+'" name="fWeightPItem[]" id="fWeightPItem_'+index+'"  value="" class="fradeitm"></td>';
                cytab = parseInt(cytab) + 1;
               str +=  '<td id="total_volume_cbm_'+index+'"></td>';                
                str +=  '<td id="total_weight_lbs_'+index+'"></td>';               
               str +=  '<td><img rel="'+index+'" src="images/delete-icon.png" width="22" height="22" class="delete_row cursor"></td>';
               str +=   '</tr>';
                //alert(str);
               $("#wrapcont").before(str);			 
			         $("#iNoOfSkids_"+index).focus();
               
               $("#addmore").attr('tabindex',cytab);
               cytab = parseInt(cytab) + 1;
                $("#calculate").attr('tabindex',cytab);
                 cytab = parseInt(cytab) + 1;
                $("#email_q").attr('tabindex',cytab);
                cytab = parseInt(cytab) + 1;
                $("#booknow").attr('tabindex',cytab);
                
    });

    $('#calculate').live('keyup', function (evt) {       
        var e = evt || event;
        var code = e.keyCode || e.which;
        if (code === 13) {  // 13 is the js key code for Enter
           $("#calculate").trigger("click");
        }
    });
    
    $('#calculate').click(function() {
		

     if($("#orderpre").val() != "") {
        var r = confirm("Are you sure, you want to continue");
        if (r == true) {
              calculate_cbm_tot();
              $("#step2").show();
              $("#frmshipp").find('input[type=text]').val('');
              $("#example-form").find('input[type=text]').val('');
              $("#ship_country").val('Canada');
              $("#step3").hide();
              $("#orderpre").val('');
        } else {
           return false;
        }
      } else {
        calculate_cbm_tot();
      }

		  
          
    });
    
     $("#email_q").click(function() {
          $("#email-q-container").show();
     });
    $('#email_q').live('keyup', function (evt) {       
        var e = evt || event;
        var code = e.keyCode || e.which;
        if (code === 13) {  // 13 is the js key code for Enter
           $("#email_q").trigger("click");
        }
    });
	 
	 $('#sender_email').keypress(function(e) {
		 if(e.keyCode == 13) {
			return false;
		 }
	 });
      $("#send_q").click(function() {
         var vld = $('#frmsendq').valid();
        
         if (!vld) {
            return false;
         } else {
               var url = site_url+"quote/send_quate";
               var order_number = $("#order_number").val();
               //alert(order_number);
               $.post(url, { order_number: order_number ,sender_email : $('#sender_email').val()},
                    function(data) {                   
                         $('#sender_emailErr').html('Email has been sent successfully');
                         setTimeout(function() {
                            $('#sender_emailErr').html('');
                           },3000);
                    });
               // send quation with sender email + attachment the pdf
         }
         
     });
      $('#booknow').live('keyup', function (evt) {       
        var e = evt || event;
        var code = e.keyCode || e.which;
        if (code === 13) {  // 13 is the js key code for Enter
           $("#booknow").trigger("click");
        }
    });
     $("#booknow").click(function() {
         $("#cargopage").remove();
         
         if($("#orderpre").val() != "") {
              var r = confirm("Are you sure, you want to continue");
              if (r == true) {
                  $("#step2").show();
                  $("#frmshipp").find('input[type=text]').val('');
                  $("#example-form").find('input[type=text]').val('');
                  $("#ship_country").val('Canada');
                  $("#step3").hide();
                  $("#orderpre").val('');
              } else {
                 return false;
              }
         } else {
            $("#step2").show();
            $('.ui-datepicker-trigger').trigger("click");
            place_index_form2();
         }
 
     });
     
     
     $('.fradeitm').live("keyup",function() {
          var id_index = $(this).attr('id');
          var id_index = id_index.split("_");          
          calculate_q(id_index[1]);
     });
     $(".dimension_select").live("change",function () {
		 var dimension = $(".dimension_select:checked").val();
		  $('.skidrow').each(function () {
               var rel = $(this).attr('rel');
               value_conversation(rel,dimension);
          });
          $('.skidrow').each(function () {
               var rel = $(this).attr('rel');
               calculate_q(rel);
          });
          
     });
     
     $("#vDestCity").live("change",function() {
         
          $("#maploader").show();
          var eOrigin = $(".org:checked").val();  
          var url = site_url+"quote/getMarker";
        
          $.post(url, { dest_city: $("#vDestCity >  option:selected").text(), eOrigin: eOrigin ,countries : $('#countries').val()},
              function(data) {  				
                   initializemap(data,1);
          });
		  if( $("#vDestCity").val() != "") {
			  var frq = $("#vDestCity > option:selected").attr('rel');              
			   $("#sellinginfodiv").show();
              $("#sellinginfo").html(frq);
		  }
		  
		  
     });
     
    
    
});

function place_index_form2() {
  var book_index = $("#booknow").attr('tabindex');
  //alert(book_index);
  book_index = parseInt(book_index) + 1;

  $("#frmshipp").find('input').each(function() {
    //alert($(this).attr('name'));
    var idds= $(this).attr('id');
    $("#"+idds).attr('tabindex',book_index);
    book_index = parseInt(book_index) + 1;
  });
    book_index = $("#tCommodity").attr('tabindex');
    book_index = parseInt(book_index) + 1;
    $("#tCommodityComment").attr('tabindex',book_index);
    book_index = parseInt(book_index) + 1;
    $("#displaypickupinfo").attr('tabindex',book_index);
    book_index = parseInt(book_index) + 1;
    $("#pick_postalcode").attr('tabindex',book_index);
    book_index = parseInt(book_index) + 1;
    $("#pick_dock").attr('tabindex',book_index);
        book_index = parseInt(book_index) + 1;
    $("#pick_email").attr('tabindex',book_index);
        book_index = parseInt(book_index) + 1;
    $("#pick_phone").attr('tabindex',book_index);
         book_index = parseInt(book_index) + 1;
    $("#pick_additional_info").attr('tabindex',book_index);
  
    
    book_index = parseInt(book_index) + 1;
    $("#contactu").attr('tabindex',book_index);
    book_index = parseInt(book_index) + 1;
    $("#paynow").attr('tabindex',book_index);
    
    book_index = $("#bill_zip").attr('tabindex');
    $("#bill_country").attr('tabindex',book_index);
    
    $("#ship_zone").attr('tabindex',$("#ship_zip").attr('tabindex'));

    
}

function calculate_cbm_tot() {
  var destcity = $("#vDestCity > option:selected").val();       
      if (destcity == "") {
               alert('Please enter proper destination city');
         return false;
      }
          var total_vl_cbm = $('#total_vl_cbm').html();          
          if (total_vl_cbm == "0" || total_vl_cbm == '') {
            alert('Please enter values to get quote');
            return false;
          }
          var url = site_url+"quote/calculate_total";
           $.ajax({
               type: "POST",
               url: url,
               data: $('#frmskid').serialize(),
               success: function(res){
                 var res = $.parseJSON(res);
                 //alert(res);
                   $("#order_number").val(res.refno);
                   $("#order_number_span").html(res.refno);
                    $("#usd_price").html(res.total_price);
                     $("#cand_price").html(res.canadian_total_price);
                     $("#custom_message").html(res.custom_message);
        
               }
          });
          
          $('.showafcal').show();
          $('#booknowcontent').show();
}

function fetchRec(zone_id,eOrigin) {

 
    $("#loader").show();
    var url = site_url+"quote/getPort";
    //alert(eOrigin);
    $.post(url, { zone_id: zone_id, eOrigin: eOrigin },
        function(data) {
            
			if($.trim(data) == "") {
				return false;
			}
       if(zone_id == "Select Country") {
        return false;
      }
            $("#loader").hide();           
            $("#city-section").html(data);
    });
	
	    var url = site_url+"quote/getcMap";
    //alert(zone_id);
    $.post(url, { zone_id: zone_id, eOrigin: eOrigin },
        function(data) {
           if(zone_id == "" || zone_id == "Select Country") {
			   initializemap(data,6);
		   } else {
			   initializemap(data,4);
		   }
		   
    });
}

function value_conversation(index_val,type) {
	var iLength     = $("#iLength_"+index_val).val();
    var iWidth     = $("#iWidth_"+index_val).val();
    var iHeight     = $("#iHeight_"+index_val).val();
	var fWeight	= $("#fWeightPItem_"+index_val).val();
	 if (type == "in/lbs") { 
		$("#wreplace").html('LBS');
		iLength = parseInt(iLength) / 2.54;
		iWidth = parseInt(iWidth) / 2.54;
		iHeight = parseInt(iHeight) / 2.54;
		
		fWeight = parseInt(fWeight) * 2.205;
		//alert(fWeight);
		fWeight = Math.floor(fWeight);
	} else {
		$("#wreplace").html('KGS');
		 iLength = parseInt(iLength) * 2.54;
		 iWidth = parseInt(iWidth) * 2.54;
		 iHeight = parseInt(iHeight) * 2.54;
		 fWeight = parseInt(fWeight) / 2.205;
		 //alert(fWeight);
		 fWeight = Math.round(fWeight);
	 }
	if($("#iLength_"+index_val).val() != "") {
			 $("#iLength_"+index_val).val(parseInt(Math.round(iLength)));
	}
	
	if($("#iWidth_"+index_val).val() != "") {
			$("#iWidth_"+index_val).val(parseInt(Math.round(iWidth)));
	}
	if($("#iHeight_"+index_val).val() != "") {
			 $("#iHeight_"+index_val).val(parseInt(Math.round(iHeight)));
	}
	
	if($("#fWeightPItem_"+index_val).val() != "") {
			 $("#fWeightPItem_"+index_val).val(fWeight);
	}
	 
	
}

function calculate_q(index_val) {
    // alert(index_val)
    var iNoOfSkids  = $("#iNoOfSkids_"+index_val).val();
    var iLength     = $("#iLength_"+index_val).val();
    var iWidth     = $("#iWidth_"+index_val).val();
    var iHeight     = $("#iHeight_"+index_val).val();
    var fWeightPItem = $("#fWeightPItem_"+index_val).val();
     //alert(iNoOfSkids)
    if (iNoOfSkids == "" || iLength == "" || iWidth == "" || iHeight == "" || fWeightPItem == "") {
        return false;
    } else {
          var dimension = $(".dimension_select:checked").val();
         
          if (dimension == "in/lbs") {
            var total_weight_lbs = parseInt(iNoOfSkids) * parseInt(fWeightPItem);
            var cubic_feet = (parseInt(iLength) * parseInt(iWidth) * parseInt(iHeight)) / 1728;
            var total_volume_cbm = cubic_feet / 35.3145;
			total_volume_cbm = total_volume_cbm * iNoOfSkids;
            //total_volume_cbm = total_volume_cbm.toFixed(2);
          } else {
               var total_weight_lbs = parseInt(iNoOfSkids) * parseInt(fWeightPItem);
               //var total_volume_cbm = fWeightPItem/1000;			
			   //total_volume_cbm = total_volume_cbm * iNoOfSkids;
				iLength = parseInt(iLength) / 2.54;
				iWidth = parseInt(iWidth) / 2.54;
				iHeight = parseInt(iHeight) / 2.54;
			    var cubic_feet = (parseInt(iLength) * parseInt(iWidth) * parseInt(iHeight)) / 1728;
				var total_volume_cbm = cubic_feet / 35.3145;
				total_volume_cbm = total_volume_cbm * iNoOfSkids;
          }
          $("#total_weight_lbs_"+index_val).html(total_weight_lbs.toFixed(2));
          $("#total_volume_cbm_"+index_val).html(total_volume_cbm.toFixed(2));
         calculate_gross();
    }
    
}

function calculate_gross() {
     var gross_cbm = 0;
     var gross_weight = 0;
     $('.skidrow').each(function() {
          var rel = $(this).attr('rel');      
          var  total_volume_cbm    = parseFloat($("#total_volume_cbm_"+rel).html());         
          var total_weight_lbs     = parseFloat($("#total_weight_lbs_"+rel).html());
          if ($("#total_volume_cbm_"+rel).html() != "") {
               gross_cbm = parseFloat(gross_cbm) + parseFloat(total_volume_cbm);
               gross_weight = parseFloat(gross_weight) + parseFloat(total_weight_lbs);
          }
          
     });
     $("#total_vl_cbm").html(gross_cbm.toFixed(2));
     $("#total_weight_cbm").html(gross_weight.toFixed(2));
}