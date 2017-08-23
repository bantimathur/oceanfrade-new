<div class="modal fade" id="myModal"  role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Still have a Question</h4>
      </div>
      <form name="frmqueastion" id="frmqueastion" method="post" action="">
        <div class="modal-body">
          
        <div class="form-date modallb">
           <label>Contact Name :</label>
           <div class="label-txt">
             <input name="contact_name" id="contact_name" type="text" value="">
             <div id="contact_nameErr"></div>
           </div>
           <div class="clear"></div>
           
         </div>
          
        <div class="form-date modallb">
           <label>Phone Number :</label>
           <div class="label-txt">
             <input name="phonenumber" id="phonenumber" type="text" value="">
              <div id="phonenumberErr"></div>
           </div>
           <div class="clear"></div>
         </div>
        <div class="form-date modallb">
           <label>Email :</label>
           <div class="label-txt">
             <input name="contact_email" id="contact_email" type="text" value="">
                <div id="contact_emailErr"></div>
           </div>
           
           <div class="clear"></div>
         </div>
        <div class="form-date modallb">
           <label>Question :</label>
           <div class="label-txt">
             <textarea name="queastion" id="queastion" type="text" value="" style="width: 316px;"></textarea>
             <div id="queastionErr"></div>
           </div>
           <div class="clear"></div>
         </div>
         <div class="form-date modallb">
           <label>Send me a copy :</label>
           <div class="label-txt">
             <input name="sendcopy" id="sendcopy" type="checkbox" checked="checked" value="Yes" class="sendcopy"/>
           </div>
           <div class="clear"></div>
         </div>
                <div id="succmsgforq" style="color:green; display: none">Thank you for asking question</div>
          
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" id="cancelmodal" >Close</button>
          <button type="button" class="btn btn-primary" id="queastion_save" name="queastion_save">Submit</button>
        </div>
      </form>
      

      
    </div>
  </div>
</div>
        