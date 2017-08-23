<?php echo theme_css('msdropdown/flags.css', true);?><?php echo theme_css('msdropdown/dd.css', true);?><?php echo theme_css('fancybox/jquery.fancybox.css', true);?><?php echo theme_js('msdropdown/jquery.dd.js', true);?><?php echo theme_js('import.js', true);?>

<!--<script src="http://www.marghoobsuleman.com/mywork/jcomponents/image-dropdown/samples/js/msdropdown/jquery.dd.js"></script> -->
<?php echo theme_js('fancybox/jquery.fancybox.js', true);?>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.09/jquery.form.js"></script> -->
<div class="lcl-form">
  <div class="login-info">
    <div class="logo"> <img alt="Free Instant Quote" src="<?php echo $this->config->site_url()?>images/instant.jpg" /> <a href="<?php echo $this->config->site_url()?>"> <img alt="Export" style="width:215px;height:111px;&quot;" src="<?php echo $this->config->site_url()?>images/export.jpg"></a> </div>
    <?php include('havequeastion.php');?>
    <form name="frmskid" id="frmskid" action="" autocomplete="off">
      <div class="form-date">
        <label><b>Origin :</b></label>
        <div class="label-txt">
          <select name="countries" id="countries" class="getportimport">
            <option>Select Country</option>
            <?php for($i=0;$i<count($country);$i++) { ?>
            <?php if($country[$i]->import == "Yes") { ?>
            <option value='<?php echo $country[$i]->id?>' data-image="<?php echo $this->config->site_url()?>images/msdropdown/icons/blank.gif" data-imagecss="flag <?php echo strtolower($country[$i]->iso_code_2); ?>" data-title="<?php echo $country[$i]->name ?>"> <?php echo $country[$i]->name;?> </option>
            <?php } ?>
            <?php } ?>
          </select>
          <span name="city-section" id="city-section">
          <select tabindex="2" class="last" name="vDestCity" id="vDestCity"   >
            <option value="">City</option>
          </select>
          </span> </div>
        <div class="clear"></div>
      </div>
      <div class="form-date">
        <label><b>Destination :</b></label>
        <div class="label-txt">
          <div class="radio-box">
            <input tabindex="3" type="radio" name="vOrigin" id="vOrigin" value="Toronto" checked="checked" class="getportXX org"/>
            &nbsp;Toronto </div>
          <div class="radio-box">
            <input tabindex="3" type="radio" name="vOrigin" id="vOrigin" value="Montreal" class="getportXX org" />
            &nbsp;Montreal </div>
          <div class="radio-box">
            <input tabindex="3" type="radio" name="vOrigin" id="vOrigin" value="Vancouver" class="getportXX org" />
            &nbsp;Vancouver </div>
        </div>
        <div class="clear"></div>
      </div>
      <div class="form-date">
        <label><b>Dimensions :</b></label>
        <div class="label-txt">
          <div class="radio-box radio-boxdim">
            <input type="radio" name="dimension" id="dimension" class="dimension_select" value="in/lbs" checked="checked">
            &nbsp;in/lbs</div>
          <div class="radio-box radio-boxdim">
            <input type="radio" name="dimension" id="dimension" class="dimension_select" value="cm/kg">
            &nbsp;cm/kg</div>
        </div>
        <div class="clear"></div>
      </div>
      <div class="table-div">
        <p>Enter Dimensions & Weight for Real Time <a style="text-decoration:underline">"Instant Freight Quote"</a></p>
        <div class="table-box">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td>No.of SKID</td>
              <td>L</td>
              <td>W</td>
              <td>H</td>
              <td>Weight Per Item</td>
              <td>Total Volume in CBM(dims)</td>
              <td>Total Weight in <span id="wreplace">LBS</span ></td>
              <td>&nbsp;</td>
            </tr>
            <tr id="wrapcontXX" class="skidrow" rel="0">
              <td><input tabindex="4" type="text" name="iNoOfSkids[]" id="iNoOfSkids_0" placeholder="1" value="" maxlength="2" restrkg="10" restr="10" class="fradeitm lengthclass valid_id"></td>
              <td><input tabindex="5" type="text" name="iLength[]" id="iLength_0"  placeholder="40" maxlength="3" restr="90" restrkg="229" value="" rel="" class="fradeitm lengthclass valid_id"></td>
              <td><input tabindex="6" type="text" name="iWidth[]" id="iWidth_0"  placeholder="40" value="" maxlength="3" restr="90" restrkg="229" class="fradeitm lengthclass valid_id" ></td>
              <td><input tabindex="7" type="text" name="iHeight[]" id="iHeight_0" placeholder="40"  value="" maxlength="3" restr="84" restrkg="213" class="fradeitm lengthclass valid_id"></td>
              <td><input tabindex="8" type="text" name="fWeightPItem[]" id="fWeightPItem_0" placeholder="500" value="" restr="4600" restrkg="2086" class="fradeitm"></td>
              <td id="total_volume_cbm_0"></td>
              <td id="total_weight_lbs_0"></td>
              <td></td>
            </tr>
            <tr id="wrapcont" class="last-bor">
              <td colspan="5"><a tabindex="9" class="add-more cursor" id="addmore" >+ Add more</a></td>
              <td><strong><span id="total_vl_cbm">0</span></strong></td>
              <td><strong><span id="total_weight_cbm">0</span></strong></td>
              <td>&nbsp;</td>
            </tr>
          </table>
          <span id="maxreched" style="color:red;font-size:13px;"></span> </div>
      </div>
    </form>
    <div class="cals-box">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr align="left">
          <td colspan="5"><a tabindex="10" class="cals cursor" id="calculateimport">Calculate</a> &nbsp;<a class="cals cursor reset-btn" id="reset-frame1">Reset</a></td>
          <span id="showaftercalculate" style="display:none"> 
          <!--<td class="none showafcal"><b>&nbsp;OR</b></td>
                     <td class=" none showafcal"><input type="text" value="" placeholder="Email Address"></td> -->
          
          <td  class="none showafcal" align="right"><a id="print_q" href="" class="underline cursor" style="display: none">Print Quote</a> <a tabindex="11" class="cals cursor" id="email_q" style="float:right">Email Quote</a></td>
          </span> </tr>
      </table>
      <div style="float:rightz;display: none" id="email-q-container">
        <form name="frmsendq" id="frmsendq" style="margin-top:10px;">
          <div class="form-row">
            <input type="text" name="sender_email" id="sender_email" value="" placeholder="Email Address"  style="margin-right:2px;" title="Please enter proper email address" />
            <a id="send_q" class="sendbtn cursor" >Send</a> </div>
          <div id="sender_emailErr"></div>
        </form>
      </div>
    </div>
    <div class="quote-box"  id="booknowcontent" style="display: none">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr align="left">
          <td colspan="3">USD <em id="usd_price"></em></td>
          <td>CAD <em id="cand_price"></em></td>
          <td style="color:red" id="custom_message">&nbsp </td>
          <td align="right"><a tabindex="12" class="btn-print" data-toggle="confirmation-popout" id="booknow">Book Now</a></td>
        </tr>
      </table>
    </div>
    <div class="form-date"  style="display: none" id="sellinginfodiv" >Sailing : <span id="sellinginfo" ></span></div>
    <div class="clear"> <span id="rate_notes" style="display:none;">Notes : Rate includes Port to Port Ocean Freight, Handling fee, Solas Fee, Export Declaration Fee(up to 3 lines - $1 each additional line)</span> </div>
    <div class="form-date">
      <div id="map_canvas" class="map"  width="695" height="400" style="display:none"></div>
    </div>
    <div class="term-txt"> <a class="fancyboxopen" ar="<?php echo $this->config->site_url();?>quote/pageopen?id=10">Quote Notes</a> / <a  class="fancyboxopen"   ar="<?php echo $this->config->site_url();?>quote/pageopen?id=12" >Terms & Conditions</a> / <a title="faq" class="fancyboxopen"  ar="<?php echo $this->config->site_url();?>quote/pageopen?id=7">Faq</a> / <a data-toggle="modal" data-target="#myModal" >Still have a Question</a> </div>
