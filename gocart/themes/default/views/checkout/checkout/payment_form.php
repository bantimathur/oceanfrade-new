<!-- <div class="page-header">
	<h2><?php echo lang('form_checkout');?></h2>
</div> -->

<?php if (validation_errors()):?>
	<div class="fix-content msg-box"><div class="alert alert-error">
		<a class="close" data-dismiss="alert">×</a>
		<?php echo validation_errors();?>
	</div></div>
<?php endif;?>
	<div class="fix-content">
      <div class="content-main">
        <div class="checkout">
              <div class="checkout-heading topbor">
              	<span class="right-sign">1. Login</span><span class="email-name"><?php echo $this->session->userdata('vName')?></span>
              	<div class="clearfix"></div>
              </div>




<?php include('order_details.php');?>


<div class="checkout-box">
<div class="heading">3. Order Summary    <?=$this->go_cart->total_items()?> items</div>
<div class='order-summary'>
<?php 
$noaction = "noaction";
include('summary.php');?>

<!-- <div class="place-order">
	<div class="span12">
		<a class="btn btn-primary btn-large btn-block" href="<?php echo site_url('checkout/place_order');?>"><?php echo lang('submit_order');?></a>
	</div>
</div> -->
 </div>
 </div>


<div class="checkout-box">
	<div class="heading">4. <?php echo lang('payment_method');?></div>

	<div class='order-summary' style='width:50%;'>
		<div class='card-box'>
			<?php if(!$payment_methods){?>
			<div class="span3">
				<p>
					<a href="<?php echo site_url('checkout/step_3');?>" class="btn btn-block">
						<?php echo lang('billing_method_button');?>
					</a>
				</p>
				<?php echo $payment_method['description'];?>
			</div>
			<?php }?>

				<ul class="nav nav-tabs">
					<?php
					if(empty($payment_method))
					{
						$selected	= key($payment_methods);
					}
					else
					{
						$selected	= $payment_method['module'];
					}
					foreach($payment_methods as $method=>$info):?>
						<!-- <li <?php echo ($selected == $method)?'class="active"':'';?>>
							<a href="#payment-<?php echo $method;?>" data-toggle="tab">
								<?php echo $info['name'];?>
							</a>
						</li> -->
					<?php endforeach;?>
				</ul>
				<div class="tab-content">
					<?php foreach ($payment_methods as $method=>$info):?>
						<div id="payment-<?php echo $method;?>" class="tab-pane<?php echo ($selected == $method)?' active':'';?>">
							<?php echo form_open('checkout/step_3', 'id="form-'.$method.'"');?>
								<input type="hidden" name="module" value="<?php echo $method;?>" />
								<?php echo $info['form'];?>
								<input class="btn btn-block btn-large btn-primary" type="submit" value="<?php echo lang('form_continue');?> with <?php echo $info['name'];?>"/>
							</form>
						</div>
					<?php endforeach;?>
				</div>

		</div>
	</div>
</div>
 </div>       
        </div>
        </div>
	 
	 