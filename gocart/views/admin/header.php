<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Freight Venture</title>

<link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/css/bootstrap-responsive.min.css');?>" rel="stylesheet" type="text/css" />
<link type="text/css" href="<?php echo base_url('assets/css/jquery-ui.css');?>" rel="stylesheet" />
<link type="text/css" href="<?php echo base_url('assets/css/redactor.css');?>" rel="stylesheet" />

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/redactor.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/tinymce/tiny_mce.js');?>"></script>

<?php if($this->auth->is_logged_in(false, false)):?>
    
<!--<style type="text/css">
    body {
        margin-top:50px;
    }
    
    
	.navbar-inner {background:#a92700;}
	@media (max-width: 979px){ 
        body {
            margin-top:0px;
        }
    }
    @media (min-width: 980px) {
        .nav-collapse.collapse {
            height: auto !important;
            overflow: visible !important;
        }
     }
    
    .nav-tabs li a {
        text-transform:uppercase;
        background: #a92700;
        border-bottom:1px solid #ddd;
        text-shadow: 0px 1px 0px #fff;
        filter: dropshadow(color=#fff, offx=0, offy=1);
        font-size:12px;
        padding:5px 8px;
    }
    
    .nav-tabs li a:hover {
        border:1px solid #ddd;
        text-shadow: 0px 1px 0px #fff;
        filter: dropshadow(color=#fff, offx=0, offy=1);
    }

</style>-->
<script type="text/javascript">
$(document).ready(function(){
    $('.datepicker').datepicker({dateFormat: 'yy-mm-dd'});
    
    /*$('.redactor').redactor({
            minHeight: 200,
            imageUpload: '<?php echo site_url(config_item('admin_folder').'/wysiwyg/upload_image');?>',
            fileUpload: '<?php echo site_url(config_item('admin_folder').'/wysiwyg/upload_file');?>',
            imageGetJson: '<?php echo site_url(config_item('admin_folder').'/wysiwyg/get_images');?>',
            imageUploadErrorCallback: function(json)
            {
                alert(json.error);
            },
            fileUploadErrorCallback: function(json)
            {
                alert(json.error);
            }
      });*/
});
</script>
<?php endif;?>
</head>
<body>
<?php if($this->auth->is_logged_in(false, false)):?>
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target="nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            
            <?php $admin_url = site_url($this->config->item('admin_folder')).'/';?>
            
            <a class="brand" href="<?php echo $admin_url;?>">Freight Venture </a>
            
            <div class="nav-collapse">
                <ul class="nav">
                    <li><a href="<?php echo $admin_url;?>"><?php echo lang('common_home');?></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo lang('common_sales') ?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo $admin_url;?>orders"><?php echo lang('common_orders') ?></a></li>
							 <li><a href="<?php echo $admin_url;?>/customers">Customers</a></li>
                          
                        </ul>
                    </li>



                    <?php
                    // Restrict access to Admins only
                    if($this->auth->check_access('Admin')) : ?>
                   
                    
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo lang('common_content') ?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                              <li><a href="<?php echo $admin_url;?>banners"><?php echo lang('common_banners') ?></a></li>
                            <li><a href="<?php echo $admin_url;?>pages"><?php echo lang('common_pages') ?></a></li>
                        </ul>
                    </li>
                    
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo lang('common_administrative') ?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo $admin_url;?>settings">Settings</a></li>
							 <li><a href="<?php echo $admin_url;?>settings/canned_messages">Email template</a></li>
                            <li style="display:none"><a href="<?php echo $admin_url;?>shipping"><?php echo lang('common_shipping_modules') ?></a></li>
                            <li><a href="<?php echo $admin_url;?>payment"><?php echo lang('common_payment_modules') ?></a></li>
                          
                            <li><a href="<?php echo $admin_url;?>locations"><?php echo lang('common_locations') ?></a></li>
                            <li><a href="<?php echo $admin_url;?>admin"><?php echo lang('common_administrators') ?></a></li>
                        </ul>
                    </li>
                    <?php endif; ?>
                </ul>
                <ul class="nav pull-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo lang('common_actions');?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo site_url($this->config->item('admin_folder').'/dashboard');?>"><?php echo lang('common_dashboard') ?></a></li>
                            <li><a href="<?php echo site_url();?>"><?php echo lang('common_front_end') ?></a></li>
                            <li><a href="<?php echo site_url($this->config->item('admin_folder').'/login/logout');?>"><?php echo lang('common_log_out') ?></a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.nav-collapse -->
        </div>
    </div><!-- /navbar-inner -->
</div>
<?php endif;?>
<div class="container">
    <?php
    //lets have the flashdata overright "$message" if it exists
    if($this->session->flashdata('message'))
    {
        $message    = $this->session->flashdata('message');
    }
    
    if($this->session->flashdata('error'))
    {
        $error  = $this->session->flashdata('error');
    }
    
    if(function_exists('validation_errors') && validation_errors() != '')
    {
        $error  = validation_errors();
    }
    ?>
    
    <div id="js_error_container" class="alert alert-error" style="display:none;"> 
        <p id="js_error"></p>
    </div>
    
    <div id="js_note_container" class="alert alert-note" style="display:none;">
        
    </div>
    
    <?php if (!empty($message)): ?>
        <div class="alert alert-success">
            <a class="close" data-dismiss="alert">×</a>
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <div class="alert alert-error">
            <a class="close" data-dismiss="alert">×</a>
            <?php echo $error; ?>
        </div>
    <?php endif; ?>
</div>      

<div class="container">
    <?php if(!empty($page_title)):?>
    <div class="page-header">
        <h1><?php echo  $page_title; ?></h1>
    </div>
    <?php endif;?>
    
    