<div class="cleardiv"></div>
  </div>
<div class="cleardiv"></div>
</div>
<script>
    //var gross_cbm = 0;
     //var gross_lbs = 0;
$(document).ready(function() {
	//$("#countries").msDropdown();
  var oDropdown = $("#countries").msDropdown({roundedBorder:false});  //.data("dd")
 
  $("#countries_msdd").attr('tabindex','2');
  //$("#countries_msdd").focus();
  //oDropdown.open();
   	$("#vDestCity").focus(function() {
		var oDropdown = $("#countries").msDropdown().data("dd");
		oDropdown.close();
	});
	
	$("#bill_country").focus(function() {
		$("#bill_country_msdd").css("border","1px solid #0075be");
	});
	$("#bill_country").focusout(function() {
		$("#bill_country_msdd").css("border","none");
	});
	
});

$(document).ready(function() {
    needToConfirm = false; 
    window.onbeforeunload = askConfirm;
});

function askConfirm() {
    if (needToConfirm) {
        // Put your custom message here 
        return "All filled data for quote will be lost."; 
    }
}

$("select,input,textarea").change(function() {
    needToConfirm = true;
});


</script> 
<script type="text/javascript">
	$(document).ready(function() {
		$(".fancyboxopen").click(function() {
			var hf = $(this).attr('ar');
	
				 $.fancybox({  
					'href' : hf,
					'type':'iframe',
					 helpers : {
        title: {
            type: 'inside',
            position: 'top'
        }
    },
					  scrolling: 'auto',
					width		: '50%',
					height		: '50%',
				});
		});
		
	});
</script> 
