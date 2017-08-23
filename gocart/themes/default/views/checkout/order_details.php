<div class="checkout-heading topbor">
	<span class="right-sign">
	2. Delivery Address
</span>
<span class="address-show"> 
	<strong><?php echo $customer['bill_address']['firstname']." ".$customer['bill_address']['lastname'];?><br/></strong>&nbsp;<?php echo $customer['bill_address']['phone'];?><br/><br>
            <?php echo format_address($customer['bill_address'], true);?> </span>
            <span class="fright">
            	<a href="<?php echo site_url('checkout/step_1');?>" class="btn edit-address">
		
			<?php if($customer['bill_address'] != @$customer['ship_address'])
			{
				echo lang('billing_address_button');
			}
			else
			{
				echo lang('address_button');
			}
			?>
		</a>
             </span>
            <div class="clearfix"></div>
</div>


 
