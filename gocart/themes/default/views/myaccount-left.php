<div class="category-cont">
<div class="category-box">

<h3>My Acoount</h3><ul>
				      <li><a <?php if($this->router->fetch_method() == "orderlist")  { ?> class="active" <?php } ?> href="<?php echo $this->config->item('site_url')?>order">My Order</a></li>
				      <li><a <?php if($this->router->fetch_method() == "wishlist")  { ?> class="active" <?php } ?> href="<?php echo $this->config->item('site_url')?>wishlist">My Wishlist</a></li>
				      <li><a  <?php if($this->router->fetch_method() != "orderlist" && $this->router->fetch_method() != "wishlist" )  { ?> class="active" <?php } ?>  >Setting</a>
                      <ul>

				      <li><a  <?php if($this->router->fetch_method() == "change_password")  { ?> class="active" <?php } ?> href="<?php echo $this->config->item('site_url')?>changepassword">Change Password</a></li>
				      <li><a  <?php if($this->router->fetch_method() == "address")  { ?> class="active" <?php } ?> href="<?php echo $this->config->item('site_url')?>address">Add/Update Address</a></li>
				      <li><a <?php if($this->router->fetch_method() == "my_account")  { ?> class="active" <?php } ?> href="<?php echo $this->config->item('site_url')?>myaccount">Profile Setting</a></li>
                   
                      <li><a class="deactivate cursor" rel="<?php echo $this->config->item('site_url')?>secure/deactivate">Deative Account</a></li>
					  <li><a href="<?php echo $this->config->item('site_url')?>secure/logout">Logout</a></li>
</ul>
                      </li>
                      
				  </ul>
</div>
</div>
<script>
$(".deactivate").click(function() {
var rel = $(this).attr('rel');

 var conf = confirm("Are you sure u want to deacivate your account?");
            //alert(conf);
if(conf == true) {
	window.location.href = rel;
} else {
	return false;    
}
					  });	  
</script>