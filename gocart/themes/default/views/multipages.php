<?php echo theme_css('jquery.bxslider.css', true);?>
<?php echo theme_js('jquery.bxslider.js', true);?>
 <div class="main-container">
  <div class="fix-content">
      <div class="shipping-box">
       
		  <?php include('step1.php');?>
		  <span id="step2" style="display: none"><?php include('step2.php');?></span>
		  <span id="step3" style="display: none"><?php include('step3.php');?></span>
		  
        <div class="shipping-form" id="cargopage">
		
		
		<?php if($type == "citytype") { ?>
		<div style="width:100%">
			<?php $map_img =  strtolower(str_replace(' ','',$custom_pages[0]['vCountry'])).'flag';?>
			<?php $place_img =  strtolower($custom_pages[0]['vCountry']).'-place';?>
			<?php $category_img =  str_replace(' ','_',$custom_pages[0]['vCategoryName']);
				
			?>
			<h1 class="pageheading"><?php echo $custom_pages[0]['vCategoryName'];?> to  <span style="color:#BB55A7"><?php echo $custom_pages[0]['vCity'];?>, <?php echo $custom_pages[0]['vCountry'];?></span></h1>
			<p>			
				<div height="245" width="300" class="fright" >
					<img src="<?php echo $this->config->site_url()?>images/pages/<?php echo $category_img?>.jpg" height="245" width="300" class="fright" />
					<div>
							Change Country:
							<select name="change_loc" id="change_loc" class="change-loc " title="Please select country">
								<option value="">Select Country</option>
								<?php for($i=0;$i<count($page_county);$i++) {
									$link=  $this->config->site_url()."country/".$page_county[$i]['vMainCategoryId'].'/'.strtolower($page_county[$i]['vName']).'/'.$page_county[$i]['iCountryId'];
									?>
									<option value='<?php echo $link;?>'>
										 <?php echo $page_county[$i]['vName']?>
									</option>
								<?php } ?>
							</select>
							<br/>
					</div>
				</div>
				<img src="<?php echo $this->config->site_url()?>images/pages/<?php echo $map_img?>.png" style="float:left;   float: left;margin: 0 4px 0 0;" height="50" width="70" />
				<?php echo $page_content; ?>		
			</p>
		</div>
		<?php }  else { ?>
			<div style="width:100%">
				<?php $map_img =  strtolower(str_replace(' ','',$custom_pages[0]['vCountry'])).'flag';?>
				<?php $category_img =  str_replace(' ','_',$custom_pages[0]['vCategoryName']); ?>
					<?php $place_img =  strtolower($custom_pages[0]['vCountry']).'-place';?>
			
				<h1 class="pageheading"><?php echo $custom_pages[0]['vCategoryName'];?> to  <span style="color:#BB55A7"><?php echo $custom_pages[0]['vCountry'];?></span></h1>
				<p>
				
					
					<div height="245" width="300" class="fright" >
						<img src="<?php echo $this->config->site_url()?>images/pages/<?php echo $category_img?>.jpg" height="245" width="300" class="fright" />
						<div>
								Change Country: 
								<select name="change_loc" id="change_loc" class="change-loc " title="Please select country">
									<option value="">Select Country</option>
									<?php for($i=0;$i<count($page_county);$i++) {
										$link=  $this->config->site_url()."country/".$page_county[$i]['vMainCategoryId'].'/'.strtolower($page_county[$i]['vName']).'/'.$page_county[$i]['iCountryId'];
										?>
										<option value='<?php echo $link;?>'>
											 <?php echo $page_county[$i]['vName']?>
										</option>
									<?php } ?>
								</select>
								<br/>
						</div>
						
					</div>
					<img src="<?php echo $this->config->site_url()?>images/pages/<?php echo $map_img?>.png" style="float:left;   float: left;margin: 0 4px 0 0;" height="60" width="80" />
						
					<?php echo $page_content; ?>
			
				
				</p>
			</div>
		<?php  } ?>
			<br/>
			<?php
				$location_map = $custom_pages[0]['vCity']." ,".$custom_pages[0]['vCountry'];
			?>
			<?php // pr($custom_pages);?>
			<div align="center">
				<?php 			
				//realpath
				$file_path = getcwd() ."/images/pages/".$place_img.'.jpg';
				if(is_file($file_path)) { ?>
					<img src="<?php echo $this->config->site_url()?>images/pages/<?php echo $place_img?>.jpg" style="width:100%;height:250px;">
				<?php } ?>
				
			</div>
			<div style="margin-top:5px;margin-bottom:5px;text-decoration:none; overflow:hidden; height:220px; max-width:100%;">
				<div id="embed-map-display" style="height:100%; width:100%;max-width:100%;">
				<iframe style="height:100%;width:100%;border:0;" frameborder="0" src="https://www.google.com/maps/embed/v1/place?q=<?php echo $location_map;?>&key=AIzaSyAnGcr-vHW7cXbCCNlqYj1GHntF5zEuAo4"></iframe>
				</div>
			</div>
			
        </div>
        <div class="clearfix"></div>
        <div style=" background: #fff;    padding: 10px;margin-top:10px;" ><?php include('samepage.php');?></div>
      </div>



    </div>

    <div class="clearfix"></div>

  </div>
  	<script type="text/javascript">
		$(document).ready(function(){		
		$("#change_loc").change(function() {
			var rel = $(this).val();
			window.location.href= rel;
		});
	  });
  </script>
	  	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDWVWcqoP0jHjiPs7upf3xLGkL9SeRrm_0&callback=initMap"
  type="text/javascript"></script>
	<script>

     function initializemap(markers,zooml) {
		 
       $("#map_canvas").show();
        var map;
        var bounds = new google.maps.LatLngBounds();
        var mapOptions = {
            mapTypeId: 'roadmap',
			'zoom':zooml
        };
                    
        // Display a map on the page
        map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
        map.setTilt(45);
        
        // Multiple Markers
      /* var markers = [
            ['London Eye, London', 51.503454,-0.119562],
            ['Palace of Westminster, London', 51.499633,-0.124755],
            ['Palace of Westminster, London', 51.489633,-0.112755]
        ];*/
	  var markers = eval(markers);

   

        
        // Display multiple markers on a map
        var infoWindow = new google.maps.InfoWindow(), marker, i;
    
        // Loop through our array of markers & place each one on the map  
        for( i = 0; i < markers.length; i++ ) {
            var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
            bounds.extend(position);
            marker = new google.maps.Marker({
                position: position, 
                map: map,
                title: markers[i][0]
            });
        
            // Automatically center the map fitting all mar
			
            map.fitBounds(bounds);
        }

        // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
        var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
            this.setZoom(zooml);
            google.maps.event.removeListener(boundsListener);
        });
    
    }
</script>