
<div class="shipping-form">
  <div class="login-info">
    <form name="frmshipp" id="frmshipp" method="post" autocomplete="off" action="<?php echo $this->config->site_url()?>quote/step2_action">
     <input type="hidden" name="type" id="type"/>
     <input type="hidden" name="order_number" id="order_number"/>
     <!--<input type="hidden" name="currency_code" value="USD" />
		<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
        <input type="hidden" name="cmd" value="_xclick" />
		<input type="hidden" name="no_note" value="1" />
		<input type="hidden" name="lc" value="UK" />-->
 
       <h1>Shipper<span>Quote : Reg<span id="order_number_span"></span></h1>
       <div class="form-date">
         <label>Ship date * :</label>
         <div class="label-txt">
           <input name="shipped_on" id="shipped_on" type="textbox" value="" class="required" title="Please select date">
         </div>
         <div class="clear"></div>
         <br>   <br>
          <div id="shipped_onErr"  name="shipped_onErr" class="cuserr fleft" style="color:red;font-size:12px !important;"></div>
         
       </div>
       <div  class="borderform">
       <h2>Shipper Details :</h2>
       <div class="form-row">
		<div class="form-label">
	
<input name="ship_firstname" id="ship_firstname" type="text" placeholder="Shipper Name *">
			<div id="ship_firstnameErr" class="cuserr" style="text-align:left"></div>
		 </div>
		 <div class="form-label last">
			<input name="ship_company" id="ship_company" type="text" placeholder="Company Name *">
			<div id="ship_companyErr" class="cuserr" style="text-align:left"></div>
		 </div>
         <div class="clear"></div>
       
       </div>
       <div class="form-row">
			<div class="form-label">
				<input name="ship_address1" id="ship_address1" type="text" placeholder="Address *" title="Please enter address">
				<div id="ship_address1Err" class="cuserr" style="text-align:left"></div>
			</div> 
			<div class="form-label last">
				<input name="ship_address2" id="ship_address2" type="text" placeholder="Address 2" title="Please enter address2">
				<div id="ship_address2Err" class="cuserr" style="text-align:left"></div>
			</div>  
  
         <div class="clear"></div>
       
       </div>
	    <div class="form-row">      
		   <div class="form-label">
				<input name="ship_city" id="ship_city" type="text" placeholder="City *" title="Please enter city">
				<div id="ship_cityErr" class="cuserr" style="text-align:left"></div>
			</div> 
		   <div class="form-label last">
				<input name="ship_zip" id="ship_zip" type="text" maxlength="6" placeholder="Postal Code *" title="Please enter 6 digits postal code">
				<div id="ship_zipErr" class="cuserr" style="text-align:left"></div>
			</div>         
         <div class="clear"></div>		  
       </div>
       <div class="form-row">
         <!--<input name="ship_zone" id="ship_zone" type="text" placeholder="Province" title="please enter Province">-->
		 <select name="ship_zone" id="ship_zone" class="candaprselect" title="please enter Province">
			<option value="Alberta">Alberta	</option>
			<option value="British Columbia">British Columbia</option>
			<option value="Manitoba">Manitoba</option>
			<option value="New Brunswick">New Brunswick</option>
			<option value="Newfoundland and Labrador">Newfoundland and Labrador</option>
			<option value="Nunavut">Nunavut</option>
			<option value="Northwest Territories">Northwest Territories</option>
			<option value="Nova Scotia">Nova Scotia</option>
			<option value="Prince Edward Island">Prince Edward Island</option>
			<option selected="selected" value="Ontario">Ontario</option>
			<option value="Quebec">Quebec</option>
			<option value="Saskatchewan">Saskatchewan</option>
			<option value="Yukon">Yukon</option>
		 </select></div>
       <div class="form-row">
       <input name="ship_country" id="ship_country" type="text" placeholder="Country" value="Canada" readonly="readonly">
         <div class="clear"></div>
          <div id="ship_zoneErr" class="cuserr fleft"></div>
       </div>
     
       <div class="form-row">         
           <div class="form-label">
				<input name="ship_phone" id="ship_phone" type="text" placeholder="Phone *" title="Please enter phone number">
				<div id="ship_phoneErr" class="cuserr" style="text-align:left"></div>
			</div>
			<div class="form-label last">
				<input name="ship_email" id="ship_email" type="text" placeholder="Email *" title="please enter email">
				<div id="ship_emailErr" class="cuserr" style="text-align:left"></div>
			</div>
         <div class="clear"></div>
           
       </div>
       </div>
	    <div  class="borderform">
	   <h2>Consignee Details :</h2>
       <div class="form-row">
         <div class="form-label">
			<input name="bill_firstname" id="bill_firstname" type="text" placeholder="Receiver’s Name *" class="required" title="Please enter proper name">
			<div id="bill_firstnameErr" class="cuserr" style="text-align:left"></div>
		 </div>
		 <div class="form-label last">
			<input name="bill_company" id="bill_company" type="text" placeholder="Company Name *" class="required" title="Please enter company name">
			<div id="bill_companyErr" class="cuserr" style="text-align:left"></div>
		  </div>
         <div class="clear"></div>
        
       </div>
       <div class="form-row">
			<div class="form-label">
				<input name="bill_address1" id="bill_address1" type="text" placeholder="Address *" class="required" title="Please enter address">
				<div id="bill_address1Err" class="cuserr" style="text-align:left"></div>
			</div>
			<div class="form-label last">
				<input name="bill_city" id="bill_city" type="text" placeholder="City *" class="required" title="Please enter city">
				<div id="bill_cityErr" class="cuserr" style="text-align:left"></div>
			</div>
         <div class="clear"></div>    
       </div>
       <div class="form-row">
			<div class="form-label">
				<input name="bill_zone" id="bill_zone" type="text" placeholder="Province *" class="firstname" title="Please enter proper province"> 
				<div id="bill_zoneErr" class="cuserr" style="text-align:left"></div>
			</div>
			<div class="form-label last">			
					 <div class="map-country">
					  <select name="bill_country" id="bill_country" style="width:240px;
			   
				margin-right:0px;" class="required" title="Please select country">
						<option value="">Select Country *</option>
						<?php for($i=0;$i<count($country);$i++) { ?>
							<option value='<?php echo $country[$i]->id?>' data-image="<?php echo $this->config->site_url()?>images/msdropdown/icons/blank.gif" data-imagecss="flag <?php echo strtolower($country[$i]->iso_code_2); ?>" data-title="<?php echo $country[$i]->name ?>">
								 <?php echo $country[$i]->name?>
							</option>
						<?php } ?>
					  </select></div>
					 <div id="bill_countryErr" class="cuserr" style="text-align:left"></div>
			 </div>
         <div class="clear"></div>
         
       </div>
       <div class="form-row">
         <div class="form-label">
			<input name="bill_zip" id="bill_zip" type="text"   placeholder="Postal Code" class="" title="Please enter postal code">
			<div id="bill_zipErr" class="cuserr" style="text-align:left"></div>
		 </div>
		 <div class="form-label last">
				<input name="bill_email" id="bill_email" type="text" placeholder="Email" class="" title="Please enter email">
				<div id="bill_emailErr" class="cuserr" style="text-align:left"></div>
		 </div>
         <div class="clear"></div>
        
       </div>
       <div class="form-row">
	   
         <input name="bill_phone" id="bill_phone" type="text" placeholder="Phone *"  class="required"  title="Please enter phone number">
         <div class="clear"></div>
          <div id="bill_phoneErr" class="cuserr fleft"></div>
       </div>
        </div>
		<div class="borderform">
        <h2>Commodity:</h2>
        <p>Additional Comments:</p>		
    	<div class="form-row"><input name="tCommodity" id="tCommodity" type="text" title="Please enter commodity info"  class="required" style="vertical-align:top" placeholder="Furniture, Mugs, Toys, Auto 	Parts"></div>
        <div class="form-row">
        <textarea id="tCommodityComment" name="tCommodityComment"  placeholder="Special Instructions (if any)" style="height: 80px;width: 280px;"></textarea>
         <div id="tCommodityErr" class="cuserr" style=""></div>
		 <div class="clear"></div>
        </div>
	    </div>

