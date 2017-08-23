<?php
Class Page_model extends CI_Model
{

	/********************************************************************
	Page functions
	********************************************************************/
	function get_pages($parent = 0)
	{
		$this->db->order_by('sequence', 'ASC');
		$this->db->where('parent_id', $parent);
		$result = $this->db->get('pages')->result();
		
		$return	= array();
		foreach($result as $page)
		{

			// Set a class to active, so we can highlight our current page
			if($this->uri->segment(1) == $page->slug) {
				$page->active = true;
			} else {
				$page->active = false;
			}

			$return[$page->id]				= $page;
			$return[$page->id]->children	= $this->get_pages($page->id);
		}
		
		return $return;
	}

	function get_pages_tiered()
    {
		$this->db->order_by('sequence', 'ASC');
		$this->db->order_by('title', 'ASC');
		$pages = $this->db->get('pages')->result();
		
		$results	= array();
		foreach($pages as $page)
		{
			$results[$page->parent_id][$page->id] = $page;
		}
		
		return $results;
	}

	function get_page($id)
	{
		$this->db->where('id', $id);
		$result = $this->db->get('pages')->row();
		
		return $result;
	}
	
	function get_slug($id)
	{
		$page = $this->get_page($id);
		if($page) 
		{
			return $page->slug;
		}
	}
	
	function save($data)
	{
		if($data['id'])
		{
			$this->db->where('id', $data['id']);
			$this->db->update('pages', $data);
			return $data['id'];
		}
		else
		{
			$this->db->insert('pages', $data);
			return $this->db->insert_id();
		}
	}
	
	function delete_page($id)
	{
		//delete the page
		$this->db->where('id', $id);
		$this->db->delete('pages');
	
	}
	
	
	
	function get_page_by_slug($slug)
	{
		$this->db->where('slug', $slug);
		$result = $this->db->get('pages')->row();
		
		return $result;
	}
	
	function get_page_country_list(){
		$sql = "select `iCountryId`,vName,vMainCategoryId
				from gc_page_freight_country
				where eStatus = 'Active'";
		return $data = $this->db->query($sql)->result_array();
		
	}
	
	function  gc_page_freight_category($iCategoryId) {
		$sql = "select `iCategoryId`,vCategoryName,vCode
				from  gc_page_freight_category
				where iCategoryId = $iCategoryId AND eStatus = 'Active'";
				
		return $data = $this->db->query($sql)->result_array();
	}
	
	function  get_similar_pages($where,$order_by) {
		$sql = "SELECT * FROM gc_page_custom_generate 
				where gc_page_custom_generate.eStatus='Active' and $where";
				if($order_by !=""){
					$sql .= " order by $order_by";
				}
				
		return $data = $this->db->query($sql)->result_array();		
	}
	
	function  get_custom_pages($where) {
		$sql = "SELECT gc_page_freight_category.vCategoryName,gc_page_custom_generate.* FROM gc_page_custom_generate 
				inner join gc_page_freight_category on gc_page_freight_category.iCategoryId = gc_page_custom_generate.iCategoryId
				where gc_page_custom_generate.eStatus='Active' and $where limit 1";
		return $data = $this->db->query($sql)->result_array();		
	}
	
	############################################ Make the code Pages
	function insert_country($data) {
		$this->db->insert('page_freight_country', $data);
	}
	function insert_pages($data) {
		$this->db->insert('gc_page_custom_generate', $data);
	}
	
	function get_page_countryid($countryname) {
		$sql = "select `iCountryId`
				from gc_page_freight_country
				where vName = '$countryname'";
		$data = $this->db->query($sql)->result_array();
		return $data[0]['iCountryId'];
		
	}
	
	function insert_city($data) {
		$this->db->insert('page_freight_city', $data);
	}
	
	
	
	function get_page_cat_list($where) {
		$sql = "SELECT * FROM gc_page_freight_category WHERE $where";
		return $data = $this->db->query($sql)->result_array();
	
	} 
	
	
	function get_page_city_list(){
		$sql = "select iCityId,gc_page_freight_city.vName as cityname,gc_page_freight_country.iCountryId,gc_page_freight_country.vName as countryname
				from gc_page_freight_city
				inner join gc_page_freight_country on gc_page_freight_country.iCountryId = gc_page_freight_city.iCountryId
				where gc_page_freight_city.eStatus = 'Active' AND gc_page_freight_city.iCityId < 400 AND gc_page_freight_city.iCityId > 0";
		return $data = $this->db->query($sql)->result_array();
		
	}
	
	
	function get_all_pages()
	{
		$sql = "SELECT * FROM gc_page_custom_generate where tMetaTile = ''";
		return $data = $this->db->query($sql)->result_array();
	}
	
	function updateMeta($data,$where) {
			$this->db->where($where);
			$this->db->update('gc_page_custom_generate', $data);
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
}