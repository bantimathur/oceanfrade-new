<div class="fix-content">
<div class="content-main">
<?php $this->view('myaccount-left');?>
<div class="cont-middle">
    <div class="grid-listing">
     <div class="edit-profile">
      <h3>My Wishlist <span>(<?php echo $total?> Items)</span></h3>
      <div id="wishlist-section">
     
      </div>
     </div>
     <div class="clear"></div>
    </div>
   </div>
</div>
<div class="clearfix"></div>
</div>
<script type="text/javascript">
 
    var site_url = "<?php echo $this->config->site_url()?>";

</script>
<?php echo theme_js('wishlist.js', true);?>
