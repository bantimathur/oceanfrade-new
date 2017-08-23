<?php

class Home extends Front_Controller {

	function index()
	{
		
		//echo "Coming Soon....";exit;
		
		$this->load->model('banner_model');
		$this->load->model('location_model');
		$this->load->model('settings_model');
		$stripe_publish_key = $this->settings_model->get_set_value('stripe_publish_key');
		//pr($stripe_publish_key);exit;
		$stripe_publish_key = $stripe_publish_key[0]['setting'];
		$stripe_publish_key_usd = $this->settings_model->get_set_value('stripe_publish_key_usd');
		//pr($stripe_publish_key);exit;
		$stripe_publish_key_usd = $stripe_publish_key_usd[0]['setting'];
		$country = $this->location_model->get_countries_dropdown();
		$banner = $this->banner_model->banner_collections();
		$smallbanner =  $this->banner_model->banner_collection_banners($banner[1]->banner_collection_id,true);
		$banner =  $this->banner_model->banner_collection_banners($banner[0]->banner_collection_id,true);
		//$city = $this->location_model->get_city_port_listing_home("zone_id = 99","code","code");
		$page_county = $this->Page_model->get_page_country_list();
		//pr($page_county);exit;
		$data['banner'] = $banner;
		$data['smallbanner'] = $smallbanner;
		$data['country'] = $country;
		$data['stripe_publish_key'] = $stripe_publish_key;	
		$data['stripe_publish_key_usd'] = $stripe_publish_key_usd;
		$data['page_county'] = $page_county;	
		
		$this->view('homepage', $data);
	}

	
	function city_country_page($category,$name,$id,$type)
	{
		
		
		/*echo $category;
		echo "<hr>";
		echo $name;
		echo "<hr>";
		echo $id;
		echo "<hr>";
		echo $type;  */
		
		
		$this->load->model('banner_model');
		$this->load->model('location_model');
		$this->load->model('settings_model');
		$stripe_publish_key = $this->settings_model->get_set_value('stripe_publish_key');		
		$stripe_publish_key = $stripe_publish_key[0]['setting'];
		$stripe_publish_key_usd = $this->settings_model->get_set_value('stripe_publish_key_usd');		
		$stripe_publish_key_usd = $stripe_publish_key_usd[0]['setting'];
		$country = $this->location_model->get_countries_dropdown();	
		//pr($country);
		$page_county = $this->Page_model->get_page_country_list();
		//pr($page_county);exit;
		
		$data['country'] = $country;
		$data['stripe_publish_key'] = $stripe_publish_key;	
		$data['stripe_publish_key_usd'] = $stripe_publish_key_usd;
		$data['page_county'] = $page_county;
		$data['type'] = $type;		
	
		if($type == "countrytype") {
			$extra_con_for_similar = "(gc_page_custom_generate.ePrimary = '1' AND gc_page_custom_generate.iCountryId = $id) ";
			$template = "";
			$ex = "gc_page_custom_generate.iCategoryId = $category AND gc_page_custom_generate.ePrimary = '1' AND iCountryId = $id";
			$custom_pages = $this->Page_model->get_custom_pages($ex);
			//pr($custom_pages);exit;
			$data['custom_pages'] = $custom_pages;
			$data_page = $this->Page_model->gc_page_freight_category($category);
			$vCode = trim($data_page[0]['vCode']);
			$content = $this->Page_model->get_page_by_slug($vCode);
			$page_content = $content->content;
			//pr($page_content);
			$data['page_content'] = $page_content;			
			$similar_pages =  $this->Page_model->get_similar_pages($extra_con_for_similar,"gc_page_custom_generate.vCity ASC");
			$data['similar_pages'] = $similar_pages;
			$extra_con_for_similar = "(gc_page_custom_generate.ePrimary = '0' AND gc_page_custom_generate.iCountryId = $id)";
			$similar_pages_city =  $this->Page_model->get_similar_pages($extra_con_for_similar,"gc_page_custom_generate.vCity ASC");
			$data['similar_pages_city'] = $similar_pages_city;
			
			
			//pr($similar_pages_city); exit;
		} else {
			$ex = "gc_page_custom_generate.iCategoryId = $category AND gc_page_custom_generate.ePrimary = '0' AND iPageId = $id";
			$custom_pages = $this->Page_model->get_custom_pages($ex);
			$data['custom_pages'] = $custom_pages;
			$template = "";
			$current_page = $this->Page_model->get_similar_pages("iPageId = $id","gc_page_custom_generate.vCity ASC");
			
			$data_page = $this->Page_model->gc_page_freight_category($category);
			//pr($data);
			$vCode = $data_page[0]['vCode'];
			$content = $this->Page_model->get_page_by_slug($vCode);
			$page_content = $content->content;
			$data['page_content'] = $page_content;
			
			$data['similar_pages'] = array();
			$iCountryId = $current_page[0]['iCountryId'];
			$extra_con_for_similar = "(gc_page_custom_generate.ePrimary = '1' AND gc_page_custom_generate.iCountryId = $iCountryId) ";
			$similar_pages =  $this->Page_model->get_similar_pages($extra_con_for_similar,"gc_page_custom_generate.vCity ASC");
			$data['similar_pages'] = $similar_pages;
			$extra_con_for_similar = "iCountryId = $iCountryId AND gc_page_custom_generate.ePrimary != '1'";
			$similar_pages_city =  $this->Page_model->get_similar_pages($extra_con_for_similar,"gc_page_custom_generate.vCity ASC");
			//pr($similar_pages_city);exit;
			$data['similar_pages_city'] = $similar_pages_city;
		}

			
		$this->view('multipages', $data);
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
	
	function freightcity($country,$city) {
		//echo $city;exit;
		$data['page']	= $this->Page_model->get_page(16);
		$data['country']	= $country;
		$data['city']	= $city;
		$data['page']->content = str_replace("#DESTINATION#", $city, $data['page']->content);
		//	pr($data);exit;
		$this->view('page_city', $data);
	}

	function makeHtmlpage() {
		$path = FCPATH."citylist.csv";
		$html = FCPATH."test.html";
		$htmlcontent = file_get_contents($html);
		//echo $htmlcontent;exit;
		$file_handle = fopen($path,"r");
		while (!feof($file_handle) ) {
			$line_of_text[] = fgetcsv($file_handle, 1024);
		}
		//pr($line_of_text);exit;
		for($i=1;$i<count($line_of_text);$i++) {
			$htmlcontent = file_get_contents($html);
			$metatitle = $line_of_text[$i][3];
			$keyword = $line_of_text[$i][4];
			$description = $line_of_text[$i][5];
			$type = $line_of_text[$i][6];
			$heading = $line_of_text[$i][0];
			$cityname = $line_of_text[$i][1];
			$content = $line_of_text[$i][2];
			$image1 = $cityname."map";
			$image2 = $cityname."flag";
			$htmlcontent = str_replace("#METATITLE#",$metatitle,$htmlcontent);
			$htmlcontent = str_replace("#METAKEYWORD#",$keyword,$htmlcontent);
			$htmlcontent = str_replace("#METADESC#",$description,$htmlcontent);
			$htmlcontent = str_replace("#HEADING#",$heading,$htmlcontent);
			$htmlcontent = str_replace("#CONTENT#",$content,$htmlcontent);
			$htmlcontent = str_replace("#CITYMAP#",$image1,$htmlcontent);
			$htmlcontent = str_replace("#CITYFLAG#",$image2,$htmlcontent);
			//echo $htmlcontent;exit;
			$file_created_path = FCPATH."city-country/".$cityname.".html";
			$myfile = fopen($file_created_path, "w") or die("Unable to open file!");		
			fwrite($myfile, $htmlcontent);
			fclose($myfile);
			
		}

		echo "file created successfully";exit;
	}
	
	
	
	
	#################################################### pages generartions
	
	public function country_generation() {
		echo 'country genreartion succ';
		exit;
		$path = FCPATH."custompage/Countries.csv";
		$htmlcontent = file_get_contents($html);
		//echo $htmlcontent;exit;
		$file_handle = fopen($path,"r");
		while (!feof($file_handle) ) {
			$line_of_text[] = fgetcsv($file_handle, 1024);
		}
		//pr($line_of_text);exit;
		for($i=1;$i<count($line_of_text);$i++) {
			$insert_array = array();
			$insert_array['vName'] = $line_of_text[$i][1];
			$insert_array['eStatus'] = 'Active';			
			//$this->Page_model->insert_country($insert_array);
			
		}		
		echo 'country genreartion succ';
		exit;
	}
	
	public function city_generation() {
		#echo 'city list';
		$path = FCPATH."custompage/Cities.csv";
		$htmlcontent = file_get_contents($html);
		//echo $htmlcontent;exit;
		$file_handle = fopen($path,"r");
		while (!feof($file_handle) ) {
			$line_of_text[] = fgetcsv($file_handle, 1024);
		}
		//pr($line_of_text);
		for($i=2;$i<count($line_of_text);$i++) {			
			$text_name = @explode(',',$line_of_text[$i][1]);			
			$country_name = trim($text_name[1]);
			$city_name = trim($text_name[0]);
			$country_id = $this->Page_model->get_page_countryid($country_name);			
			if($country_id != "" && $city_name != "") {
				$insert_array = array();
				$insert_array['vName'] = $city_name;
				$insert_array['iCountryId'] = $country_id;
				$insert_array['eStatus'] = 'Active';				
				//$this->Page_model->insert_city($insert_array);
			} else {
				echo "<hr>";
				echo $line_of_text[$i][1];
				echo "<hr>";
				
			}
			
		}		
		echo 'country genreartion succ';
		exit;
	}
	
	###################### multi pages generations
	
	public function multipages_generate_country() {
	
		//get primary category
		//get country list which is active
		//loop + check recored exists or not
		$country_list = $this->Page_model->get_page_country_list();
		//$category = $this->Page_model->get_page_cat_list("ePrimary = '1'");
		$category = $this->Page_model->get_page_cat_list("ePrimary = '1' AND iCategoryId IN(19,20)");
		//pr($category);
		//pr($country_list);
		for($i=0;$i<count($country_list);$i++) {
			$iCountryId = $country_list[$i]['iCountryId'];
			$vName = $country_list[$i]['vName'];
			for($j=0;$j<count($category);$j++) {
				$iCategoryId = $category[$j]['iCategoryId'];
				$extra = "gc_page_custom_generate.iCategoryId = $iCategoryId AND iCountryId = $iCountryId AND gc_page_custom_generate. ePrimary = '1' ";
				$page_exists = $this->Page_model->get_similar_pages($extra);
				//pr($page_exists);exit;
				if(is_array($page_exists) && count($page_exists) == 0) {
					$insert_array = array();
					$insert_array['iCategoryId'] = $iCategoryId;
					$insert_array['ePrimary'] = '1';
					$insert_array['vCategoryCode'] = $category[$j]['vCode'];
					$insert_array['iCountryId'] = $iCountryId;
					$insert_array['iCityId'] = 0;
					$insert_array['vheading'] = $category[$j]['vCategoryName'] . ' to '.$vName;
					$insert_array['vCountry'] = $vName;
					$insert_array['eStatus'] = 'Active';
					//pr($insert_array);exit;
					$this->Page_model->insert_pages($insert_array);
				}
			}
		}
		echo "cron runs successfully";
		exit;
	}
	
	public function  multipages_generate_city() {
		$city_list = $this->Page_model->get_page_city_list();
		$category = $this->Page_model->get_page_cat_list("ePrimary = '0' AND iCategoryId IN(21,22)");
		//pr($category);
		//pr($city_list);exit;
		for($i=0;$i<count($city_list);$i++) {
			$iCountryId = $city_list[$i]['iCountryId'];
			$country_name = $city_list[$i]['countryname'];
			$city_name = $city_list[$i]['cityname'];
			$iCityId = $city_list[$i]['iCityId'];
			for($j=0;$j<count($category);$j++) {
				$iCategoryId = $category[$j]['iCategoryId'];
				$extra = "iCategoryId = $iCategoryId AND iCityId = $iCityId AND ePrimary = '0' ";
				$page_exists = $this->Page_model->get_similar_pages($extra);
				//pr($page_exists);exit;
				if(is_array($page_exists) && count($page_exists) == 0) {
					$insert_array = array();
					$insert_array['iCategoryId'] = $iCategoryId;
					$insert_array['ePrimary'] = '0';
					$insert_array['vCategoryCode'] = $category[$j]['vCode'];
					$insert_array['iCountryId'] = $iCountryId;
					$insert_array['iCityId'] = $iCityId;
					$insert_array['vheading'] = $category[$j]['vCategoryName'] . ' to '.$city_name.', '.$country_name;
					$insert_array['vCountry'] = $country_name;
					$insert_array['vCity'] = $city_name;					
					$insert_array['eStatus'] = 'Active';
					//pr($insert_array);exit;
					$this->Page_model->insert_pages($insert_array);
				}
			}
		}
		echo "cron runs successfully";
		exit;
	}
	
	public function createMeta() 
	{
		$allpages = $this->Page_model->get_all_pages();
		//pr($allpages);
	
		for($i=0;$i<count($allpages);$i++) 
		{
			$iPageId = $allpages[$i]['iPageId'];
			$keywords = "";
			$title = "";
			$description = "";
			$cit =  ($allpages[$i]['vCity'] == "") ? $allpages[$i]['vCountry'] : $allpages[$i]['vCity'].', '.$allpages[$i]['vCountry'];
			$title = $allpages[$i]['vheading']." | Ship My Freight";
			$title = $allpages[$i]['vheading']." | Ship My Freight";
			$keywords = $allpages[$i]['vheading'].", online (24/7) quote, international transportation, LCL, LCL Freight, LCL Ocean Shipping, Ocean Freight Shipping";
			$keywords .= ", Cheap Shipping to ".$cit;
			$description = $allpages[$i]['vheading']." to ".$cit. " from Toronto, Montreal, Vancouver, Canada in reliable, flexible and efficient manner";
			
			$update_arr = array();
			$update_arr['tMetaTile'] = $title;
			$update_arr['tMetaKeyWords'] = $keywords;
			$update_arr['tMetaDescription'] = $description;
			//pr($update_arr);
			//exit;
			$extra = "iPageId = $iPageId";
			$this->Page_model->updateMeta($update_arr,$extra);
			
		}
		echo "Cron runs successfully";exit;
		
	}
	
	
	public function setSiteMap()
	{
		
		$link_st = "http://shipmyfreight.ca/LCL/";
		$str = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
		$str .= "<url>
			<loc>$link_st</loc>
			<priority>1.00</priority>
		</url>
		<url>
			<loc>".$link_st."/about-us</loc>
			<priority>0.90</priority>
		</url>	
		<url>
			<loc>".$link_st."/services</loc>
			<priority>0.90</priority>
		</url>
		<url>
			<loc>".$link_st."/incoterms</loc>
			<priority>0.90</priority>
		</url>
		<url>
			<loc>".$link_st."/glossary</loc>
			<priority>0.90</priority>
		</url>
		<url>
			<loc>".$link_st."/faq</loc>
			<priority>0.90</priority>
		</url>
		<url>
			<loc>".$link_st."/how-lcl-works</loc>
			<priority>0.90</priority>
		</url>
		<url>
			<loc>".$link_st."/glossary</loc>
			<priority>0.90</priority>
		</url>";
		
		// get all  country link
		$page_county = $this->Page_model->get_page_country_list();
		//pr($page_county);
		for($i=0;$i<count($page_county);$i++) {
			$cval = strtolower($page_county[$i]['vName']);
			$link = $link_st."country/".$page_county[$i]['vMainCategoryId']."/".strtolower($page_county[$i]['vName'])."/".$page_county[$i]['iCountryId'];
			$str .= "<url>
				<loc>$link</loc>
				<priority>0.80</priority>				
				</url>";
		}
		
		$str .= '</urlset>';
		$path = '';
		$localpath = getenv("SCRIPT_NAME");
		$absolutepath = realpath($localPath)."/sitemap.xml";
		
		$file = fopen($absolutepath,"w");
		fwrite($file,$str);
		fclose($file);
	}
	
	
	
}