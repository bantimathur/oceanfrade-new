<?php

class Secure extends Front_Controller {
	
	var $customer;
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model(array('location_model'));
		$this->customer = $this->go_cart->customer();
	}
	
	function index()
	{
		show_404();
	}
	function login($ajax = false){
		$data = array();
		$this->view('login', $data);
	}
	
	function login_action($ajax = false)
	{
		//pr($this->input->post());
		//exit;
		$email = $this->input->post('username');
		$password = $this->input->post('password');
		$login = $this->Customer_model->login($email, $password, $remember);
		//echo $login;
		if($login) {
			redirect($this->config->item('site_url'));
		} else {
			$this->session->set_flashdata('message', "You have entered wrong username or password.");
			redirect($this->config->item('site_url')."login");
		}
		
	}
	
	function logout()
	{
		$this->session->sess_destroy();	
		//$this->Customer_model->logout();
		$this->session->set_flashdata('message', 'You are successfully logout.');
		redirect($this->config->site_url());
		//redirect('secure/login');
	}
	
	public function forgotpassword() {
		$data = array();
		$this->view('forgotpassword', $data);
	}
	
	public function forgotpassword_action() {
		
		$email = $this->input->post('email');
		$email_exists = $this->Customer_model->check_email($email);
		if($email_exists) {
			//
			$res = $this->db->where('id', '7')->get('canned_messages');
			$row = $res->row_array();
			$code = base64_encode($email);
			
			$reset_password_link = $this->config->site_url()."reset-password.html?code=$code";
			
			// {site_name}
			$row['subject'] = str_replace('#LINK#', $this->config->item('company_name'), $row['subject']);
			$row['content'] = str_replace('#LINK#', $reset_password_link, $row['content']);
			//echo $row['content'];exit;
			$this->load->library('email');
			
			$config['mailtype'] = 'html';
			
			$this->email->initialize($config);
	
			$this->email->from($this->config->item('email'), $this->config->item('company_name'));
			$this->email->to($email);
			
			$this->email->subject($row['subject']);
			$this->email->message(html_entity_decode($row['content']));
				$this->email->send();
			$this->session->set_flashdata('message', 'We have sent you reset password link.Please check your email address.');
			redirect($this->config->site_url()."forgotpassword");
		} else {
			$this->session->set_flashdata('message', 'Sorry! This email is not registered in our system.');
			redirect($this->config->site_url().'forgotpassword');
			//exit;
		}
	}
	
	public function reset_password() {
		$email = $this->input->get('code');
		$data = array();
		$data['email'] = $email;
		$this->view('reset_password', $data);
	}
	
	public function reset_password_action() {
		//pr($this->input->post());exit;
		$email = base64_decode($this->input->post('email'));
		$update_arr = array();
		$update_arr['password'] = $this->input->post('password');
		//pr($update_arr);
		$where = "email = '$email'";		
		$this->Customer_model->update_customer($where, $update_arr);
		$this->session->set_flashdata('message', 'Your password has been reset successfully.');
		redirect($this->config->site_url().'login');
	}
	
	
	
	
	public function check_unq_email_username() {
		//pr($this->input->post());
		
		$email = $this->input->post('email');
		$username = $this->input->post('username');
		
		$data = $this->Customer_model->check_unq_email_username($email,$username);
	
		$json_arr = array();
		$json_arr['username'] = "No";
		$json_arr['email'] = "No";
		if(count($data) == 0) {
			$json_arr['succ'] = '1';
		} else {
			$json_arr['succ'] = '0';
			if($data[0]['email'] == $email) {
				$json_arr['email'] = "Yes";
			} 
			if($data[0]['username'] == $username) {
				$json_arr['username'] = "Yes";
			}
			
		}
		echo json_encode($json_arr);
		exit;
	}
	
	function register(){
		$data = array();
		$this->view('register', $data);
	}
	
	function register_action()
	{
	
		//pr($this->input->post());
		
		

		
		if (0)
		{
			
		}
		else
		{
			
			
			
			$save['username']			= $this->input->post('username');
			$save['firstname']			= $this->input->post('name');
			$save['email']				= $this->input->post('email');
			$save['phone']				= $this->input->post('phonenumber');
			$save['company']			= $this->input->post('buisenessname');
			$save['active']				= 1;
			$save['password']			= $this->input->post('password');
			$save['scode']				= $this->input->post('scode');
			
			
			$redirect					= $this->input->post('redirect');
			
			//if we don't have a value for redirect
			if ($redirect == '')
			{
				$redirect = 'thankforregister';
			}
			//pr($save);exit;
			// save the customer info and get their new id
			$id = $this->Customer_model->save($save);

			/* send an email */
			// get the email template
			$res = $this->db->where('id', '6')->get('canned_messages');
			$row = $res->row_array();
			
			// set replacement values for subject & body
			
			// {customer_name}
			$row['subject'] = str_replace('{customer_name}', $this->input->post('name').' '. $this->input->post('lastname'), $row['subject']);
			$row['content'] = str_replace('{customer_name}', $this->input->post('name').' '. $this->input->post('lastname'), $row['content']);
			
			// {url}
			$row['subject'] = str_replace('{url}', $this->config->item('base_url'), $row['subject']);
			$row['content'] = str_replace('{url}', $this->config->item('base_url'), $row['content']);
			
			// {site_name}
			$row['subject'] = str_replace('{site_name}', $this->config->item('company_name'), $row['subject']);
			$row['content'] = str_replace('{site_name}', $this->config->item('company_name'), $row['content']);
			
			$this->load->library('email');
			
			$config['mailtype'] = 'html';
			
			$this->email->initialize($config);
	
			$this->email->from($this->config->item('email'), $this->config->item('company_name'));
			$this->email->to($save['email']);
			$this->email->bcc($this->config->item('email'));
			$this->email->subject($row['subject']);
			$this->email->message(html_entity_decode($row['content']));
			//echo $this->config->item('email');
			//echo $row['content'];exit;
			$this->email->send();
			
			$this->session->set_flashdata('message', sprintf( lang('registration_thanks'), $this->input->post('firstname') ) );
			
			redirect($redirect);
		}
	}
	
	function check_email($str)
	{
		//echo "ddd";exit;
	if(!empty($this->customer['id']))
		{
			$email = $this->Customer_model->check_email($str, $this->customer['id']);
		}
		else
		{
			$email = $this->Customer_model->check_email($str);
		}
		
        if ($email)
       	{
			//echo lang('error_email');exit;
			$this->form_validation->set_message('check_email', lang('error_email'));
			$this->session->set_flashdata('error',  lang('error_email'));
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function forgot_password()
	{
		$data['page_title']	= lang('forgot_password');
		$data['gift_cards_enabled'] = $this->gift_cards_enabled;
		$submitted = $this->input->post('submitted');
		if ($submitted)
		{
			$this->load->helper('string');
			$email = $this->input->post('email');
			
			$reset = $this->Customer_model->reset_password($email);
			
			if ($reset)
			{						
				$this->session->set_flashdata('message', lang('message_new_password'));
			}
			else
			{
				$this->session->set_flashdata('error', lang('error_no_account_record'));
			}
			redirect('forgot-password');
		}
		
		// load other page content 
		//$this->load->model('banner_model');
		$this->load->helper('directory');
	
		//if they want to limit to the top 5 banners and use the enable/disable on dates, add true to the get_banners function
		//$data['banners']	= $this->banner_model->get_banners();
		//$data['ads']		= $this->banner_model->get_banners(true);
		$data['categories']	= $this->Category_model->get_categories_tiered();
		
		
		$this->view('forgot_password', $data);
	}
	
	public function thankyou() {
		$data = array();
		$this->view('thankforregister', $data);
	}
	
	
}