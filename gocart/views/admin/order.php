<div class="row">
    <div class="span12">
      
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
    $('#content_editor').redactor({
        minHeight: 200,
        imageUpload: 'http://labs.gocartdv.com/gc2test/admin/wysiwyg/upload_image',
        fileUpload: 'http://labs.gocartdv.com/gc2test/admin/wysiwyg/upload_file',
        imageGetJson: 'http://labs.gocartdv.com/gc2test/admin/wysiwyg/get_images',
        imageUploadErrorCallback: function(json)
        {
            alert(json.error);
        },
        fileUploadErrorCallback: function(json)
        {
            alert(json.error);
        }
    }); 
});

// store message content in JS to eliminate the need to do an ajax call with every selection
var messages = <?php
    $messages   = array();
    foreach($msg_templates as $msg)
    {
        $messages[$msg['id']]= array('subject'=>$msg['subject'], 'content'=>$msg['content']);
    }
    echo json_encode($messages);
    ?>;
//alert(messages[3].subject);
// store customer name information, so names are indexed by email
var customer_names = <?php 
    echo json_encode(array(
        $order->email=>$order->firstname.' '.$order->lastname,
        $order->ship_email=>$order->ship_firstname.' '.$order->ship_lastname,
        $order->bill_email=>$order->bill_firstname.' '.$order->bill_lastname
    ));
?>;
// use our customer names var to update the customer name in the template
function update_name()
{
    if($('#canned_messages').val().length>0)
    {
        set_canned_message($('#canned_messages').val());
    }
}

function set_canned_message(id)
{
    // update the customer name variable before setting content 
    $('#msg_subject').val(messages[id]['subject'].replace(/{customer_name}/g, customer_names[$('#recipient_name').val()]));
    $('#content_editor').redactor('insertHtml', messages[id]['content'].replace(/{customer_name}/g, customer_names[$('#recipient_name').val()]));
}   
</script>

<div id="notification_form" class="row" style="display:none;">
    <div class="span12">
        <?php echo form_open($this->config->item('admin_folder').'/orders/send_notification/'.$order->id);?>
            <fieldset>
                <label><?php echo lang('message_templates');?></label>
                <select id="canned_messages" onchange="set_canned_message(this.value)" class="span12">
                    <option><?php echo lang('select_canned_message');?></option>
                    <?php foreach($msg_templates as $msg)
                    {
                        echo '<option value="'.$msg['id'].'">'.$msg['name'].'</option>';
                    }
                    ?>
                </select>

                <label><?php echo lang('recipient');?></label>
                <select name="recipient" onchange="update_name()" id="recipient_name" class='span12'>
                    <?php 
                        if(!empty($order->email))
                        {
                            echo '<option value="'.$order->email.'">'.lang('account_main_email').' ('.$order->email.')';
                        }
                        if(!empty($order->ship_email))
                        {
                            echo '<option value="'.$order->ship_email.'">'.lang('shipping_email').' ('.$order->ship_email.')';
                        }
                        if($order->bill_email != $order->ship_email)
                        {
                            echo '<option value="'.$order->bill_email.'">'.lang('billing_email').' ('.$order->bill_email.')';
                        }
                    ?>
                </select>

                <label><?php echo lang('subject');?></label>
                <input type="text" name="subject" size="40" id="msg_subject" class="span12"/>

                <label><?php echo lang('message');?></label>
                <textarea id="content_editor" name="content"></textarea>

                <div class="form-actions">
                    <input type="submit" class="btn btn-primary" value="<?php echo lang('send_message');?>" />
                </div>
            </fieldset>
        </form>
    </div>
</div>

