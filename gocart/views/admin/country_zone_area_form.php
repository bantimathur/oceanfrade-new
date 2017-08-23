<?php echo form_open($this->config->item('admin_folder').'/locations/zone_area_form/'.$zone_id.'/'.$id); ?>

	<label for="code">Name</label>
	<?php
	$data	= array( 'name'=>'code', 'value'=>set_value('code', $code), 'class'=>'span12');
	echo form_input($data);
	?>
	
	<label for="eOrigin">Origin</label>
	<select name="eOrigin" id="eOrigin">
		<option value="Montreal" <?php if($eOrigin == "Montreal" ) { ?> selected="selected" <?php } ?>>Montreal</option>
		<option value="Toronto"  <?php if($eOrigin == "Toronto" ) { ?> selected="selected" <?php } ?>>Toronto</option>
		<option value="Vancouver"  <?php if($eOrigin == "Vancouver" ) { ?> selected="selected" <?php } ?>>Vancouver</option>
	</select>
	<label for="vSailingFrequency	">Sailing Frequency</label>
	<?php
		$data	= array( 'name'=>'vSailingFrequency', 'maxlength'=>'10', 'value'=>set_value('vSailingFrequency', $vSailingFrequency));
		echo form_input($data);
	?>
		<label for="iTransitDays">Transit Dates</label>
	<?php
		$data	= array( 'name'=>'iTransitDays', 'maxlength'=>'10', 'value'=>set_value('iTransitDays', $iTransitDays));
		echo form_input($data);
	?>
	
	<label for="fCBMRate">CBM Rate</label>
	<div class="input-append">
		<?php
		$data	= array('name'=>'fCBMRate', 'maxlength'=>'10', 'value'=>set_value('fCBMRate', $fCBMRate));
		echo form_input($data);
		?>
		
	</div>
	<label for="fMinimumCharges">Minimum Charges</label>
	<div class="input-append">
		<?php
		$data	= array('name'=>'fMinimumCharges', 'maxlength'=>'10', 'value'=>set_value('fMinimumCharges', $fMinimumCharges));
		echo form_input($data);
		?>
		
	</div>
	<label for="fMinimumCharges">Lat</label>
	<div class="input-append">
		<?php
		$data	= array('name'=>'vLat', 'maxlength'=>'10', 'value'=>set_value('vLat', $vLat));
		echo form_input($data);
		?>
		
	</div>
	<label for="fMinimumCharges">Long</label>
	<div class="input-append">
		<?php
		$data	= array('name'=>'vLong', 'maxlength'=>'10', 'value'=>set_value('vLong', $vLong));
		echo form_input($data);
		?>
		
	</div>
	
	<div class="form-actions">
		<button type="submit" class="btn btn-primary"><?php echo lang('save');?></button>
	</div>

</form>

<script type="text/javascript">
$('form').submit(function() {
	$('.btn').attr('disabled', true).addClass('disabled');
});
</script>