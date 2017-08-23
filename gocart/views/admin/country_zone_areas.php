<script type="text/javascript">
function areyousure()
{
	return confirm('<?php echo lang('confirm_delete_zone_area');?>');
}
</script>

<div class="top-button pull-right">
	<a class="btn" href="<?php echo site_url($this->config->item('admin_folder').'/locations/zone_area_form/'.$zone->id);?>"><i class="icon-plus-sign"></i>
	Add City/Port
	</a>
</div>

<table class="table table-striped" cellspacing="0" cellpadding="0">
	<thead>
		<tr>
			<th>Name</th>
			<th>Origin</th>
			<th>Sailing Frequency</th>
			<th>Transit Time</th>
			<th>CBM Rate</th>
			<th>Minimum Charges</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($areas as $location):?>
		<tr>
			<td><?php echo  $location->code; ?></td>
			<td><?php echo  $location->eOrigin; ?></td>
			<td><?php echo  $location->vSailingFrequency; ?></td>
			<td><?php echo  $location->iTransitDays; ?></td>
			<td><?php echo  $location->fCBMRate; ?></td>
			<td><?php echo  $location->fMinimumCharges; ?></td>
			<td>
				<div class="btn-group" style="float:right;">
					<a class="btn" href="<?php echo  site_url($this->config->item('admin_folder').'/locations/zone_area_form/'.$zone->id.'/'.$location->id); ?>"><i class="icon-pencil"></i> <?php echo lang('edit');?></a>
					<a class="btn btn-danger" href="<?php echo  site_url($this->config->item('admin_folder').'/locations/delete_zone_area/'.$location->id); ?>" onclick="return areyousure();"><i class="icon-trash icon-white"></i> <?php echo lang('delete');?></a>
				</div>
			</td>
	  </tr>
<?php endforeach; ?>
<?php if(count($areas) == 0):?>
		<tr>
			<td colspan="6">
				<?php echo lang('no_zone_areas');?>
			<td>
		</tr>
<?php endif;?>
	</tbody>
</table>