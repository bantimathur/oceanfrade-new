<div class="fix-content">
<div class="shopping-detail">
    <div class="item-details">
     <div class="item-heading"><?php echo $product->name?></div>

     <div class="price">USD <strong><?php echo $product->saleprice?></strong>
		<br>
		Rs. <strong><?php echo getInr($product->saleprice); ?></strong>
     </div>
     <div class="item-desc">
     <p><strong>Description</strong></p>
     <p>
        <?php echo $product->description?>
     </p>
     </div>
     <div class="cart">
        <a data-cartkey="<?php echo $this->session->flashdata('cartkey');?>" class='product-cart-link' data-product_id="<?=$product->id?>" href="<?=base_url('cart/add_to_cart')?>">Add to Cart</a>

        <a data-typeadc='buynow' data-cartkey="<?php echo $this->session->flashdata('cartkey');?>" class='product-cart-link fright' data-product_id="<?=$product->id?>" href="<?=base_url('cart/add_to_cart')?>"  >Buy Now</a>
     </div>
     </div>
    <div class="item-img">
        <img src="<?php echo base_url('uploads/images/full/'.$product->images[0]->filename)?>" width="270" height="293" alt="">
    </div>
</div>
<div class="related-products">Related Products</div>
<div class="product-list">
    <?php
    $related_products = $product->related_products;
    //pr($related_products[0]);
    ?>
    <?php if(count($related_products) > 0) { ?>
<ul>
    <?php for($i=0;$i<count($related_products);$i++) {
        $product_url = getProductLink($related_products[$i]->slug);
        ?>
        <li>
            <div class="pro-box">
                <div class="pro-thumb">
                    <a href="<? echo $product_url;?>" ><img src="<?php echo getProductImage($related_products[$i]->images,'medium')?>" alt="" /></a>
                <span class="addtocart">
                  <a data-cartkey="<?php echo $this->session->flashdata('cartkey');?>" class='product-cart-link' data-product_id="<?=$related_products[$i]->id?>" href="<?=base_url('cart/add_to_cart')?>">Add to Cart</a>
                </span>
                </div>
                <div class="pro-thumb-details">
                    <p><?php echo $related_products[$i]->name;?></p>
                    <h3>USD <strong><?php echo $related_products[$i]->saleprice;?> </strong>
					/ Rs. <strong><?php echo getInr($related_products[$i]->saleprice); ?>
					</strong>   <!--/   US <strong>$5</strong>--></h3>
                </div>
            </div>
        </li>
<?php }  ?>


</ul>
<?php } else { ?>
<p class="norecord">No Record Found</p>
<?php } ?>
</div>
<!--<div class="more-loading">loading more...</div>-->
<div class="clearfix"></div>
</div>
