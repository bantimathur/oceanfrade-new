<!--<div style="margin-top:20px;display:none;">
<h1>Freight Shipping & Cargo Shipping by Country</h1>
<ul class="stepul flcl">
			<?php for($i=0;$i<count($page_county);$i++) {
				$cval = strtolower($page_county[$i]['vName']);
			 ?>
				<li>
					<a class="citylink" href="<?php echo $this->config->site_url()?>country/<?php echo $page_county[$i]['vMainCategoryId']?>/<?php echo strtolower($page_county[$i]['vName']);?>/<?php echo $page_county[$i]['iCountryId']?>">
					 <?php echo strtolower($page_county[$i]['vName']);?>
					</a>
				</li>
			<?php } ?>	
		   </ul>
</div> -->
<div class="cate-list">
<h1>Freight Shipping & Cargo Shipping by Country</h1>
<table class="countrytable" style="border: 1px solid #000;">
	<?php for($i=0;$i<count($page_county);$i+=6) {
		$cval = strtolower($page_county[$i]['vName']);
	?>
	<tr>
		<td class="eventd">
					<a class="citylink" href="<?php echo $this->config->site_url()?>country/<?php echo $page_county[$i]['vMainCategoryId']?>/<?php echo strtolower($page_county[$i]['vName']);?>/<?php echo $page_county[$i]['iCountryId']?>">
					 <?php echo strtolower($page_county[$i]['vName']);?>
					</a>
		</td>
		<td class="oddtd">
					<a class="citylink" href="<?php echo $this->config->site_url()?>country/<?php echo $page_county[$i+1]['vMainCategoryId']?>/<?php echo strtolower($page_county[$i+1]['vName']);?>/<?php echo $page_county[$i+1]['iCountryId']?>">
					 <?php echo strtolower($page_county[$i+1]['vName']);?>
					</a>
		</td>
		<td class="eventd">
					<a class="citylink" href="<?php echo $this->config->site_url()?>country/<?php echo $page_county[$i+2]['vMainCategoryId']?>/<?php echo strtolower($page_county[$i+2]['vName']);?>/<?php echo $page_county[$i+2]['iCountryId']?>">
					 <?php echo strtolower($page_county[$i+2]['vName']);?>
					</a>
		</td>
		<td class="oddtd">
					<a class="citylink" href="<?php echo $this->config->site_url()?>country/<?php echo $page_county[$i+3]['vMainCategoryId']?>/<?php echo strtolower($page_county[$i+3]['vName']);?>/<?php echo $page_county[$i+3]['iCountryId']?>">
					 <?php echo strtolower($page_county[$i+3]['vName']);?>
					</a>
		</td>
		<td class="eventd">
					<a class="citylink" href="<?php echo $this->config->site_url()?>country/<?php echo $page_county[$i+4]['vMainCategoryId']?>/<?php echo strtolower($page_county[$i+4]['vName']);?>/<?php echo $page_county[$i+4]['iCountryId']?>">
					 <?php echo strtolower($page_county[$i+4]['vName']);?>
					</a>
		</td>
		<td class="oddtd">
					<a class="citylink" href="<?php echo $this->config->site_url()?>country/<?php echo $page_county[$i+5]['vMainCategoryId']?>/<?php echo strtolower($page_county[$i+5]['vName']);?>/<?php echo $page_county[$i+5]['iCountryId']?>">
					 <?php echo strtolower($page_county[$i+5]['vName']);?>
					</a>
		</td>
	</tr>
	<?php } ?>	
</table>

</div>