<?php if ($this->go_cart->total_items()==0) { ?>
<?php include('checkout/nocart.php');?>
<?php } else { ?>
<div class="fix-content">
               <div class="content-main">
                  <div class="grid-listing">
                     <div class="edit-profile">
                        <?php if ($this->go_cart->total_items()==0):?>
                            <div class="alert alert-info">
                            <a class="close" data-dismiss="alert">×</a>
                                <?php echo lang('empty_view_cart');?>
                            </div>
                        <?php else: ?>

                        <h3 class="new">Cart <span>(<?php echo $this->go_cart->total_items();?>)</span></h3>
                        <?php echo form_open('cart/update_cart', array('id'=>'update_cart_form'));?>
                           <?php include('checkout/summary.php');?>
                     </div>
                  </div>
                  <div class="clear"></div>
               </div>
            </div>
<?php endif; ?>
 </div>
  </div>
  <div class="clearfix"></div>
 </div>
<?php } ?>