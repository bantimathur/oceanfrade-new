<?php
$company	= array('id'=>'company', 'class'=>'span4', 'name'=>'company', 'value'=> set_value('company', $customer['company']));
$first		= array('id'=>'firstname', 'class'=>'span2', 'name'=>'firstname', 'value'=> set_value('firstname', $customer['firstname']),'placeholder' => 'First Name');
$last		= array('id'=>'lastname', 'class'=>'span2', 'name'=>'lastname', 'value'=> set_value('lastname', $customer['lastname']),'placeholder' => 'Last Name');
$email		= array('id'=>'email', 'class'=>'span2', 'name'=>'email', 'value'=> set_value('email', $customer['email']),'placeholder' => 'Email Address');
$phone		= array('id'=>'phone', 'class'=>'span2', 'name'=>'phone', 'value'=> set_value('phone', $customer['phone']),'placeholder' => 'Phone Number');

$password	= array('id'=>'password', 'class'=>'span2', 'name'=>'password', 'value'=>'');
$confirm	= array('id'=>'confirm', 'class'=>'span2', 'name'=>'confirm', 'value'=>'');
?>

<div class="fix-content">
   <div class="content-main">
      <?php $this->view('myaccount-left');?>
      <div class="cont-middle">
         <div class="grid-listing">
            <div class="edit-profile">
               <h3>Personal Information</h3>
                <?php echo form_open('myaccount'); ?>
                    <div class="paddtop">
                       <div class="row-edit">                          
                          <?php echo form_input($first);?>
                       </div>
                       <div class="row-edit">                          
                          <?php echo form_input($last);?>
                       </div>
                       <div class="row-edit">                          
                          <?php echo form_input($email);?>
                       </div>
                       <div class="row-edit">
                            <?php echo form_input($phone);?>
                          
                       </div>
                       <!--<div class="row-edit"><input name="textfield2" type="text" value="Landline Number"></div>-->
                       <div class="row-edit">
                        <input type="submit" value="Save Changes" class="btn-login" />  
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