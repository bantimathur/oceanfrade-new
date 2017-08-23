<?php
class wishlist_model extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        $this->load->database();
        parent::__construct();
    }
      

    
    function insert($data) {
        $this->db->insert('gc_wishlist', $data);
        return $this->db->insert_id();
    }
    
    function update($data,$where) {        
        $this->db->where($where);
        return $this->db->update('gc_wishlist', $data); 
    }
    
    function delete($where) {        
        $this->db->where($where);
        return $this->db->delete('gc_wishlist'); 
    }
    
  
    
      function productDetails($field="",$join="",$where="",$orderby="",$groupby="",$config)
    {        
                       
        $this->db->select("$field");           
        $this->db->from('product');        
        $this->db->join('company','company.iCompanyId = product.iCompanyId','left');
        $this->db->join('category','category.iCatagoryId = product.iCategoryId','left');
        if($where != "") {
            $this->db->where($where);    
        }
        $query = $this->db->get();
        $res = $query->result_array();        
        return $res;
    }
    
    
    function wishListRelDetails($field="",$join="",$where="",$orderby="",$groupby="",$config)
    {        
        //$this->db->where('sales_register.tDesption = 45 AND sales_register.iSalesId = 2');
        
        $this->load->library('paginationaj');
        $this->load->helper('url');
        //$this->db->where("product.eStatus = 'Active'");
               
        $this->db->select("count(gc_wishlist.wishid) as tot");           
        $this->db->from('gc_wishlist');        
        $this->db->join('gc_products','gc_wishlist.productid = gc_products.id','inner');
    
        if($where != "") {
            $this->db->where($where);    
        }
        $query = $this->db->get();
        $res = $query->result_array();
        
        $config['total_rows'] = $res[0]['tot'];
        //print_r($config);exit;
         $this->paginationaj->initialize($config);
        if($field == "") {
            $this->db->select('product.*');   
        } else {
            $this->db->select($field);   
        }
        
        $this->db->from('gc_wishlist');
         $this->db->join('gc_products','gc_wishlist.productid = gc_products.id','inner');
        
         if($where != "") {
            $this->db->where($where);    
        }
        //$this->db->where("product.eStatus = 'Active'");
        if($orderby != "") {
            $this->db->order_by($orderby); 
        }
        
            $offset = (intval($config['page'])*1) ;
        $limit = $config['per_page'];
        
        //$offset = (intval($config['page'])*1) * $config['per_page'];
        //$limit = $config['per_page'];
        $this->db->limit($limit,$offset);
        //echo "dd";exit;
        $query = $this->db->get();
        $this->db->last_query();  
        //print_r($query);exit;
        $res = $query->result_array();
        $final_data['links'] = $this->paginationaj->create_links();
        $final_data['wishlist'] = $res;
        return $final_data;
    }
    
	function total_wishlist($where) {
		$this->db->select("count(gc_wishlist.wishid) as tot");           
        $this->db->from('gc_wishlist');        
        $this->db->join('gc_products','gc_wishlist.productid = gc_products.id','inner');
		if($where != "") {
            $this->db->where($where);    
        }
        $query = $this->db->get();
        return $res = $query->result_array();
	}

}
?>