<style>
.regbtn { width: auto !important; margin-right: 0px; }
</style>
<?php echo theme_css('msdropdown/flags.css', true);?><?php echo theme_css('msdropdown/dd.css', true);?><?php echo theme_css('fancybox/jquery.fancybox.css', true);?><?php echo theme_js('msdropdown/jquery.dd.js', true);?>

<!--<script src="http://www.marghoobsuleman.com/mywork/jcomponents/image-dropdown/samples/js/msdropdown/jquery.dd.js"></script> -->
<?php echo theme_js('fancybox/jquery.fancybox.js', true);?>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.09/jquery.form.js"></script> -->
<?php echo theme_js('register.js', true);?>
<div class="main-container">
  <div class="fix-content">
    <div class="content-main">
      <div class="lcl-form w96" >
        <div class="login-info">
          <div class="reg-left">
            <h1>Register</h1>
            <form name="frmregister" id="frmregister" action="<?php echo $this->config->site_url()?>secure/register_action"  method="post">
              <div class="form-row"> 
                <!--<div class="form-date modallb __web-inspector-hide-shortcut__">
			<label>UserName/Email :</label>
			<div class="label-txt">
			 <input name="username" id="username" type="text" value="" maxlength="30">
			  <div id="usernameErr"></div>
			</div>
			<div class="clear"></div>
        </div> -->
                <div class="form-date modallb __web-inspector-hide-shortcut__">
                  <label>Email id :</label>
                  <div class="label-txt">
                    <input name="email" id="email" type="text" value="">
                    <div id="emailErr"></div>
                  </div>
                  <div class="clear"></div>
                </div>
                <div class="form-date modallb __web-inspector-hide-shortcut__">
                  <label>Password :</label>
                  <div class="label-txt">
                    <input name="password" id="password" type="password" value="" maxlength="8">
                    <div id="passwordErr"></div>
                  </div>
                  <div class="clear"></div>
                </div>
                <div class="form-date modallb __web-inspector-hide-shortcut__">
                  <label>Phone Number :</label>
                  <div class="label-txt">
                    <input name="phonenumber" id="phonenumber" type="text" value="">
                    <div id="phonenumberErr"></div>
                  </div>
                  <div class="clear"></div>
                </div>
                <div class="form-date modallb __web-inspector-hide-shortcut__">
                  <label>Business Name :</label>
                  <div class="label-txt">
                    <input name="buisenessname" id="buisenessname" type="text" value="" >
                    <div id="buisenessnameErr"></div>
                  </div>
                  <div class="clear"></div>
                </div>
                <div class="form-date modallb __web-inspector-hide-shortcut__">
                  <label>Name :</label>
                  <div class="label-txt">
                    <input name="name" id="name" type="text" value="">
                    <div id="nameErr"></div>
                  </div>
                  <div class="clear"></div>
                </div>
                <!--<div class="form-date modallb __web-inspector-hide-shortcut__">
			<label>Secret Code :</label>
			<div class="label-txt">
			 <input name="scode" id="scode" type="password" value="">
			  <div id="nameErr"></div>
			</div>
			<div class="clear"></div>
        </div> -->
                <div class="form-btn pad2" align="center">
                  <input type="button" name="register" id="register" value="Submit" class="submit-btn regbtn" style="float:left;">
                  <input type="button" name="reset" id="reset" value="Reset" class="submit-btn regbtn" style="float:left;">
                </div>
                <div class="form-date modallb __web-inspector-hide-shortcut__"></div>
              </div>
            </form>
          </div>
          <div class="reg-right"> <img src="<?php echo $this->config->site_url()?>images/signup.jpg"> </div>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
</div>
<script type="text/javascript">
var site_url = "<?php echo $this->config->site_url()?>";
</script>