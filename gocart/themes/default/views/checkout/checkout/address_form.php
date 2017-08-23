<style type="text/css">
	.placeholder {
		display:none;
	}
</style>
<!-- <div class="page-header">
	<h2><?php echo lang('form_checkout');?></h2>
</div> -->

<?php if (validation_errors()):?>
	<div class="fix-content msg-box">
    <div class="alert alert-error">
		<a class="close" data-dismiss="alert">×</a>
		<?php echo validation_errors();?>
	</div></div>
<?php endif;?>

<script type="text/javascript">
	$(document).ready(function(){
		
		//if we support placeholder text, remove all the labels
		if(!supports_placeholder())
		{
			$('.placeholder').show();
		}
		
		<?php
		// Restore previous selection, if we are on a validation page reload
		$zone_id = set_value('zone_id');

		echo "\$('#zone_id').val($zone_id);\n";
		?>
	});
	
	function supports_placeholder()
	{
		return 'placeholder' in document.createElement('input');
	}
</script>



<script type="text/javascript">
$(document).ready(function() {
	$('#country_id').change(function(){
		populate_zone_menu();
	});	


	$(".address-detail.active .choose_address").trigger('click');

});
// context is ship or bill
function populate_zone_menu(value)
{
	$.post('<?php echo site_url('locations/get_zone_menu');?>',{id:$('#country_id').val()}, function(data) {
		$('#zone_id').html(data);
	});
}
</script>
<?php /* Only show this javascript if the user is logged in */ ?>
<?php if($this->Customer_model->is_logged_in(false, false)) : ?>
<script type="text/javascript">	
	<?php
	$add_list = array();
	foreach($customer_addresses as $row) {
		// build a new array
		$add_list[$row['id']] = $row['field_data'];
	}
	$add_list = json_encode($add_list);
	echo "eval(addresses=$add_list);";
	?>
		
	function populate_address(address_id)
	{
		if(address_id == '')
		{
			return;
		}
		
		// - populate the fields
		$.each(addresses[address_id], function(key, value){
			
			$('.address[name='+key+']').val(value);

			// repopulate the zone menu and set the right value if we change the country
			if(key=='zone_id')
			{
				zone_id = value;
			}
		});
		
		// repopulate the zone list, set the right value, then copy all to billing
		$.post('<?php echo site_url('locations/get_zone_menu');?>',{id:$('#country_id').val()}, function(data) {
			$('#zone_id').html(data);
			$('#zone_id').val(zone_id);

			$(".address-detail form").submit();
		});		
	}
	
</script>
<?php endif;?>

<?php
$countries = $this->Location_model->get_countries_menu();

if(!empty($customer[$address_form_prefix.'_address']['country_id']))
{
	$zone_menu	= $this->Location_model->get_zones_menu($customer[$address_form_prefix.'_address']['country_id']);
}
else
{
	$zone_menu = array(''=>'')+$this->Location_model->get_zones_menu(array_shift(array_keys($countries)));
}

//form elements

$company	= array('placeholder'=>lang('address_company'),'class'=>'address span8', 'name'=>'company', 'value'=> set_value('company', @$customer[$address_form_prefix.'_address']['company']));
$address1	= array('placeholder'=>lang('address1'), 'class'=>'address span8', 'name'=>'address1', 'value'=> set_value('address1', @$customer[$address_form_prefix.'_address']['address1']));
$address2	= array('placeholder'=>lang('address2'), 'class'=>'address span8', 'name'=>'address2', 'value'=>  set_value('address2', @$customer[$address_form_prefix.'_address']['address2']));
$first		= array('placeholder'=>lang('address_firstname'), 'class'=>'address span4', 'name'=>'firstname', 'value'=>  set_value('firstname', @$customer[$address_form_prefix.'_address']['firstname']));
$last		= array('placeholder'=>lang('address_lastname'), 'class'=>'address span4', 'name'=>'lastname', 'value'=>  set_value('lastname', @$customer[$address_form_prefix.'_address']['lastname']));
$email		= array('placeholder'=>lang('address_email'), 'class'=>'address span4', 'name'=>'email', 'value'=> set_value('email', @$customer[$address_form_prefix.'_address']['email']));
$phone		= array('placeholder'=>lang('address_phone'), 'class'=>'address span4', 'name'=>'phone', 'value'=> set_value('phone', @$customer[$address_form_prefix.'_address']['phone']));
$city		= array('placeholder'=>lang('address_city'), 'class'=>'address span3', 'name'=>'city', 'value'=> set_value('city', @$customer[$address_form_prefix.'_address']['city']));
$zip		= array('placeholder'=>lang('address_zip'), 'maxlength'=>'10', 'class'=>'address span2', 'name'=>'zip', 'value'=> set_value('zip', @$customer[$address_form_prefix.'_address']['zip']));


