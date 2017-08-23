

 <div class="fix-content">
  <div class="content-main">
<div class="checkout">
<div class="checkout-box">
<div class="heading">1. Login</div>
<?php echo form_open('secure/login', 'class="form-horizontal"'); ?>
				
				<div class="login-form">
					<div class="row-edit">
						<input name="email" type="text" placeholder="Email" >
					</div>
					<div class="row-edit">
						<input name="password" type="password" placeholder="Password">
					</div>
					<div class="row-edit">
						<input type="submit" name="submit" value="Sign In" class="btn-login" autocomplete="off" />
					</div>
					<div class="row-edit">
						<a class="forgot-password" href="<?php echo $this->config->site_url()?>forgot-password">Forgot Password ?</a>
						<a class="forgot-password" href="<?php echo $this->config->site_url()?>register">Sign Up</a>
					</div>
				</div>
				<input type="hidden" value="<?php echo $redirect; ?>" name="redirect"/>
				<input type="hidden" value="submitted" name="submitted"/>
				
			</form>
</div>
<?php if($redirect=='checkout'):?>
<div class="checkout-heading"><a href="#">2. Delivery Address</a></div>
<div class="checkout-heading"><a href="#">3. Order Summary    2 items</a></div>
<div class="checkout-heading"><a href="#">4. Payment Method</a></div>
<?php endif;?>
   </div>
  </div>
  <div class="clearfix"></div>
 </div>


