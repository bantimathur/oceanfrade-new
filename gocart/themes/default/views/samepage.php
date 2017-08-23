<div style="margin-top:20px">
<?php
$similar_pages = array_merge($similar_pages,$similar_pages_city);
//echo "<pre>";
//print_r($similar_pages);

?>

<h1>Our Other Shipping Services</h1>
<table class="citytable" style="border: 1px solid #000;width:100%">
<?php for($i=0;$i<count($similar_pages);$i+=4) {
	$cval = strtolower($similar_pages[$i]['eStatus']);
	if($cval == ""){
		break;
	}
?>
	<tr>
		<td class="eventd">
			<?php if($similar_pages[$i]['vCity'] == "" ) { ?>
				<a class="citylink" href="<?php echo $this->config->site_url()?>country/<?php echo $similar_pages[$i]['iCategoryId']?>/<?php echo strtolower($similar_pages[$i]['vCountry']);?>/<?php echo $similar_pages[$i]['iCountryId']?>">
				<?php echo strtolower($similar_pages[$i]['vheading']);?>
				</a>
			<?php } else { ?>
				<a class="citylink" href="<?php echo $this->config->site_url()?>city/<?php echo $similar_pages[$i]['iCategoryId']?>/<?php echo strtolower($similar_pages[$i]['vCity']);?>/<?php echo $similar_pages[$i]['iPageId']?>">
					 <?php echo strtolower($similar_pages[$i]['vheading']);?>
				</a>
			<?php } ?>			
		</td>		
		<td class="oddtd">
			<?php if($similar_pages[$i+1]['vCity'] == "" ) { ?>
				<a class="citylink" href="<?php echo $this->config->site_url()?>country/<?php echo $similar_pages[$i+1]['iCategoryId']?>/<?php echo strtolower($similar_pages[$i+1]['vCountry']);?>/<?php echo $similar_pages[$i+1]['iCountryId']?>">
				<?php echo strtolower($similar_pages[$i+1]['vheading']);?>
				</a>
			<?php } else { ?>
				<a class="citylink" href="<?php echo $this->config->site_url()?>city/<?php echo $similar_pages[$i+1]['iCategoryId']?>/<?php echo strtolower($similar_pages[$i+1]['vCity']);?>/<?php echo $similar_pages[$i+1]['iPageId']?>">
					 <?php echo strtolower($similar_pages[$i+1]['vheading']);?>
				</a>
			<?php } ?>			
		</td>
		<td class="eventd">
			<?php if($similar_pages[$i+2]['vCity'] == "" ) { ?>
				<a class="citylink" href="<?php echo $this->config->site_url()?>country/<?php echo $similar_pages[$i+2]['iCategoryId']?>/<?php echo strtolower($similar_pages[$i+2]['vCountry']);?>/<?php echo $similar_pages[$i+2]['iCountryId']?>">
				<?php echo strtolower($similar_pages[$i+2]['vheading']);?>
				</a>
			<?php } else { ?>
				<a class="citylink" href="<?php echo $this->config->site_url()?>city/<?php echo $similar_pages[$i+2]['iCategoryId']?>/<?php echo strtolower($similar_pages[$i+2]['vCity']);?>/<?php echo $similar_pages[$i+2]['iPageId']?>">
					 <?php echo strtolower($similar_pages[$i+2]['vheading']);?>
				</a>
			<?php } ?>			
		</td>
		<td class="oddtd">
			<?php if($similar_pages[$i+3]['vCity'] == "" ) { ?>
				<a class="citylink" href="<?php echo $this->config->site_url()?>country/<?php echo $similar_pages[$i+3]['iCategoryId']?>/<?php echo strtolower($similar_pages[$i+3]['vCountry']);?>/<?php echo $similar_pages[$i+3]['iCountryId']?>">
				<?php echo strtolower($similar_pages[$i+3]['vheading']);?>
				</a>
			<?php } else { ?>
				<a class="citylink" href="<?php echo $this->config->site_url()?>city/<?php echo $similar_pages[$i+3]['iCategoryId']?>/<?php echo strtolower($similar_pages[$i+3]['vCity']);?>/<?php echo $similar_pages[$i+3]['iPageId']?>">
					 <?php echo strtolower($similar_pages[$i+3]['vheading']);?>
				</a>
			<?php } ?>			
		</td>
		
	</tr>
	<?php } ?>

</table>
<!--<ul class="stepul flcl2">
			<?php for($i=0;$i<count($similar_pages);$i++) {
				$cval = strtolower($similar_pages[$i]['vName']);
			 ?>
				<li>
					<a class="citylink" href="<?php echo $this->config->site_url()?>country/<?php echo $similar_pages[$i]['iCategoryId']?>/<?php echo strtolower($similar_pages[$i]['vCountry']);?>/<?php echo $similar_pages[$i]['iCountryId']?>">
					 <?php echo strtolower($similar_pages[$i]['vheading']);?>
					</a>
				</li>
			<?php } ?>	
				<?php for($i=0;$i<count($similar_pages_city);$i++) {
				$cval = strtolower($similar_pages_city[$i]['vName']);
			 ?>
				<li>
					<a class="citylink" href="<?php echo $this->config->site_url()?>city/<?php echo $similar_pages_city[$i]['iCategoryId']?>/<?php echo strtolower($similar_pages_city[$i]['vCity']);?>/<?php echo $similar_pages_city[$i]['iPageId']?>">
					 <?php echo strtolower($similar_pages_city[$i]['vheading']);?>
					</a>
				</li>
			<?php } ?>	
			
</ul> -->
</div>
