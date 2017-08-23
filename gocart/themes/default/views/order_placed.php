<div class="fix-content">
               <div class="content-main">
<br><br>
<div class="page-header">
	<h2><?php echo lang('order_number');?>: <?php echo $order_id;?></h2>
</div>

<?php
// content defined in canned messages
echo $download_section;
?>

<div class="row">
	<div class="span4">
		<h3><?php echo lang('account_information');?></h3>
		<p>
		<?php echo (!empty($customer['company']))?$customer['company'].'<br/>':'';?>
		<b><?php echo $customer['firstname'];?> <?php echo $customer['lastname'];?></b><br/>
		<?php echo $customer['email'];?> <br/>
		<?php echo $customer['phone'];?>
		</p>
	</div>
	<?php
	$ship = $customer['ship_address'];
	$bill = $customer['bill_address'];
	?>
	<div class="span4">
		<h3><?php echo ($ship != $bill)?lang('shipping_information'):lang('shipping_and_billing');?></h3>

		<p>
		<?php echo format_address($ship, TRUE);?><br/>
		<?php echo $ship['email'];?><br/>
		<?php echo $ship['phone'];?>
		</p>
	</div>
	<?php if($ship != $bill):?>
	<div class="span4">
		<h3><?php echo lang('billing_information');?></h3>
		<p>
		<?php echo format_address($bill, TRUE);?><br/>
		<?php echo $bill['email'];?><br/>
		<?php echo $bill['phone'];?>
		</p>
	</div>
	<?php endif;?>
	<div class='clear clearfix'></div>
</div>

<div class="row">
	<div class="span4">
		<h3><?php echo lang('additional_details');?></h3>
		<p>
		<?php
		if(!empty($referral)):?>
		
			<strong><?php echo lang('heard_about');?></strong> <?php echo $referral;?>
		
		<?php endif;?>
		<?php if(!empty($shipping_notes)):?>
		
			<strong><?php echo lang('shipping_instructions');?></strong> 
			<?php echo $shipping_notes;?>
		
		<?php endif;?>
		</p>
	</div>

	<div class="span4">
		<h3 style="padding-top:10px;"><?php echo lang('shipping_method');?></h3>
		<p>
			<b><?php echo $shipping['method']; ?></b> based on country.
			<?php echo format_currency($go_cart['shipping_cost']); ?>
		</p>
	</div>
	
	<div class="span4">
		<h3><?php echo lang('payment_information');?></h3>
		<p>
			<?php 
			 if($payment['module']=='payumoney'){ ?>
			 	<?=$payment['description']?>
			 	<img src='<?=base_url("gocart/themes/default/assets/images/payumoney.jpg")?>'>
			 <?php }else{ ?>
			 	<?=$payment['description']?>
			 	<img src='<?=base_url("gocart/themes/default/assets/images/secure-paypal-logo.jpg")?>'>
			 <?php }?>
		<?php ?>		
		</p>
	</div>
	<div class='clear clearfix'></div>
