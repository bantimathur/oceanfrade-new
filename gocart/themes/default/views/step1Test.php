 <?php echo theme_css('msdropdown/flags.css', true);?>
  <?php echo theme_css('msdropdown/dd.css', true);?>
<?php echo theme_js('msdropdown/jquery.dd.min.js', true);?>
 <div class="lcl-form" style=" min-height:850px;" >
    <div class="login-info" >
            <h1>LCL instant Quote......</h1>

<!-- Modal -->
  <?php include('havequeastion.php');?>    
            <form name="frmskid" id="frmskid" action="" autocomplete="off">
         <div class="form-date">
              <label>Origin :</label>
              <div class="label-txt">
                <div class="radio-box">
                  <input type="radio" name="vOrigin" id="vOrigin" value="Toronto" checked="checked" class="getport org"/>
                  &nbsp;Toronto
                </div>
                <div class="radio-box">
                  <input type="radio" name="vOrigin" id="vOrigin" value="Montreal" class="getport org" />
                  &nbsp;Montreal
                </div>
                <div class="radio-box">
                  <input type="radio" name="vOrigin" id="vOrigin" value="Vancouver" class="getport org" />
                  &nbsp;Vancouver
                </div>
              </div>
              <div class="clear"></div>
            </div>
            <div class="form-date">
              <label>Destination :</label>
              <div class="label-txt">
                  <select name="countries" id="countries" class="getport">
					<option>Select Country</option>
                     <?php for($i=0;$i<count($country);$i++) { ?>
                         <option value='<?php echo $country[$i]->id?>' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag <?php echo strtolower($country[$i]->iso_code_2); ?>" data-title="<?php echo $country[$i]->name ?>">
                              <?php echo $country[$i]->name?>
                         </option>
                     <?php } ?>
                  </select>
                  <span name="city-section" id="city-section">
                     <select class="last" name="vDestCity" id="vDestCity" >
                       <option value="">City / Port</option>
                     </select>
                </span>
              </div>
              <div class="clear"></div>
            </div>
             
            
               <div class="form-date">
                 <label>Dimension :</label>
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
                       <td>No.of SKD</td>
                       <td>L</td>
                       <td>W</td>
                       <td>H</td>
                       <td>Weight Per Item</td>
                       <td>Total Volume in CBM(dims)</td>
                       <td>Total Weight in <span id="wreplace">LBS</span ></td>
                       <td>&nbsp;</td>
                     </tr>
                     <tr id="wrapcontXX" class="skidrow" rel="0">
                       <td><input type="text" name="iNoOfSkids[]" id="iNoOfSkids_0" placeholder="1" value="" maxlength="2" restr="10" class="fradeitm lengthclass valid_id"></td>
                       <td><input type="text" name="iLength[]" id="iLength_0"  placeholder="40" maxlength="3" restr="90" restrkg="229" value="" rel="" class="fradeitm lengthclass valid_id"></td>
                       <td><input type="text" name="iWidth[]" id="iWidth_0"  placeholder="40" value="" maxlength="3" restr="90" restrkg="229" class="fradeitm lengthclass valid_id" ></td>
                       <td><input type="text" name="iHeight[]" id="iHeight_0" placeholder="40"  value="" maxlength="3" restr="84" restrkg="213" class="fradeitm lengthclass valid_id"></td>
                       <td><input type="text" name="fWeightPItem[]" id="fWeightPItem_0" placeholder="500" value="" class="fradeitm"></td>
                       <td id="total_volume_cbm_0"></td>
                       <td id="total_weight_lbs_0"></td>
                       <td></td>
                     </tr>
                     
                     <tr id="wrapcont" class="last-bor">
                       <td colspan="5"><a class="add-more cursor" id="addmore" >+ Add more</a></td>
                       <td><strong><span id="total_vl_cbm">0</span></strong></td>
                       <td><strong><span id="total_weight_cbm">0</span></strong></td>
                       <td>&nbsp;</td>
                     </tr>
                   </table>
				   <span id="maxreched" style="color:red;font-size:13px;"></span>
                 </div>
               </div>
            </form>
            <div class="cals-box">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr align="left">
                  <td colspan="5"><a class="cals cursor" id="calculate">Calculate</a> </td>
                  <span id="showaftercalculate" style="display:none">
                     <!--<td class="none showafcal"><b>&nbsp;OR</b></td>
                     <td class=" none showafcal"><input type="text" value="" placeholder="Email Address"></td> -->
                   
                     <td  class="none showafcal" align="right">
                        <a id="print_q" href="" class="underline cursor" style="display: none">Print Quote</a>
                       
						<a class="cals cursor" id="email_q" style="float:right">Email Quote</a>
                     </td>
                  </span>
                </tr>
              </table>
              <div style="float:right;display: none" id="email-q-container">
                  <form name="frmsendq" id="frmsendq" style="margin-top:10px;">
                     <div class="form-row">
                        <input type="text" name="sender_email" id="sender_email" value="" placeholder="Email Address"  style="margin-right:2px;" title="Please enter proper email address" />
                        <a id="send_q" class="sendbtn cursor" >Send</a>
                        <div id="sender_emailErr"></div>
                     </div>
                  </form>
              </div>
                         
              
            </div>
            <div class="quote-box"  id="booknowcontent" style="display: none">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr align="left">
                  <td colspan="3">USD <em id="usd_price"></em></td>
                  <td>CAD <em id="cand_price"></em></td>
				  <td style="color:red" id="custom_message">&nbsp; </td>
                  <td align="right"><a class="btn-print" id="booknow">Book Now</a></td>
                </tr>
              </table>
            </div>
			 <div class="form-date"  style="display: none" id="sellinginfodiv" >Sailing : <span id="sellinginfo" ></span></div><div class="clear"></div>
            <div class="form-date">              
               <div id="map_canvas" class="map"  width="695" height="400" style="display:none"></div>
            </div>
            <div class="term-txt">
               <a target="_blank" href="<?php echo $this->config->site_url();?>quote-note">Quote Note</a> / <a target="_blank"  href="<?php echo $this->config->site_url();?>terms-and-conditions">Terms & Conditions</a> /
               <a target="_blank"  href="<?php echo $this->config->site_url();?>faq">Faq</a> /
               <a data-toggle="modal" data-target="#myModal" >Still have a Question</a>
            </div>
             
          </div>
        </div>

         <script type="text/javascript">
        function codeAddress() {
            alert('ok');
        }
        
       
$(document).ready(function() {
	$("#countries").msDropdown();
	})


</script>
