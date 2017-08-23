 <div class="fix-content">
      <div class="content-main">
	     <?php $this->view('myaccount-left');?>
		  <div class="cont-middle">
        <div class="checkout">

     .
          <div class="checkout-box">
            <div class="heading bottbor"> Address List <a href="<?php echo $this->config->site_url()?>addaddress" class="btn add-address">+&nbsp;&nbsp;Add New Address</a></div>
<div class="address-change">
			<ul>
				<?php for($i=0;$i<count($address);$i++) { ?>
					<li>
						<div class="address-detail">
							<h3 style="font-size:15px;"><?php echo $address[$i]['field_data']['firstname']?>&nbsp; <?php echo $address[$i]['field_data']['lastname']?><span class="edit-icon">
							<a href="<?php echo $this->config->site_url()?>addaddress/<?php echo $address[$i]['id']?>"><img src="<?=base_url("gocart/themes/default/assets/images")?>/edit-icon.png" alt=""></a>
							<a class="delete-add" rel="<?php echo $address[$i]['id']?>" ><img src="<?=base_url("gocart/themes/default/assets/images")?>/delete-icon.png" alt=""></a>
							</span></h3>
							<p>
							<?php echo $address[$i]['field_data']['address1']?>, <?php echo $address[$i]['field_data']['address2']?>,
							<?php echo $address[$i]['field_data']['city']?>, <?php echo $address[$i]['field_data']['state']?>,
							<?php echo $address[$i]['field_data']['country']?>, <?php echo $address[$i]['field_data']['zip']?>
							</p>
						
						</div>
					 </li>
				<?php } ?>
			</ul>
</div>
          </div>
     .
        </div>
		</div>
      </div>
      <div class="clearfix"></div>
    </div>
	
	<script type="text/javascript">
	var site_url = "<?php echo $this->config->site_url();?>";
	$("document").ready(function() {
		
		function deletePro(id) {

			var url = site_url+"secure/delete_address";
			$.post(url, { id: id},
			function(data) {
				window.location.reload();
			});
		}
		
		$(".delete-add").click(function() {
			  var conf = confirm("Are you sure u want to delete this record?");
            //alert(conf);
            if(conf == true) {
                deletePro($(this).attr('rel'));
            } else {
                return false;    
            }
		});
		
		
	});
	</script>