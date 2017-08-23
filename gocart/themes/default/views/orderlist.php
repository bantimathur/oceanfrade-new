<div class="fix-content">
<div class="content-main">

<?php $this->view('myaccount-left');?>
<div class="cont-middle">
    <div class="grid-listing">
     <div class="edit-profile">
      <h3>My Order</h3>
      <div id="order-section">
		
		<?php
		
	 if(count($order_arr) == 0) {  ?>
		<p class="norecord alert-heading">No Order Founds</p>
		<?php }
		foreach($order_arr as $key => $value) {
			$product_info  = $value['product_info'];
			//echo "<pre>";
		
		
			?>
			
			<div class="order-list">
				<div class="order-number"><?php echo $value['order_number'];?>
				<span style="float:right" > Order Status : <?php echo $value['status'];?></span>
				</div>
					<?php for($i=0;$i<count($product_info);$i++) { 
					//pr($product_info);
					 $product_url = getProductLink($product_info[$i]['slug']);
					$contents = unserialize($product_info[$i]['contents']);
					
					?>
						<div class="order-details <?php if(count($product_info)-1 == $i) { ?> last<?php } ?>">
							<div class="order-itme">
								<a href="<?php echo $product_url;?>">
									<img class="item-image" style="width:86px;" src="<?php echo $product_info[$i]['image']?>" alt="">
								</a>
							</div>
							<div class="order-itme-qty">
							<p><?php echo $contents['name']?></p>
							<p><span class="smalltext">Qty: <?php echo $contents['quantity']?></span></p>
							</div>
							<div class="order-itme-price"><?php echo $contents['saleprice']?></div>
							<div class="order-itme-delivery"><?php echo $value['ordered_on'];?></div>
						</div>
					<?php } ?>
					
				 <div class="order-total">
					<span class="delivered-date"<?php echo $value['ordered_on'];?></span>
					<span class="order-ammount">Order Total: <?php echo $value['total'];?></span>
					<div class="clear"></div></div>
			</div>

			
		<?php } ?>
		<?php 
			echo $orders_pagination;
		?>
      </div>
     </div>
     <div class="clear"></div>
    </div>
   </div>
</div>
<div class="clearfix"></div>
</div>
