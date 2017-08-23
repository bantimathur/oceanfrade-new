
<div class="fix-content">

   <div class="pro-category">
        <ul>
			<li><a href="<?php echo $this->config->site_url()?>">All</a></li>
		<?php foreach($this->categories[0] as $cat_menu):?>
		<li><a  <?php echo $cat_menu->active ? 'class="active"' : false; ?> href="<?php echo site_url($cat_menu->slug);?>"><?php echo $cat_menu->name;?></a></li>
		<?php endforeach;?>
        
        </ul>
      </div>

      <div class="product-list">
        
            <?php
			if(count($products) > 0) { ?>
					<ul>
			<?php
            foreach($products as $product):
             //print_r($product);
                $photo  = theme_img('no_picture.png', lang('no_image_available'));
                $product->images    = array_values($product->images);
				  $product_url = getProductLink($product->slug);
                if(!empty($product->images[0]))
                {
                    $primary    = $product->images[0];
                    foreach($product->images as $photo)
                    {
                        if(isset($photo->primary))
                        {
                            $primary    = $photo;
                        }
                    }
    
                    $photo  = '<img src="'.base_url('uploads/images/medium/'.$primary->filename).'" alt="'.$product->seo_title.'"/>';
                }
                ?>
            
          <li>
            <div class="pro-box">
              <div class="pro-thumb"><?php echo $photo;?> <span class="addtocart">
                <a data-cartkey="<?php echo $this->session->flashdata('cartkey');?>" class='product-cart-link' data-product_id="<?=$product->product_id?>" href="<?=base_url('cart/add_to_cart')?>">Add to Cart</a></span>
			  <span class="view-more"><a href="<?php echo $product_url;?>">View More</a></span></div>
              <div class="pro-thumb-details">
                <p><?php echo $product->name ?></p>
                <!--<h3>INR Rs. <strong>315</strong> /   US <strong>$5</strong></h3>-->
                <h3>RS. <strong><?php echo $product->price ?></strong> / Rs. <strong><?php echo getInr($product->saleprice); ?> </strong> </h3>
              </div>
            </div>
          </li>
           <?php endforeach; ?>
        </ul>
       <?php } else { ?>
		 <p class="norecord">No Record Found</p>
		<? }?>
      </div>
          <div class="clearfix"></div>
         <?php echo $this->pagination->create_links();?>&nbsp;
<!--      <div class="more-loading">loading more...</div
 
      <div class="clearfix"></div>
    </div>