<div class="row" style="margin-top:10px;">
     <div class="span4">
        <h3><?php echo lang('shipping_address');?></h3>
        <?php echo (!empty($order->ship_company))?$order->ship_company.'<br/>':'';?>
        <?php echo $order->ship_firstname.' '.$order->ship_lastname;?> <br/>
        <?php echo $order->ship_address1;?><br>
        <?php echo (!empty($order->ship_address2))?$order->ship_address2.'<br/>':'';?>
        <?php echo $order->ship_city.', '.$order->ship_zone.' '.$order->ship_zip;?><br/>
        <?php echo $order->ship_country;?><br/>
        
        <?php echo $order->ship_email;?><br/>
        <?php echo $order->ship_phone;?>
    </div>
   
    <div class="span4">
        <h3>Consignee Details</h3>
        <?php echo (!empty($order->bill_company))?$order->bill_company.'<br/>':'';?>
        <?php echo $order->bill_firstname.' '.$order->bill_lastname;?> <br/>
        <?php echo $order->bill_address1;?><br>
        <?php echo $order->bill_city.', '.$order->bill_zone.' '.$order->bill_zip;?><br/>
        <?php echo $order->bill_country;?><br/>
        
        <?php echo $order->bill_email;?><br/>
        <?php echo $order->bill_phone;?>
    </div>
     <div class="span4">
          <h3>Pick Up Details</h3>
            Postal code : <?php echo $order->pick_postalcode;?><br/>
            Dock: <?php echo $order->pick_dock;?><br/>
            Email : <?php echo $order->pick_email;?><br/>
            Phone : <?php echo $order->pick_phone;?><br/>
            Additional info : <?php echo $order->pick_additional_info;?><br/>
    </div>
     
</div>

<div class="row" style="margin-top:20px;">
   
    <div class="span4">
        <h3><?php echo lang('payment_method');?></h3>
        <p><?php echo $order->payment_info; ?></p>
    </div>
    <div class="span4">
        <h3>Commodity </h3>
       Commodity Info : <?php echo $order->tCommodity; ?><br>
        Additional Info : <?php echo $order->tCommodityComment; ?>
    </div>
    <div class="span4">
        <h3>Destination  </h3>
       Origin : <?php echo $order->vOrigin; ?><br>
        Country : <?php echo $dest_info[0]['country']; ?><br>
        City : <?php echo$dest_info[0]['city']; ?>
    </div>
</div>

<?php echo form_open($this->config->item('admin_folder').'/orders/order/'.$order->id, 'class="form-inline"');?>
<fieldset>
    <div class="row" style="margin-top:20px;">
        <div class="span8">
            <h3><?php echo lang('admin_notes');?></h3>
            <textarea name="notes" class="span8"><?php echo $order->notes;?></textarea>
        </div>

    
        <div class="span4">
            <h3><?php echo lang('status');?></h3>
            <?php
            echo form_dropdown('status', $this->config->item('order_statuses'), $order->status, 'class="span4"');
            ?>
            
        </div>
    </div>
    
    <div class="form-actions">
        <input type="submit" class="btn btn-primary" value="<?php echo lang('update_order');?>"/>
    </div>
</fieldset>
</form>

<?php //pr($order)?>
<table class="table table-striped">
    <thead>
        <tr>
       
            <th>No Of Skids</th>
			<th>Length</th>
			<th>Weight</th>
			<th>Height</th>
			<th>Weight per item</th>
			<th>Total Volume in CBM</th>
			<th>Total Weight in LBS</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($order->contents as $orderkey=>$product):?>
        <tr>
            <td>
                <?php echo $product['iNoOfSkids'];?>
            </td>
			<td>
                <?php echo $product['iLength'];?>
            </td>
			<td>
                <?php echo $product['iWidth'];?>
            </td>
			<td>
                <?php echo $product['iHeight'];?>
            </td>
			<td>
                <?php echo $product['fWeightPItem'];?>
            </td>
			<td>
                <?php echo $product['fTotalVolumeCBM'];?>
            </td>
			<td>
                <?php echo $product['fTotalWeightLBS'];?>
            </td>
		
            
        </tr>
        <?php endforeach;?>
        </tbody>
        <tfoot>
        
       
        <tr>
            <td><h3>Price</h3></td>
            <td colspan="5"></td>
            <td><strong><?php echo format_currency($order->total); ?></strong></td>
        </tr>
    </tfoot>
</table>