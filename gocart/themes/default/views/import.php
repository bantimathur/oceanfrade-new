<?php echo theme_css('jquery.bxslider.css', true);?><?php echo theme_js('jquery.bxslider.js', true);?>
<div class="main-container">
  <div class="fix-content">
    <div class="shipping-box">
      <?php include('importstep1.php');?>
      <span id="step2" style="display: none">
      <?php include('importstep2.php');?>
      </span> <span id="step3" style="display: none">
      <?php include('step3.php');?>
      </span>
      <div class="shipping-form" id="cargopage">
        <div class="special-features"><img alt="Special features available for shipmyfreight.ca" src="<?php echo $this->config->site_url()?>images/special.png" /></div>
        <div class="gallery-box">
          <div class="smalldlider">
            <ul class="bxslidersmall">
              <?php for($i=0;$i<count($smallbanner);$i++) {
						$image_url = $this->config->base_url()."uploads/".$smallbanner[$i]->image;
					   ?>
              <li> <img src="<?php echo $image_url;?>" > </li>
              <?php }?>
            </ul>
          </div>
          <div class="book"> <img src="<?php echo $this->config->site_url()?>images/other1.jpg" alt=""> </div>
          <div class="clearfix"></div>
          <div class="big-slider"><ul class="bxslider">
            <?php for($i=0;$i<count($banner);$i++) {
					   $image_url = $this->config->base_url()."uploads/".$banner[$i]->image;
					  ?>
            <li> <img src="<?php echo $image_url;?>" width="600" height="280" > </li>
            <?php }?>
          </ul></div>
        </div>
        </div>
      </div>
      <div class="clearfix"></div>
      <?php include('clist.php');?>
    </div>
  </div>
  <div class="clearfix"></div>
</div>
<script type="text/javascript">
		$(document).ready(function(){		
			$('.bxslider').bxSlider({
			  minSlides: 1,
			  maxSlides: 1,
				auto : true,
			  slideMargin: 10,
			  pager: true
			});
			$('.bxslidersmall').bxSlider({
			  minSlides: 1,
			  maxSlides: 1,
			  auto : true,
			  slideMargin: 10,
			  mode : 'fade'
			});
	  });
  </script> 
<!--<script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script> --> 
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDWVWcqoP0jHjiPs7upf3xLGkL9SeRrm_0&callback=initMap"
  type="text/javascript"></script> 
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCDyu1YDTrx-2Hd7pa0ZSw5UsEVAVx2Kgk&callback=initMap"
  type="text/javascript"></script> 
<script>
		//alert(1);
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

	//alert(markers);

        
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