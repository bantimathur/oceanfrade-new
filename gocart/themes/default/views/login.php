 <?php echo theme_css('msdropdown/flags.css', true);?>

  <?php echo theme_css('msdropdown/dd.css', true);?>
    <?php echo theme_css('fancybox/jquery.fancybox.css', true);?>
<?php echo theme_js('msdropdown/jquery.dd.js', true);?>

<!--<script src="http://www.marghoobsuleman.com/mywork/jcomponents/image-dropdown/samples/js/msdropdown/jquery.dd.js"></script> -->
<?php echo theme_js('fancybox/jquery.fancybox.js', true);?>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.09/jquery.form.js"></script> -->
<?php echo theme_js('login.js', true);?>

<div class="main-container">
 <div class="fix-content">
  <div class="content-main">
  <div class="lcl-form w96" >
 <?php $msg = $this->session->flashdata('message');?>
<?php if( $msg != '') { ?>
	<div class="flash-message"><?php echo $msg;?></div>
<?php } ?>
<div class="login-info">
<div class="reg-left">
            <h1>Login</h1>
<form name="frmlogin" id="frmlogin" action="<?php echo $this->config->site_url()?>secure/login_action"  method="post">
				
<div class="form-row">
		<div class="form-label">
			<input name="username" id="username" type="text" placeholder="Email" tabindex="16">
			<div id="ship_firstnameErr" class="cuserr" style="text-align:left"></div>
		 </div>
		
         <div class="clear"></div>
</div>
<div class="form-row">
		<div class="form-label">
			<input name="password" id="password" type="password" placeholder="Password" tabindex="16">
			<div id="ship_firstnameErr" class="cuserr" style="text-align:left"></div>
		 </div>
		
         <div class="clear"></div>
</div>
<div class="form-btn pad2">
         
         <input type="button" name="login" id="login" value="Submit" class="submit-btn">
	
		  
       </div>
			<div class="form-btn sslink" >
		<a href="<?php echo $this->config->site_url()?>register">Sign Up</a> | <a  href="<?php echo $this->config->site_url()?>forgotpassword">Forgot Password ?</a>
		  
       </div>
				
			</form>
			</div>
<div class="reg-left">
<img src="<?php echo $this->config->site_url()?>images/login.jpg" class="contact-img" >
</div>
</div>

   </div>
  </div>
  <div class="clearfix"></div>
 </div>
 </div>


