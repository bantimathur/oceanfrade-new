<div class="shipping-form">
  <div class="login-info">
   <img class="paylogo" src="<?php echo $this->config->site_url()?>images/creditcards.png">
    <form id="example-form"  method="post" autocomplete="off" action="<?php echo $this->config->site_url()?>quote/step3_action">
     	<input type="hidden" name="orderpre" id="orderpre"/>

     	<div class="form-date form-date-stripe ">
             <label>Currency :</label>
             <div class="label-txt card-number-cl ">
                <input type="radio" class="currency-stripe" name="currency[]" id="currency" checked="checked" style="width:30px;" value="cad"> CAD
               <input type="radio" class="currency-stripe" name="currency[]" id="currency"  style="width:30px;" value="usd">  USD               
             </div>
             <div class="clear"></div>     
         
        </div>
        <div class="form-date form-date-stripe ">
             <label>Amount :</label>
             <div class="label-txt card-number-cl ">
               <input maxlength="20" autocomplete="off" name="amount" id="amount" class=" required number" type="textbox" value="50" title="Please enter amount">
				<div><small>If you want to pay more, just edit the amount</small></div>
			 </div>
             <div class="clear"></div>      
         
        </div>
         <div class="form-date form-date-stripe ">
         <label>Card Number :</label>
         <div class="label-txt card-number-cl ">
           <input maxlength="20" autocomplete="off" class="card-number stripe-sensitive required" type="textbox" value="" title="Please enter card no">
         </div>
         <div class="clear"></div>
        
         
       </div>
       	 <div class="form-date form-date-stripe">
         <label>CVC :</label>
         <div class="label-txt card-cvc-cl">
           <input  title="Please enter cvv" type="textbox" value="" maxlength="4" autocomplete="off" class="card-cvc stripe-sensitive required" >
         </div>
         <div class="clear"></div>
        
         
       </div>
        <div class="form-date form-date-stripe">
         <label>Expire Date :</label>
         <div class="label-txt">
           	<select class="card-expiry-month stripe-sensitive required">
            </select>
           
              <select class="card-expiry-year stripe-sensitive required"></select>
         </div>
         <div class="clear"></div>
        
         
       </div>
          <div class="form-date pad2 form-date-stripe">
         <label></label>
         <div class="label-txt">
                 <input type="submit" name="submit-button" value="Submit" class="submit-btn stripesubm">
                 <span ><img id="stripeloader" src="<?php echo $this->config->site_url()?>images/ajax-loader.gif" style="display:none"></span>
         </div>
         <div class="clear"></div>
        
         
       </div>
  
             <div class="payment-errors"></div><br/>

 	</form>
	 <img class="paylogo" src="<?php echo $this->config->site_url()?>images/creditcards.png" >
 </div>
</div>

<script type="text/javascript">
    var select = $(".card-expiry-year"),
        year = new Date().getFullYear();

    for (var i = 0; i < 5; i++) {
        select.append($("<option value='"+(i + year)+"' "+(i === 0 ? "selected" : "")+">"+(i + year)+"</option>"))
    }
</script>
<script type="text/javascript">
var select = $(".card-expiry-month"),
    month = new Date().getMonth() + 1;
for (var i = 1; i <= 12; i++) {
    select.append($("<option value='"+i+"' "+(month === i ? "selected" : "")+">"+i+"</option>"))
}
</script>
  <script type="text/javascript" src="https://js.stripe.com/v1/"></script>
<script type="text/javascript">
    var stripe_publish_key = "<?php echo $stripe_publish_key?>";
   // var stripe_publish_key = "<?php echo $stripe_publish_key_usd?>";
   
          Stripe.setPublishableKey(stripe_publish_key);
            $(document).ready(function() {
                
                    $(".card-number").live("change",function() {           
                        $(".card-number-cl").find('div').html('');
                    });
                    $(".card-cvc").live("change",function() {           
                        $(".card-cvc-cl").find('div').html('');
                    });
                    
                    $(".currency-stripe").live("change",function() {
                        var currency = $(this).val();
                       
                        stripe_publish_key = "<?php echo $stripe_publish_key?>";                  
                        if(currency == "usd") {
                            stripe_publish_key = "<?php echo $stripe_publish_key_usd?>";
                        } else {
                            stripe_publish_key = "<?php echo $stripe_publish_key?>";                           
                        }
                        
                        Stripe.setPublishableKey(stripe_publish_key);
                       // alert(11);

                    });

                function addInputNames() {
    				
                    $(".card-number").attr("name", "card-number")
                    $(".card-cvc").attr("name", "card-cvc")
                    $(".card-expiry-year").attr("name", "card-expiry-year")
                }

                function removeInputNames() {
                    $(".card-number").removeAttr("name")
                    $(".card-cvc").removeAttr("name")
                    $(".card-expiry-year").removeAttr("name")
                }

                function submit(form) {
                    // remove the input field names for security
                    // we do this *before* anything else which might throw an exception
                    removeInputNames(); // THIS IS IMPORTANT!

                    // given a valid form, submit the payment details to stripe
                    $(form['submit-button']).attr("disabled", "disabled")
                    $("#stripeloader").show();
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(), 
                        exp_year: $('.card-expiry-year').val()
                    }, function(status, response) {
                        if (response.error) {
                            // re-enable the submit button
                            $(form['submit-button']).removeAttr("disabled")
        
                            // show the error
                            $(".payment-errors").html(response.error.message);
                            $("#stripeloader").hide();
                            // we add these names back in so we can revalidate properly
                            addInputNames();
                        } else {
                            // token contains id, last4, and card type
                            var token = response['id'];

                            // insert the stripe token
                            var input = $("<input name='stripeToken' value='" + token + "' style='display:none;' />");
                            form.appendChild(input[0])
                            needToConfirm = false; 
                            // and submit
                            form.submit();
                        }
                    });
                    
                    return false;
                }
                
            $('#amount').live("keypress", function (e) {
                
                if (e.which != 8 && e.which != 0 && ((e.which < 48 || e.which > 57) )) {  //&& e.which != 46
                    e.preventDefault();
                }
            });


                // add custom rules for credit card validating
                jQuery.validator.addMethod("cardNumber", Stripe.validateCardNumber, "Please enter a valid card number");
                jQuery.validator.addMethod("cardCVC", Stripe.validateCVC, "Please enter a valid security code");
                jQuery.validator.addMethod("cardExpiry", function() {
                    return Stripe.validateExpiry($(".card-expiry-month").val(), 
                                                 $(".card-expiry-year").val())
                }, "Please enter a valid expiration");

                // We use the jQuery validate plugin to validate required params on submit
                $("#example-form").validate({
                    submitHandler: submit,
                    rules: {
                        "card-cvc" : {
                            cardCVC: true,
                            required: true
                        },
                        "card-number" : {                         
                            required: true
                        },
                        "card-expiry-year" : "cardExpiry" // we don't validate month separately
                    }
                });

                // adding the input field names is the last step, in case an earlier step errors                
                addInputNames();
            });
        </script>