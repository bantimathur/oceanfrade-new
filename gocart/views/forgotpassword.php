 <?php echo theme_css('msdropdown/flags.css', true);?>

  <?php echo theme_css('msdropdown/dd.css', true);?>
    <?php echo theme_css('fancybox/jquery.fancybox.css', true);?>
<?php echo theme_js('msdropdown/jquery.dd.js', true);?>

<!--<script src="http://www.marghoobsuleman.com/mywork/jcomponents/image-dropdown/samples/js/msdropdown/jquery.dd.js"></script> -->
<?php echo theme_js('fancybox/jquery.fancybox.js', true);?>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.09/jquery.form.js"></script> -->
<?php echo theme_js('forgot.js', true);?>
<div class="main-container">
 <div class="fix-content">
  <div class="content-main">
 <?php $msg = $this->session->flashdata('message');?>
<?php if( $msg != '') { ?>
	<div class="flash-message"><?php echo $msg;?></div>
<?php } ?>
<div class="lcl-form w96" >
	<div class="login-info">
				<h1>Forgot Password</h1>
	<form name="frmlogin" id="frmlogin" action="<?php echo $this->config->site_url()?>secure/forgotpassword_action"  method="post">
					
			<div class="form-row">
					<div class="form-label">
						<input name="email" id="email" type="text" placeholder="Enter Email" tabindex="16">					
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


