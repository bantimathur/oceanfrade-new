 $("document").ready(function() {
	 
	  $('#calculateimport').click(function() {
		

     if($("#orderpre").val() != "") {
        var r = confirm("Are you sure, you want to continue");
        if (r == true) {
              calculate_cbm_tot_import();
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
        calculate_cbm_tot_import();
      }

		  
          
    });
	 
	 fetchImportRec();
	$('.getportimport').live("change",function() {
		var zone_id = $("#countries").val();
		var eOrigin = $(".org:checked").val();
		fetchImportRec(zone_id,eOrigin);
	});
 });
 
 
function calculate_cbm_tot_import() {	
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
	var url = site_url+"import/calculate_total";
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
$("#rate_notes").show();
		}
	});
          
	$('.showafcal').show();
	$('#booknowcontent').show();
}
 
function fetchImportRec(zone_id,eOrigin) {
 
    $("#loader").show();
    var url = site_url+"import/getPort";
    
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
   
    $.post(url, { zone_id: zone_id, eOrigin: eOrigin },
        function(data) {
           if(zone_id == "" || zone_id == "Select Country" || zone_id == undefined) {
			   var data = '[["A",33.347317, 120.163658]]';
			   initializemap(data,6);
		   } else {
			   initializemap(data,4);
		   }
		   
    });
}