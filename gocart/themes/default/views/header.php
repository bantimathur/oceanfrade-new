<!DOCTYPE html>
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo $this->config->site_url();?>images/favicon.ico">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php if(trim($seo_title) == '') { ?>
<title>Instant LCL Quote solutions for all your shipping needs</title>
<?php }  else { ?>
<title><?php echo $seo_title;?></title>
<?php } ?>
<?php if(trim($keywords) == '') { ?>
<meta name="keywords" content="Ocean Freight, Ocean Freight Consolidation, Ocean Freight  Shipping, LCL Freight Shipping, LCL Consolidation, LCL Freight, LCL Ocean Shipping, Personal Effects,Ocean Freight Worldwide, Ocean Freight Shipping, Shipping to, Cheap Shipping to word wide, Door to Door Delivery">
<?php }  else { ?>
<meta name="keywords" content="<?php echo $seo_keywords;?>">
<?php } ?>
<?php if(trim($meta) == '') { ?>
<meta name="description" content="Ocean shiping from Toronto, Montreal, Vancouver to world wide with competative prices having drop off facility.Get Instant Quate online 24/7.Get your free quote today">
<?php }  else { ?>
<meta name="description" content="<?php echo $meta;?>">
<?php } ?>
<?php echo theme_css('bootstrap.min.css', true);?>
<?php #echo theme_css('bootstrap-responsive.min.css', true);?>
<?php  echo theme_css('media.css', true);?>
<?php  $p = $_GET['p'];?>
<?php
if($p == 1) {
	 echo theme_css('style_black.css', true);
} else if($p == 2) {
	 echo theme_css('style.css', true);
} else {
	 echo theme_css('style_new.css', true);
}
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script type="text/javascript">
var site_url = "<?php echo $this->config->site_url();?>";
</script>
<?php echo theme_js('jquery.js', true);?><?php echo theme_js('bootstrap.min.js', true);?><?php echo theme_js('squard.js', true);?><?php echo theme_js('jquery-validation/js/jquery.validate.js', true);?><?php echo theme_js('jform.js', true);?>
<?php //echo theme_js('add_to_cart.js', true);?>
<?php //echo theme_js('equal_heights.js', true);?>
<?php echo theme_js('site.js', true);?>
<?php  echo theme_js('step2.js', true);?>
<?php  echo theme_js('havequeastion.js', true);?>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<!-- bootbox code -->

<script type="text/javascript">
$(document).ready(function(){
	//Addtocart.init();
});
</script>
<?php
//with this I can put header data in the header instead of in the body.
if(isset($additional_header_info))
{
	echo $additional_header_info;
}

?>
<script type="text/javascript"> //<![CDATA[ 
var tlJsHost = ((window.location.protocol == "https:") ? "https://secure.comodo.com/" : "http://www.trustlogo.com/");
document.write(unescape("%3Cscript src='" + tlJsHost + "trustlogo/javascript/trustlogo.js' type='text/javascript'%3E%3C/script%3E"));
//]]>
</script>
</head>

<body>
<div id="wrapper">
<?php if($header != "no") { ?>
<div class="header-part">
  <div class="logo-part">
    <div class="fix-content">
      <div class="logo"> <a href="<?php echo $this->config->site_url()?>"> <img  src="<?php echo $this->config->site_url()?>images/logo.png" alt="Ship My Freight.CA - Easy and Innovative way to Ship" class="img-respo" /></a></div>
      <div class="logo logo-flag"><img alt="Best Rate Guarantee" src="<?php echo $this->config->site_url()?>images/top-flag.jpg" /> </div>
      <div class="social-icon">
        <ul>
          <li><a href="#"><img alt="Facebook Link" src="<?php echo $this->config->site_url()?>images/fb1.png" alt=""></a></li>
          <li><a href="#"><img alt="Twitter Link" src="<?php echo $this->config->site_url()?>images/tw1.png" alt=""></a></li>
          <li><a href="#"><img alt="Skype" src="<?php echo $this->config->site_url()?>images/skype-icon.png" alt=""></a></li>
          <li><a href="#"><img alt="Google Plus" src="<?php echo $this->config->site_url()?>images/gp1.png" alt=""></a></li>
        </ul>
        <br>
        <img alt="We Accept Credit card" src="<?php echo $this->config->site_url()?>images/creditcards.png" class="card"  style="height:38px;"/> <br/>
        <?php
			  $customer = $this->session->userdata('customer');
			  $username = $customer['email'];
		  ?>
        <?php if($username != '') { ?>
        <span style="color:#0075be;"><strong>Welcome <?php echo $username;?></strong></span>
        <?php } ?>
      </div>
    </div>
  </div>
  <?php } ?>
  <?php   if($header != "no") { include('menu.php'); } ?>
  <div class="clearfix"></div>
  <?php if($header != "no") { ?>
</div>
<?php } ?>
