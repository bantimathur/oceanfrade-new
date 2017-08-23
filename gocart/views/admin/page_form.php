<?php echo form_open($this->config->item('admin_folder').'/pages/form/'.$id); ?>

<div class="tabbable">
	
	<ul class="nav nav-tabs">
		<li class="active"><a href="#content_tab" data-toggle="tab"><?php echo lang('content');?></a></li>
		<!--<li><a href="#attributes_tab" data-toggle="tab"><?php echo lang('attributes');?></a></li>-->
		<li><a href="#seo_tab" data-toggle="tab"><?php echo lang('seo');?></a></li> 
	</ul>
	
	<div class="tab-content">
		<div class="tab-pane active" id="content_tab">
			<fieldset>
				<label for="title"><?php echo lang('title');?></label>
				<?php
				$data	= array('name'=>'title', 'value'=>set_value('title', $title), 'class'=>'span12');
				echo form_input($data);
				?>
				
				<label for="content"><?php echo lang('content');?></label>
				<?php
				$data	= array('name'=>'content','id'=>'content', 'class'=>'redactorss', 'value'=>set_value('content', $content));
				 echo form_textarea($data);
				?>
				
			</fieldset>
		</div>

		<div class="tab-pane" id="attributes_tab">
			<fieldset>
				<label for="menu_title"><?php echo lang('menu_title');?></label>
				<?php
				$data	= array('name'=>'menu_title', 'value'=>set_value('menu_title', $menu_title), 'class'=>'span3');
				echo form_input($data);
				?>
			
				<label for="slug"><?php echo lang('slug');?></label>
				<?php
				$data	= array('name'=>'slug', 'value'=>set_value('slug', $slug), 'class'=>'span3');
				echo form_input($data);
				?>
			
				<label for="sequence"><?php echo lang('parent_id');?></label>
				<?php
				$options	= array();
				$options[0]	= lang('top_level');
				function page_loop($pages, $dash = '', $id=0)
				{
					$options	= array();
					foreach($pages as $page)
					{
						//this is to stop the whole tree of a particular link from showing up while editing it
						if($id != $page->id)
						{
							$options[$page->id]	= $dash.' '.$page->title;
							$options			= $options + page_loop($page->children, $dash.'-', $id);
						}
					}
					return $options;
				}
				$options	= $options + page_loop($pages, '', $id);
				echo form_dropdown('parent_id', $options,  set_value('parent_id', $parent_id));
				?>
			
				<label for="sequence"><?php echo lang('sequence');?></label>
				<?php
				$data	= array('name'=>'sequence', 'value'=>set_value('sequence', $sequence), 'class'=>'span3');
				echo form_input($data);
				?>
			</fieldset>
		</div>
	
		<div class="tab-pane" id="seo_tab">
			<fieldset>
				<label for="code"><?php echo lang('seo_title');?></label>
				<?php
				$data	= array('name'=>'seo_title', 'value'=>set_value('seo_title', $seo_title), 'class'=>'span12');
				echo form_input($data);
				?>
				<label>Keywords</label>
				<?php
				$data	= array('rows'=>'2', 'name'=>'seo_keywords', 'value'=>set_value('seo_keywords', html_entity_decode($seo_keywords)), 'class'=>'span12');
				echo form_textarea($data);
				?>
				<label>Description</label>
				<?php
				$data	= array('rows'=>'3', 'name'=>'meta', 'value'=>set_value('meta', html_entity_decode($meta)), 'class'=>'span12');
				echo form_textarea($data);
				?>
				
				<p class="help-block"><?php echo lang('meta_data_description');?></p>
			</fieldset>
		</div>
	</div>
</div>

<div class="form-actions">
	<button type="submit" class="btn btn-primary"><?php echo lang('save');?></button>
</div>	
</form>

<script>
	  var site_url = "<?php echo $this->config->site_url()?>";
  var base_url = "<?php echo $this->config->base_url()?>";
	$("document").ready(function() {
    //alert(1);    
    tinyMCE.init({
		// General options
		mode : "none",
		theme : "advanced",
		plugins : "autolink,lists,pagebreak,style,layer,save,advhr,advlink,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft,visualblocks",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : base_url+"public/css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : base_url+"public/js/tinymce/template_list.js",
		external_link_list_url : base_url+"public/js/tinymce/link_list.js",
		external_image_list_url : base_url+"public/js/tinymce/image_list.js",
		media_external_list_url : base_url+"public/js/tinymce/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
    
    tinymce.execCommand("mceAddControl", false, "content");
	});
</script>
