<!-- <div class="page-header">
	<h2><?php echo lang('form_checkout');?></small></h2>
</div>
	
<?php include('order_details.php');?>
<?php include('summary.php');?>

<div class="row">
	<div class="span12">
		<a class="btn btn-primary btn-large btn-block" href="<?php echo site_url('checkout/place_order');?>"><?php echo lang('submit_order');?></a>
	</div>
</div>
 -->


	<div class="fix-content">
      <div class="content-main">
        <div class="checkout">
              <div class="checkout-heading topbor">
              	<span class="right-sign">1. Login</span><span class="email-name"><?php echo $this->session->userdata('vName')?></span>
              	<div class="clearfix"></div>
              </div>

				<?php include('order_details.php');?>
<div class="checkout-box">
<div class="heading">4. Order Summary    <?=$this->go_cart->total_items()?> items</div>
<div class='order-summary'>
<?php 
$noaction = "noaction";
include('summary.php');?>

<div class="place-order">
	<div class="span12">
		<a class="btn btn-primary btn-large btn-block" href="<?php echo site_url('checkout/place_order');?>"><?php echo lang('submit_order');?></a>
	</div>
</div>
 </div>
 </div>
 </div>       
        </div>
        </div>