<div class="term-txt">
<p class="red">For Sample local pickup/delivery rates, Please</p>
<p><a class="herebtn fancyboxopen" ar="<?php echo $this->config->site_url();?>quote/pageopen?id=42">Click Here</a></p>
<p>For Door to our Warehouse/CFS rates: Please </p>
<p><a class="herebtn cursor" id="displaypickupinfo"  name="displaypickupinfo">click here</a><br />
or email us at<br />
<a href="mailto:info@shipmyfreight.ca">info@shipmyfreight.ca</a></p>
<div class="clear"></div>
       </div>
          <div class="clear"></div>
         
        <span id="pickupcontainer"  name="pickupcontainer" style="display: none">
          <br><br>
          <div class="form-row">
              <input name="pick_postalcode" id="pick_postalcode" maxlength="6"  type="text" placeholder="Postal Code *" class="required" title="Please enter postal code">
              <input name="pick_dock" id="pick_dock" type="checkbox" placeholder="DOCK" value="Yes" style="float:none;width:25px;margin-left:84px;" checked="checked"> Dock Facility Available
              <div class="clear"></div>
               <div id="pick_postalcodeErr" class="cuserr" style="float:left;"></div>
                <div id="pick_dockErr" class="cuserr" style="float:right;padding-right:96px;"></div>
          </div>
           <div class="form-row">
              <div class="form-label">
					<input name="pick_email" id="pick_email" type="text" placeholder="Email Address *" class="required email" title="Please enter email">
					<div id="pick_emailErr" class="cuserr" style="text-align:left"></div>
			 </div>
			  <div class="form-label last">
					<input name="pick_phone" id="pick_phone" type="text" placeholder="Phone Number *" class="required" title="Please enter phone number ">
					<div id="pick_phoneErr" class="cuserr" style="text-align:left"></div>
			   </div>
              <div class="clear"></div>
              
          </div>
            <div class="form-row">
              <textarea name="pick_additional_info" id="pick_additional_info" placeholder= "Additional information/Speacial Instruction (if any)" style="height: 80px;width: 580px;"></textarea>
              <div class="clear"></div>
               <div id="pick_additional_infoErr" class="cuserr" style="float:left;"></div>
            </div>
         </span>
          <div class="clear"><br></div>
         
<div class="form-btn pad2">
<input type="button" name="button" id="contactu" value="Submit & Have us contact you" class="submit-btn">
<br />
<p>OR</p>
<br />
<input type="button" name="button" id="paynow" value="Submit & Pay Now" class="submit-btn">
<input type="button" name="button" id="reset-frame2" value="Reset" class="submit-btn">
</div>
</form>
  </div>
</div>
