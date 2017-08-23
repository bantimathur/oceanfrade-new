<style>
.error{color:red}
</style>
<?php

$password	= array('id'=>'password', 'class'=>'span2', 'name'=>'password', 'value'=>'','placeholder' => 'Password');
$confirm	= array('id'=>'confirm', 'class'=>'span2', 'name'=>'confirm', 'value'=>'','placeholder' => 'Confirm Password');
?>

<div class="fix-content">
   <div class="content-main">
      <?php $this->view('myaccount-left');?>
      <div class="cont-middle">
         <div class="grid-listing">
            <div class="edit-profile">
               <h3>Change Password</h3>
               <form name="frmchangepsw" id="frmchangepsw" action="<?php echo $this->config->site_url()?>secure/change_password" method="post" accept-charset="utf-8"> 
                    <div class="paddtop">
                       <div class="row-edit">                          
                         <?php echo form_password($password);?>
						 <div id="passwordErr"></div>
                       </div>
                       <div class="row-edit">                          
                        <?php echo form_password($confirm);?>
						 <div id="confirmErr"></div>
                       </div>
                      
                       <div class="row-edit">
                        <input type="button" name="savepsw" id="savepsw"  value="Save Changes" class="btn-login" />  
                       </div>
                    </div>
               </form>
            </div>
            <div class="clear"></div>
         </div>
      </div>
   </div>
   <div class="clearfix"></div>
</div>
<?php echo theme_js('jquery.validate', true);?>	
<script type="text/javascript">
$(document).ready(function(){
	 $("#frmchangepsw").validate({
        rules:{
            password:{
                required:true
            },
			 confirm:{
                required:true,
				equalTo: "#password"
            }
        },
        messages:{
            password:{
                required:'Please enter password'
            },
			 confirm:{
                required:'Please enter confirm password'
            }
      },
        errorPlacement: function(error, element) {
            if (element.attr("name") == "password"){
              error.appendTo("#passwordErr");  
            } else if (element.attr("name") == "confirm"){
              error.appendTo("#confirmErr");  
            }else{
                error.insertAfter(element);
            }                        
            }
        });
});
$("#savepsw").click(function() {
	var vld = $("#frmchangepsw").valid();
	
	if(vld) {
		$("#frmchangepsw").submit();
	} else {
		return false;
	}
});

</script>