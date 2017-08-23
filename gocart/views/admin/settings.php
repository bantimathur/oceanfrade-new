<?php echo form_open_multipart(config_item('admin_folder').'/settings');?>

<fieldset>
    <legend>Company Address</legend>
    <div class="row">
        <div class="span4">
            <label>Company Name</label>
            <?php echo form_input(array('class'=>'span4', 'name'=>'company_name', 'value'=>set_value('company_name', $company_name)));?>
        </div>

     

        <div class="span4">
            <label>Email Address</label>
            <?php echo form_input(array('class'=>'span4', 'name'=>'email', 'value'=>set_value('email', $email)));?>
        </div>
        <div class="span4">
            <label>Exchange rate</label>
            <?php echo form_input(array('class'=>'span4', 'name'=>'exchangerate', 'value'=>set_value('exchangerate', $exchangerate)));?>
        </div> 
    </div>
	<div class="row">
        <div class="span4">
            <label>Others Fee</label>
            <?php echo form_input(array('class'=>'span4', 'name'=>'othersfee', 'value'=>set_value('othersfee', $othersfee)));?>
        </div>
        <div class="span4">
            <label>Export Declaration Fee</label>
            <?php echo form_input(array('class'=>'span4', 'name'=>'exportdeclarationfee', 'value'=>set_value('exportdeclarationfee', $exportdeclarationfee)));?>
        </div>
        <div class="span4">
            <label>Handling Fee</label>
            <?php echo form_input(array('class'=>'span4', 'name'=>'handlingfee', 'value'=>set_value('handlingfee', $handlingfee)));?>
        </div> 
    </div>
    <div class="row">
        <div class="span4">
            <label>Stripe Publish Key For CAD Account</label>
            <?php echo form_input(array('class'=>'span4', 'name'=>'stripe_publish_key', 'value'=>set_value('stripe_publish_key', $stripe_publish_key)));?>
        </div>
        <div class="span4">
            <label>Stripe Secret Key For CAD Account</label>
            <?php echo form_input(array('class'=>'span4', 'name'=>'stripe_secret_key', 'value'=>set_value('stripe_secret_key', $stripe_secret_key)));?>
        </div>
       
    </div>
     <div class="row">
        <div class="span4">
            <label>Stripe Publish Key For USD Account</label>
            <?php echo form_input(array('class'=>'span4', 'name'=>'stripe_publish_key_usd', 'value'=>set_value('stripe_publish_key_usd', $stripe_publish_key_usd)));?>
        </div>
        <div class="span4">
            <label>Stripe Secret Key For USD Account</label>
            <?php echo form_input(array('class'=>'span4', 'name'=>'stripe_secret_key_usd', 'value'=>set_value('stripe_secret_key_usd', $stripe_secret_key_usd)));?>
        </div>
       
    </div>
</fieldset>

<fieldset>
    <legend>Address</legend>

    <label><?php echo lang('country');?></label>
    <?php echo form_dropdown('country_id', $countries_menu, set_value('country_id', $country_id), 'id="country_id" class="span12"');?>

    <div class="row">
        <div class="span6">
            <label><?php echo lang('address1');?></label>
            <?php echo form_input(array('name'=>'address1', 'class'=>'span12','value'=>set_value('address1',$address1)));?>
        </div>
    </div>

    <div class="row">
        <div class="span6">
            <?php echo form_input(array('name'=>'address2', 'class'=>'span12','value'=> set_value('address2',$address2)));?>
        </div>
    </div>

    <div class="row">
        <div class="span4">
            <label><?php echo lang('city');?></label>
            <?php echo form_input(array('name'=>'city','class'=>'span4', 'value'=>set_value('city',$city)));?>
        </div>
        <div class="span6">
            <label><?php echo lang('state');?></label>
            <?php echo form_dropdown('zone_id', $zones_menu, set_value('zone_id', $zone_id), 'id="zone_id" class="span6"');?>
        </div>
        <div class="span2">
            <label><?php echo lang('zip');?></label>
            <?php echo form_input(array('maxlength'=>'10', 'class'=>'span2', 'name'=>'zip', 'value'=> set_value('zip',$zip)));?>
        </div>
    </div>
</fieldset>



<input type="submit" class="btn btn-primary" value="<?php echo lang('save');?>" />

</form>


<script>
    var order_statuses = <?php echo $order_statuses;?>;
    
    function add_status()
    {
        var status = $('#new_order_status_field').val();

     
            order_statuses[htmlEntities(status)] = htmlEntities(status);

            var os_submission = JSON.stringify(order_statuses);
            $('#order_statuses_json').val(os_submission);
            
            var row = '<tr><td><input type="radio" value="'+htmlEntities(status)+'" name="order_status"></td><td>'+htmlEntities(status)+'</td><td style="text-align:right;"><button type="button" onclick="if(confirm(\'<?php echo lang('confirm_delete_order_status');?>\')){delete_status($(this).parent().siblings().first().html()); $(this).parent().parent().remove();}" class="btn btn-danger"><i class="icon-remove icon-white"></i></button></td></tr>';
            $('#order_statuses').append(row);

        $('#new_order_status_field').val('')
        
    }

    function delete_status(status)
    {
        order_statuses[status] = undefined;
        var os_submission = JSON.stringify(order_statuses);
        $('#order_statuses_json').val(os_submission);
    }

    $(document).ready(function(){
        $('#country_id').change(function(){
            $.post('<?php echo site_url(config_item('admin_folder').'/locations/get_zone_menu');?>',{id:$('#country_id').val()}, function(data) {
              $('#zone_id').html(data);
            });
        });
    });
    
    function htmlEntities(str) {
       return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
    }      
</script>
<style type="text/css">
#order_statuses_json {
   display:none;
}

</style>