</div>
<br>
<table class="table table-bordered table-striped cart-box" style="margin-top:20px;">
	<thead>
		<tr>
			<th style="width:10%;"><?php echo lang('sku');?></th>
			<th style="width:20%;"><?php echo lang('name');?></th>
			<th style="width:10%;"><?php echo lang('price');?></th>
			<th><?php echo lang('description');?></th>
			<th style="width:10%;"><?php echo lang('quantity');?></th>
			<th style="width:8%;"><?php echo lang('totals');?></th>
		</tr>
	</thead>
	
	<tfoot>
		<?php if($go_cart['group_discount'] > 0)  : ?> 
		<tr>
			<td colspan="5"><strong><?php echo lang('group_discount');?></strong></td>
			<td><?php echo format_currency(0-$go_cart['group_discount']); ?></td>
		</tr>
		<?php endif; ?>

		<tr>
			<td colspan="5"><strong><?php echo lang('subtotal');?></strong></td>
			<td><?php echo format_currency($go_cart['subtotal']); ?></td>
		</tr>
		
		<?php if($go_cart['coupon_discount'] > 0)  : ?> 
		<tr>
			<td colspan="5"><strong><?php echo lang('coupon_discount');?></strong></td>
			<td><?php echo format_currency(0-$go_cart['coupon_discount']); ?></td>
		</tr>

		<?php if($go_cart['order_tax'] != 0) : // Only show a discount subtotal if we still have taxes to add (to show what the tax is calculated from) ?> 
		<tr>
			<td colspan="5"><strong><?php echo lang('discounted_subtotal');?></strong></td>
			<td><?php echo format_currency($go_cart['discounted_subtotal']); ?></td>
		</tr>
		<?php endif;

		endif; ?>
		<?php // Show shipping cost if added before taxes
		if($this->config->item('tax_shipping') && $go_cart['shipping_cost']>0) : ?>
		<tr>
			<td colspan="5"><strong><?php echo lang('shipping');?></strong></td>
			<td><?php echo format_currency($go_cart['shipping_cost']); ?></td>
		</tr>
		<?php endif ?>
		
		<?php if($go_cart['order_tax'] != 0) : ?> 
		<tr>
			<td colspan="5"><strong><?php echo lang('taxes');?></strong></td>
			<td><?php echo format_currency($go_cart['order_tax']); ?></td>
		</tr>
		<?php endif;?>
		
		<?php // Show shipping cost if added after taxes
		if(!$this->config->item('tax_shipping') && $go_cart['shipping_cost']>0) : ?>
		<tr>
			<td colspan="5"><strong><?php echo lang('shipping');?></strong></td>
			<td><?php echo format_currency($go_cart['shipping_cost']); ?></td>
		</tr>
		<?php endif;?>
		
		<?php if($go_cart['gift_card_discount'] != 0) : ?> 
		<tr>
			<td colspan="5"><strong><?php echo lang('gift_card');?></strong></td>
			<td><?php echo format_currency(0-$go_cart['gift_card_discount']); ?></td>
		</tr>
		<?php endif;?>
		<tr> 
			<td colspan="5"><strong><?php echo lang('grand_total');?></strong></td>
			<td><?php echo format_currency($go_cart['total']); ?></td>
		</tr>
	</tfoot>

	<tbody>
	<?php
	$subtotal = 0;
	foreach ($go_cart['contents'] as $cartkey=>$product):?>
		<tr>
			<td><?php echo $product['sku'];?></td>
			<td><?php echo $product['name']; ?></td>
			<td><?php echo format_currency($product['price']);   ?></td>
			<td><?php echo $product['excerpt'];
				if(isset($product['options'])) {
					foreach ($product['options'] as $name=>$value)
					{
						if(is_array($value))
						{
							echo '<div><span class="gc_option_name">'.$name.':</span><br/>';
							foreach($value as $item)
								echo '- '.$item.'<br/>';
							echo '</div>';
						} 
						else 
						{
							echo '<div><span class="gc_option_name">'.$name.':</span> '.$value.'</div>';
						}
					}
				}
				?></td>
			<td><?php echo $product['quantity'];?></td>
			<td><?php echo format_currency($product['price']*$product['quantity']); ?></td>
		</tr>
			
	<?php endforeach; ?>
	</tbody>
</table><br><br><br><br><br>
<style type="text/css">
.row .span4{    
	width: 30%;
    float: left;
    margin-right: 3%;
    margin-top: 37px;
    min-height: 196px;
    border: 1px solid #ccc;}
.row .span4 h3{    background: #eee;
    color: #000;
    text-align: center;
    padding: 5px;
    height: 31px;
    border-bottom: 1px solid #ccc;}
.row .span4 p{    line-height: 1.5em;
    color: #666;
    padding: 10px;
    font-size: 14px;}
</style>
</div>
</div>