<?php
class Location_model extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
	}
	
	//zone areas
	function save_zone_area($data)
	{
		if(!$data['id']) 
		{
			$this->db->insert('country_zone_areas', $data);
			return $this->db->insert_id();
		} 
		else 
		{
			$this->db->where('id', $data['id']);
			$this->db->update('country_zone_areas', $data);
			return $data['id'];
		}
	}
	
	function delete_zone_areas($country_id)
	{
		$this->db->where('zone_id', $country_id)->delete('country_zone_areas');
	}
	
	function delete_zone_area($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('country_zone_areas');
	}
	
	function get_zone_areas($country_id) 
	{
		$this->db->where('zone_id', $country_id);
		return $this->db->get('country_zone_areas')->result();
	}
	
	function get_zone_area($id)
	{
		$this->db->where('id', $id);
		return $this->db->get('country_zone_areas')->row();
	}
	
	//zones
	function save_zone($data)
	{
		if(!$data['id']) 
		{
			$this->db->insert('country_zones', $data);
			return $this->db->insert_id();
		} 
		else 
		{
			$this->db->where('id', $data['id']);
			$this->db->update('country_zones', $data);
			return $data['id'];
		}
	}
	
	function delete_zones($country_id)
	{
		$this->db->where('country_id', $country_id)->delete('country_zones');
	}
	
	function delete_zone($id)
	{
		$this->delete_zone_areas($id);
		
		$this->db->where('id', $id);
		$this->db->delete('country_zones');
	}
	
	function get_zones($country_id) 
	{
		$this->db->where('country_id', $country_id);
		return $this->db->get('country_zones')->result();
	}
	
	
	function get_zone($id)
	{
		$this->db->where('id', $id);
		return $this->db->get('countries')->row();
	}
	
	
	
	//countries
	function save_country($data)
	{
		if(!$data['id']) 
		{
			$this->db->insert('countries', $data);
			return $this->db->insert_id();
		} 
		else 
		{
			$this->db->where('id', $data['id']);
			$this->db->update('countries', $data);
			return $data['id'];
		}
	}
	
	function organize_countries($countries)
	{
		//now loop through the products we have and add them in
		$sequence = 0;
		foreach ($countries as $country)
		{
			$this->db->where('id',$country)->update('countries', array('sequence'=>$sequence));
			$sequence++;
		}
	}
	
	function get_countries()
	{
		return $this->db->order_by('sequence', 'ASC')->get('countries')->result();
	}
	
	function get_country_by_zone_id($id)
	{
		$zone	= $this->get_zone($id);
		return $this->get_country($zone->country_id);
	}
	
	function get_country($id)
	{
		$this->db->where('id', $id);
		return $this->db->get('countries')->row();
	}
	
	
	function delete_country($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('countries');
	}
	
	
	function get_countries_menu()
	{	
		$countries	= $this->db->order_by('sequence', 'ASC')->where('status', 1)->get('countries')->result();
		$return		= array();
		foreach($countries as $c)
		{
			$return[$c->id] = $c->name;
		}
		return $return;
	}
	
	function get_zones_menu($country_id)
	{
		$zones	= $this->db->where(array('status'=>1, 'country_id'=>$country_id))->get('country_zones')->result();
		$return	= array();
		foreach($zones as $z)
		{
			$return[$z->id] = $z->name;
		}
		return $return;
	}
	
	function has_zones($country_id)
	{
		if(!$country_id)
		{
			return false;
		}
		$count = $this->db->where('country_id', $country_id)->count_all_results('country_zones');
		if($count > 0)
		{
			return true;
		} else {
			return false;
		}
	}

	/*
	// returns array of strings formatted for select boxes
	function get_countries_zones()
	{
		$countries = $this->db->get('countries')->result_array();
		
		$list = array();
		foreach($countries as $c)
		{
			if(!empty($c['name']))
			{		
				$zones =  $this->db->where('country_id', $c['id'])->get('country_zones')->result_array();
				$states = array();
				foreach($zones as $z)
				{
					// todo - what to put if there are no zones in a country?
					
					if(!empty($z['code']))
					{
						$states[$z['id']] = $z['name'];
					}
				}
				
				$list[$c['name']] = $states;
			}
		}
		
		return $list;
	}
	*/
	
	function get_city_port($where,$fld)
	{
		$this->db->select($fld);
		if($where != "") {
			$this->db->where($where);
		}		
		return $this->db->get('country_zone_areas')->result();
	}
	
	function insert_zone_areas($data) {
		$this->db->insert('gc_country_zone_areas', $data);
		return $this->db->insert_id();
	}
	
	function get_countries_dropdown()
	{
		$this->db->where('status = 1');
		return $this->db->order_by('name', 'ASC')->get('countries')->result();
	}

	function get_city_port_listing_home($where,$fld,$groupby)
	{
		$this->db->select($fld);
		if($where != "") {
			$this->db->where($where);
		}
		if($groupby != "") {
			$this->db->group_by($groupby);
		}	
		return $this->db->get('country_zone_areas')->result();
	}
	###################### new code for import
	function update_importtype($country)
	{
		$data = array("import" => 'Yes');
		$this->db->where("gc_countries.name = '$country'");
		$this->db->update('gc_countries', $data);
	}
	
	public function checkCityExists($where) {
		$this->db->select("gc_country_zones.name,id");
		$this->db->from("gc_country_zones");
		$this->db->where($where);
		return $data = $this->db->get()->result_array();
		//echo $this->db->last_query();
		//pr($data);
	}
	
	public function insertCity($where) {
		$this->db->select("gc_country_zones.name,id");
		$this->db->from("gc_country_zones");
		$this->db->where($where);
		return $data = $this->db->get()->result_array();
		//echo $this->db->last_query();
		//pr($data);
	}
	
	public function insertCityToMaster($data) {
		$this->db->insert('gc_country_zones', $data);
		return $this->db->insert_id();
	}
	
	public function insertIntoImportTable($data)
	{
		$this->db->insert('gc_country_zone_areas_import', $data);
		return $this->db->insert_id();
	}
	
	public function getImportCity($where)
	{
		$this->db->select("gc_country_zone_areas_import.code,gc_country_zone_areas_import.id,vSailingFrequency,cityid");
		$this->db->from("gc_country_zone_areas_import");
		$this->db->where($where);
		$this->db->group_by("gc_country_zone_areas_import.code");
		return $data = $this->db->get()->result_array();
		
	}
	
	
	function get_city_port_import($where,$fld)
	{
		$this->db->select($fld);
		if($where != "") {
			$this->db->where($where);
		}		
		return $this->db->get('gc_country_zone_areas_import')->result();
	}
	
	
	
}	