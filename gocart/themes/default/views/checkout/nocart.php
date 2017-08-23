
<div class="fix-content">
  <div class="content-main">

<div class="grid-listing">
  <div class="edit-profile" style="min-height:200px;">
    <h3 class="new">Cart <span>(0)</span></h3>
    <div class="card-box">
  	<div class="no-cart-txt"><img src="<?=base_url("gocart/themes/default/assets/images")?>/cart-icon-bix.png" alt="">There are no items in this cart.</div> </div>
  </div>
  <div class="no-cart">
   <div class="bro-categories">Browse Categories</div> 
  <div class="pro-category">
        <ul>
         <?php foreach($this->categories[0] as $cat_menu):?>
		<li <?php echo $cat_menu->active ? 'class="active"' : false; ?>><a href="<?php echo site_url($cat_menu->slug);?>"><?php echo $cat_menu->name;?></a></li>
		<?php endforeach;?>
        </ul>
  <div class="clear"></div>
      </div></div>
  <div class="top-secure secure-box">
        <ul class="unit trust-banners">
          <li>
          <span class="fleft big-secure-icon">&nbsp;</span><span class="fright">Secure<br>
<em>Payments</em></span>
          </li>
          <li>
          <span class="fleft big-original-product-icon">&nbsp;</span><span class="fright">Original<br>
<em>Products</em></span>
          </li>
          <li>
          <span class="fleft big-free-easy-icon">&nbsp;</span><span class="fright">Free &amp; easy<br>
<em>Returns</em>
</span>
          </li>
          <li>
          <span class="fleft big-buyer-ico">&nbsp;</span><span class="fright">100% buyer<br>
<em>protection</em></span>
          </li>
        </ul>
        <div class="cls"></div>
      </div>
  </div>
  <div class="clear"></div>
</div>
  </div>
    <div class="clearfix"></div>
 </div>
 <div class="clearfix"></div>