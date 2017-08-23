 <?php echo theme_css('msdropdown/flags.css', true);?>

  <?php echo theme_css('msdropdown/dd.css', true);?>
    <?php echo theme_css('fancybox/jquery.fancybox.css', true);?>
<?php echo theme_js('msdropdown/jquery.dd.js', true);?>

<!--<script src="http://www.marghoobsuleman.com/mywork/jcomponents/image-dropdown/samples/js/msdropdown/jquery.dd.js"></script> -->
<?php echo theme_js('fancybox/jquery.fancybox.js', true);?>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.09/jquery.form.js"></script> -->
<?php echo theme_js('resetpassword.js', true);?>
<div class="main-container">
 <div class="fix-content">
  <div class="content-main">
 <?php $msg = $this->session->flashdata('message');?>
<?php if( $msg != '') { ?>
	<div class="flash-message"><?php echo $msg;?></div>
<?php } ?>
<div class="lcl-form w96" >
	<div class="login-info">
	<h1>Reset Your Password</h1>
	<form name="frmlogin" id="frmlogin" action="<?php echo $this->config->site_url()?>secure/reset_password_action"  method="post">
		<input type="hidden" name="email" id="email" value="<?php echo $email;?>"/>
		<div class="form-row">
			<div class="form-label">
				<input name="password" id="password" type="password" placeholder="Enter Password" tabindex="1">					
			 </div>					
			 <div class="clear"></div>
		</div>
		<div class="form-btn pad2">
		 <input type="button" name="login" id="login" value="Submit" class="submit-btn">
	   </div>
	</form>
	</div>
</div>
   </div>
  </div>
  <div class="clearfix"></div>
 </div>


