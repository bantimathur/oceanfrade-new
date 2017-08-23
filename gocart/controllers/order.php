<?php

class Order extends Front_Controller {

	function index()
	{
		$data['gift_cards_enabled'] = $this->gift_cards_enabled;
		$data['homepage']			= true;
		
		$this->view('homepage', $data);
	}

	function orderlist() {
		//echo $this->session->userdata('iUserId');exit;
		$this->load->model('order_model');
		$this->load->helper('directory');
		$this->load->helper('date');
		 $data['customer']			= (array)$this->Customer_model->get_customer($this->session->userdata('iUserId'));
		 //print_r($data);
			// paginate the orders
		$this->load->library('pagination');

		$config['base_url'] = site_url('secure/my_account');
		$config['total_rows'] = $this->order_model->count_customer_orders($this->session->userdata('iUserId'));
		$config['per_page'] = '599'; 
	
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';

		$config['full_tag_open'] = '<div class="pagination"><ul>';
		$config['full_tag_close'] = '</ul></div>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';

		$config['prev_link'] = '&laquo;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';

		$config['next_link'] = '&raquo;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		
		$this->pagination->initialize($config); 
		
		$data['orders_pagination'] = $this->pagination->create_links();

		$orders		= $this->order_model->get_customer_orders_list($this->session->userdata('iUserId'), $offset);
		
//echo "<pre>";
		//pr($orders);exit;
		$order_arr = array();
		for($i=0;$i<count($orders);$i++) {
			$image = getProductImage($orders[$i]['images'],'small');
			$order_arr["info".$orders[$i][order_id]]['order_id'] = $orders[$i]['order_id'];
			$order_arr["info".$orders[$i][order_id]]['order_number'] = $orders[$i]['order_number'];
			$order_arr["info".$orders[$i][order_id]]['status'] = $orders[$i]['status'];
			$order_arr["info".$orders[$i][order_id]]['total'] = $orders[$i]['total'];
			$order_arr["info".$orders[$i][order_id]]['ordered_on'] = $orders[$i]['ordered_on'];
			
			$order_arr["info".$orders[$i][order_id]]['product_info'][] = array("image" => $image,"slug" => $orders[$i]['slug'],"quantity" => $orders[$i]['quantity'],"contents" => $orders[$i]['contents'],"price" =>  $orders[$i]['price']);
		}
		//pr($order_arr);exit;
		$data['order_arr'] = $order_arr;
			$this->view('orderlist', $data);
	}
	
	function page($id = false)
	{
		//if there is no page id provided redirect to the homepage.
		$data['page']	= $this->Page_model->get_page($id);
		if(!$data['page'])
		{
			show_404();
		}
		$this->load->model('Page_model');
		$data['base_url']			= $this->uri->segment_array();
		
		$data['fb_like']			= true;

		$data['page_title']			= $data['page']->title;
		
		$data['meta']				= $data['page']->meta;
		$data['seo_title']			= (!empty($data['page']->seo_title))?$data['page']->seo_title:$data['page']->title;
		
		$data['gift_cards_enabled'] = $this->gift_cards_enabled;
		
		$this->view('page', $data);
	}
	
	function wishlist() {
		$this->load->model('wishlist_model');
		$iUserId = $this->session->userdata('iUserId');
		$where = "gc_wishlist.userid = $iUserId";
	
		$field = "COUNT(gc_wishlist.wishid) as totol";
		$data_arr = $this->wishlist_model->total_wishlist($where);
		//pr($data_arr);
		$data['total'] = $data_arr[0]['tot'];
		$this->view('wishlist', $data);
	}
	
public function wishlist_ajax()
	{                
//		print_r($_POST);
//                exit;
		$iUserId = $this->session->userdata('iUserId');
		$this->load->model('wishlist_model');
		$this->load->library('paginationaj');
		$this->load->helper('url');
		$paramsget = '';
		$value = isset($_POST['value']) ? $_POST['value'] : "";
		$type = isset($_POST['type']) ? $_POST['type'] : '';
		
		// $page = isset($_POST['page']) ? $_POST['page'] : '';
		$sortpass = $sort = isset($_POST['rel']) ? $_POST['rel'] : '';
		//$type = $_POST['type'];
		//$page = $_POST['page'];
		if($sort != "") {
			$sort = @explode("@#@",$sort);			
			$orderby = "$sort[0] $sort[1]";
		} else {
			$orderby = "gc_wishlist.wishid desc";	
		}
		$page = (($this->uri->segment(3)) == "") ? 0 : $this->uri->segment(3);            
		//$additional_param = "{'value':1,'dd':'sdd'}"; // 'dd':'sdd'
		$additional_param  = $sortpass = $sort = isset($_POST['rel']) ? $_POST['rel'] : '';
		//$type = $_POST['type'];
		//$page = $_POST['page'];
		
		//if($type != "" && $value != "") {
			$additional_param = "{'value':'$value','type':'$type','rel':'$sortpass'}";
		//}
		$myurl = $this->config->site_url().'/'.$this->router->fetch_class().'/'.$this->router->fetch_method();
		//$rowcount = $this->service_offer->getCount();
		$config['base_url'] = $myurl;
		//$config['total_rows'] = $rowcount;//$this->Users->getNumUsers();
		$config['per_page'] = 10;
		$config['div'] = '#wishlist-section';
		$config['last_link'] = 'Last';
		$config['additional_param'] = $additional_param;
		$config['page'] = $page;
		
	
		$where = "gc_wishlist.userid = $iUserId";
	
		$field = "gc_wishlist.*,gc_products.id AS productid,gc_products.name,gc_products.images,gc_products.saleprice as price,gc_products.slug";
		$data_arr = $this->wishlist_model->wishListRelDetails($field,"",$where,$orderby,"",$config);	
	
		//print_r($data_arr);exit;
		$this->load->view('wishlist_ajax',$data_arr);				
	}
	
	function wishlist_delete() {
		$this->load->model('wishlist_model');
		//print_r($_POST);
		$str = $_POST['str'];		
		$id = $this->wishlist_model->delete("gc_wishlist.wishid in($str)");
		if($id) {
			$jsonarr = array("succ" => "1");
		} else {
			$jsonarr = array("succ" => "0");
		}
		echo json_encode($jsonarr);
		exit;
	}
      

}