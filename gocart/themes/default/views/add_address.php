<style type="text/css">
	.placeholder {
		display:none;
	}
</style>
<!-- <div class="page-header">
	<h2><?php echo lang('form_checkout');?></h2>
</div> -->

<?php if (validation_errors()):?>
	<div class="alert alert-error">
		<a class="close" data-dismiss="alert">×</a>
		<?php echo validation_errors();?>
	</div>
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

if(!empty($address['country_id']))
{
	$zone_menu	= $this->Location_model->get_zones_menu($address['country_id']);
}
else
{
	$zone_menu = array(''=>'')+$this->Location_model->get_zones_menu(array_shift(array_keys($countries)));
}

//form elements

$company	= array('placeholder'=>lang('address_company'),'class'=>'address span8', 'name'=>'company', 'value'=> set_value('company', @$customer[$address_form_prefix.'_address']['company']));
$address1	= array('placeholder'=>lang('address1'), 'class'=>'address span8', 'name'=>'address1', 'value'=> set_value('address1', $address['address1']));
$address2	= array('placeholder'=>lang('address2'), 'class'=>'address span8', 'name'=>'address2', 'value'=>  set_value('address2', $address['address2']));
$first		= array('placeholder'=>lang('address_firstname'), 'class'=>'address span4', 'name'=>'firstname', 'value'=>  set_value('firstname', $address['firstname']));
$last		= array('placeholder'=>lang('address_lastname'), 'class'=>'address span4', 'name'=>'lastname', 'value'=>  set_value('lastname', $address['lastname']));
$email		= array('placeholder'=>lang('address_email'), 'class'=>'address span4', 'name'=>'email', 'value'=> set_value('email', $address['email']));
$phone		= array('placeholder'=>lang('address_phone'), 'class'=>'address span4', 'name'=>'phone', 'value'=> set_value('phone', $address['phone']));
$city		= array('placeholder'=>lang('address_city'), 'class'=>'address span3', 'name'=>'city', 'value'=> set_value('city', $address['city']));
$zip		= array('placeholder'=>lang('address_zip'), 'maxlength'=>'10', 'class'=>'address span2', 'name'=>'zip', 'value'=> set_value('zip', $address['zip']));


?>
	<div class="fix-content">
      <div class="content-main">
        <div class="checkout">
              
              <div class="checkout-box">
            <div class="heading bottbor"> Add/Edit Address 
            	
            </div>
              <div class="address-change">
              	<ul style='width:100%;'>
            

                    <li id='add_edit_address_form' class='<?=count($customer_addresses)>0?"notshow":''?>' style='float:left;width:550px;'>
              		<div class='address-detail' >
              			<?php
	//post to the correct place.
	echo ($address_form_prefix == 'bill')?form_open('checkout/step_1'):form_open('secure/add_address_action');?>
		<div class="row">
			<?php // Address form ?>
			<div class="span8 offset2">								 
					
				<input type="hidden" name="id" id="id" value="<?php echo $id?>" />
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
						<?php echo form_dropdown('country_id',$countries, $address['country_id'], 'id="country_id" class="address span8"');?>
					</div>
				</div>
				<div class="row">
				
					<div class="span3 mar">
						<label class="placeholder"><?php echo lang('address_state');?><b class="r"> *</b></label>
						<?php 
							echo form_dropdown('zone_id',$zone_menu, $address['zone_id'], 'id="zone_id" class="address span3" ');?>
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
						<input class="btn place-order-btn" style="width:100%;" type="submit" value="Save"/>
				</div>
			</div>
		</div>
	</form>

              		</div>
              	</li>
      
 
              </ul></div>
              </div>
             
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
	
 



<style type="text/css">
.row div.span4{ float: left; width: 48%;}
.row div.span3{ float: left; width: 30%;}
.row>div.span3.mar{margin-right: 4%;}
.address-change li:last-child {float:left}

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
    width:89%;

}
.row div.span8>select, .row .span8>input{width: 95% !important;color:#000;}
.row div.span8  select{width:100% !important;}
#add_edit_address_form.notshow{position: absolute;left: -600px;}
</style>