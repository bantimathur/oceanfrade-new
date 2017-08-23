<?php
if(count($wishlist) > 0) {
for($i=0;$i<count($wishlist);$i++) {
				  $product_url = getProductLink($wishlist[$i]['slug']);

	?>
     
         <div class="wishlist">
               <div class="wishlist-thumb">
                    <a href="<?php echo $product_url?>">
                         <img class="item-image" src="<?=getProductImage($wishlist[$i]['images'],'small')?>" alt="">
                    </a> </div>
            <div class="wishlist-qty">
            <p><?php echo $wishlist[$i]['name']?></p>
            <p><strong><?php echo $wishlist[$i]['price']?></strong></p>
            <!--<p><span class="delivery-time">Delivered in 8-9 business days. [?]</span></p>-->
            </div>
            <div class="wishlist-addtocart">
               <!--<a class="btn" href="#">Add to CArt</a>-->
               <span class="addtocart">
               <a data-cartkey="<?php echo $this->session->flashdata('cartkey');?>" class='btn product-cart-link' data-product_id="<?=$wishlist[$i]['productid']?>" href="<?=base_url('cart/add_to_cart')?>">Add to Cart</a>
               </span>
            </div>
            <div class="wishlist-delivery"><a rel="<?php echo $wishlist[$i]['wishid']?>" class="cursor removefromlist" >Remove from List</a></div>
         </div>
<?php } 
} else { ?>
<p class="norecord">No Record Found</p>
<?php }
?>
     
<?php echo $links; ?>  
   
      