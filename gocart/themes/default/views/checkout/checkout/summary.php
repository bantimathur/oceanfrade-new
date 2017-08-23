<div class="card-box">
                           <table width="100%" cellpadding="0" cellspacing="0" class="cart-box">
                           	<thead>
                              <tr>
                                 <th width="10%" align="left" valign="top">&nbsp;</th>
                                 <th width="36%" align="left" valign="top">Item</th>                                 
                                 <th width="16%" align="center" valign="top">Price</th>
                                 <th width="21%" align="left" valign="top">Delivery Details</th>
                                 <th width="5%" align="center" valign="top">Qty</th>
                                 <th width="12%" align="right" valign="top">Total</th>
                              </tr>
                            </thead>
							<tbody>  
                            	<?php
									$subtotal = 0;                  
									foreach ($this->go_cart->contents() as $cartkey=>$product):?>

                
                              <tr>
                                 <td align="left" valign="middle">
                                 	<a href="#"><img style='width:86px;' src="<?=getProductImage($product['images'],'small')?>" alt="HP 7 Plus  "></a>
                                 </td>
                                 <td align="left" valign="middle">
                                 	<?php echo $product['sku']; ?>
                                    <p><?php echo $product['name']; ?></p>
                                    <p class="move-wishlist">
                                    	<a class='product-add-to-wishlist' href="<?=base_url('add_to_wishlist')?>" data-product_id='<?=$product['id']?>'>MOVE TO WISHLIST</a>&nbsp;&nbsp;.&nbsp;&nbsp;
                                      <a href='javascript:;' onclick="if(confirm('<?php echo lang('remove_item');?>')){window.location='<?php echo site_url('cart/remove_item/'.$cartkey);?>';}">REMOVE</a>
                                    </p>
                                 </td>
                                 <td align="center" valign="middle">
                                 	<span class="price"><?php echo format_currency($product['price']);?></span>
                                 </td>
                                 <td align="left" valign="middle">
										<?php echo $product['excerpt'];
										if(isset($product['options'])) {
											foreach ($product['options'] as $name=>$value)
											{
												if(is_array($value))
												{
													echo '<div><span class="gc_option_name">'.$name.':</span><br/>';
													foreach($value as $item)
														echo '- '.$item.'<br/>';
													echo '</div>';
												} 
												else 
												{
													echo '<div><span class="gc_option_name">'.$name.':</span> '.$value.'</div>';
												}
											}
										}
										?>
                                 </td>
                                 <td align="center" valign="middle">
                                 	<?php if($this->uri->segment(1) == 'cart'): ?>
									<?php if(!(bool)$product['fixed_quantity']):?>
										<div class="control-group">
											<div class="controls">
												<div class="input-append">
													<input class="span1 cart-qty" style="width:30px;" name="cartkey[<?php echo $cartkey;?>]"  value="<?php echo $product['quantity'] ?>" size="3" type="text">                          
												</div>
											</div>
										</div>
									<?php else:?>
										<input tyle="text" readonly style='width:30px;'class='cart-qty' value='<?php echo $product['quantity'] ?>'/>
										<input type="hidden" name="cartkey[<?php echo $cartkey;?>]" value="1"/>										
									<?php endif;?>
								<?php else: ?>
									<?php echo $product['quantity'] ?>
								<?php endif;?>
                                 </td>
                                 <td width="12%" align="right" valign="middle">
                                 	<span class="price">
                                 		<?php echo format_currency($product['price']*$product['quantity']); ?>
                                 	</span> 
                                 </td>
                              </tr>
                            <?php endforeach;?>                             
                          </tbody>
                           </table>
		<div class="grand-total">
                                <div class="all-total"><?php echo lang('subtotal');?> : <span><?php echo format_currency($this->go_cart->subtotal()); ?></span></div>
                              </div>
                              <?php if($this->go_cart->shipping_cost()>0){?>
                              <div class="grand-total">
                                <div class="all-total">
                                  Shipping Amount : 
                                  <span>
                                    <?php echo format_currency($this->go_cart->shipping_cost()); ?>
                                  </span>
                                </div>
                              </div>
                              <?php }?>
                              <div class="grand-total">
                                <div class="all-total"><?php echo lang('grand_total');?> : <span><?php echo format_currency($this->go_cart->total()); ?></span></div>
                              </div>
								 
                              <?php if(@$noaction!='noaction'){?>
                           <div class="place-order">
                              <div class="check-available">
                                <input class="check-input" name="" type="text" value="Enter your Pincode">
                                <input name="" type="button" value="CHECK" class="check-button">
                              </div>
        
                              <input id="redirect_path" type="hidden" name="redirect" value=""/>

    

            
        

                              
                              <div class="continue-order">
                                <input class="btn" type="submit" value="<?php echo lang('form_update_cart');?>"/>
                                <a class="btn continue-btn" href="<?=base_url()?>">Continue Shopping</a>
                            
<?php if(!$this->Customer_model->is_logged_in(false,false)): ?>
<input class="btn place-order-btn" type="submit" onclick="$('#redirect_path').val('checkout/login');" value="Place Order"/>
<?php endif; ?>
<?php if ($this->Customer_model->is_logged_in(false,false) ): ?>
<input class="btn place-order-btn" type="submit" onclick="$('#redirect_path').val('checkout');" value="Place Order"/>
<?php endif; ?>
                              </div>
                             
                              <div class="fclear"> </div>
                           </div>
                            <?php }?>
                        </div>

	 