?>
	<div class="fix-content">
      <div class="content-main">
        <div class="checkout">
              <div class="checkout-heading topbor">
              	<span class="right-sign">1. Login</span><span class="email-name"><?php echo $this->session->userdata('vName')?></span>
              	<div class="clearfix"></div>
              </div>
              <div class="checkout-box">
            <div class="heading bottbor">2. Delivery Address 
            	<?php if(count($customer_addresses)>0) {?>
            	<a href="#" class="btn add-address">+&nbsp;&nbsp;Add New Address</a>
            	<?php }?>
            </div>
              <div class="address-change">
              	<ul style='width:100%;'>
              	

            <?php
			$c = 1;
			foreach($customer_addresses as $a): $b	= $a['field_data']; ?>

				<li><div class="address-detail <?=$c==1?"":''?>">
						<h3><?=strtoupper($b['firstname'].' '.$b['lastname'])?> </h3>
						<p>
						<?php						
						echo nl2br(format_address($b));
						?>
						</p>
						<p><?=$b['phone']?></p>
						<p class="lastbor">
							<a href="javascript:;"  onclick="populate_address(<?php echo $a['id'];?>);"   class="btn continue-btn choose_address">Deliver Here</a>							
						</p>
						
				</div>
				</li>
			<?php $c++; endforeach;?>

                    <li id='add_edit_address_form' class='<?=count($customer_addresses)>0?"notshow":''?>' style='width:550px;'>
              		<div class='address-detail address-add'>
              			<?php
	//post to the correct place.
	echo ($address_form_prefix == 'bill')?form_open('checkout/step_1'):form_open('checkout/shipping_address');?>
		<div class="row">
			<?php // Address form ?>
			<div class="span8">								 
				<h3><?php echo ($address_form_prefix == 'bill')?lang('address'):lang('shipping_address');?></h3>				
				<br> 
				<div class="row">
					<div class="span4">
						<label class="placeholder"><?php echo lang('address_firstname');?><b class="r"> *</b></label>
						<?php echo form_input($first);?>
					</div>
					<div class="span4">
						<label class="placeholder"><?php echo lang('address_lastname');?><b class="r"> *</b></label>
						<?php echo form_input($last);?>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="row">
					<div class="span4">
						<label class="placeholder"><?php echo lang('address_email');?><b class="r"> *</b></label>
						<?php echo form_input($email);?>
					</div>

					<div class="span4">
						<label class="placeholder"><?php echo lang('address_phone');?><b class="r"> *</b></label>
						<?php echo form_input($phone);?>
					</div>
					<div class="clearfix"></div>
				</div>

				

				<div class="row">
					<div class="span8">
						<label class="placeholder"><?php echo lang('address1');?><b class="r"> *</b></label>
						<?php echo form_input($address1);?>
					</div>
				</div>
				
				<div class="row">
					<div class="span8">
						<label class="placeholder"><?php echo lang('address2');?></label>
						<?php echo form_input($address2);?>
					</div>
				</div>
				<div class="row">
					<div class="span8">
						<label class="placeholder"><?php echo lang('address_country');?><b class="r"> *</b></label>
						<?php echo form_dropdown('country_id',$countries, @$customer[$address_form_prefix.'_address']['country_id'], 'id="country_id" class="address span8"');?>
					</div>
				</div>
				<div class="row">
					
                    <div class="span3 mar">
						<label class="placeholder"><?php echo lang('address_state');?><b class="r"> *</b></label>
						<?php 
							echo form_dropdown('zone_id',$zone_menu, @$customer[$address_form_prefix.'_address']['zone_id'], 'id="zone_id" class="address span3" ');?>
					</div>
                    <div class="span3 mar">
						<label class="placeholder"><?php echo lang('address_city');?><b class="r"> *</b></label>
						<?php echo form_input($city);?>
					</div>
					
					<div class="span3">
						<label class="placeholder"><?php echo lang('address_zip');?><b class="r"> *</b></label>
						<?php echo form_input($zip);?>
					</div>
					<div class="clearfix"></div>
				</div>
				<?php if($address_form_prefix=='bill') : ?>
				<div class="row">
					<div class="span8">
						<label class="checkbox inline" for="use_shipping">
						<?php echo form_checkbox(array('name'=>'use_shipping', 'value'=>'yes', 'id'=>'use_shipping', 'checked'=>$use_shipping)) ?>
						<?php echo lang('ship_to_address') ?>
						</label>
					</div>
					<div class="clearfix"></div>
				</div><br>
				<?php endif ?>

				<div class="row">
						<?php if($address_form_prefix=='ship') : ?>
						<input class="btn place-order-btn" style="width:100%;" type="button" value="<?php echo lang('form_previous');?>" onclick="window.location='<?php echo base_url('checkout/step_1') ?>'"/>
						<?php endif; ?>
						<input class="btn place-order-btn" style="width:100%;" type="submit" value="<?php echo lang('form_continue');?>"/>
				</div>
			</div>
		</div>
	</form>

              		</div>
              	</li>
      
 
              </ul></div>
              </div>
              
              <div class="checkout-heading"><a href="#">3. Order Summary    <?=$this->go_cart->total_items()?> items</a></div>
              <div class="checkout-heading"><a href="#">4. Payment Method </a></div>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
	
 



<style type="text/css">
.row div.span4{ float: left; width: 48%;}
.row div.span3{ float: left; width: 30%;}
.row>div.span3.mar{margin-right: 4%;}
.row div.span4:first-child{margin-right: 4%;}
.row div.span3>select,.row div.span3>input,.row div.span8>select, .row div.span8>input,.row div.span4>input{    margin: 0px;
    border: 1px solid #ADA6A6;
    background: #FFF;
    font-size: 16px;
    color: #000;
    padding: 10px;
    font-family: 'Roboto Slab', serif;
    font-weight: 300;
    margin-bottom: 10px;
    outline: none;    
    width: 89%;

}
.row div.span8>select, .row .span8>input{width: 95% !important;color:#000;}
.row div.span8  select{width:100% !important;}
#add_edit_address_form.notshow{position: absolute;left: -600px;}
</style>