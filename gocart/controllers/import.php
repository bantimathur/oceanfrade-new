<?php

class Import extends Front_Controller {

	public function index()
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
		//pr($country);exit;
	///$country = $this->location_model->get_import_countries_dropdown();
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
		
			$data['seo_title'] = 'Instant LCL Quote solutions for all your shipping | Import to Canada';	
		$data['meta'] = 'Ocean shiping to Toronto, Montreal, Vancouver from world wide with competative prices.Get Instant Quate online 24/7.Get your free quote today';	
		$data['seo_keywords'] = 'Ocean Freight, Ocean Freight Consolidation, Ocean Freight  Shipping,  LCL Freight, LCL Ocean Shipping, Import shipping, Import, Import Quote, Import goods to canada';
		//pr($data);exit;
		$this->view('import', $data);
	}
	
	function getPort() {
	
		$this->load->model('location_model');
		//pr($this->input->post());
		$zone_id = $this->input->post('zone_id');
		$eOrigin = $this->input->post('eOrigin');
		//pr($this->input->post());
	
		$where = "gc_country_zone_areas_import.zone_id = '$zone_id'";
		$city =  $this->location_model->getImportCity($where);	
		//$city = object($city);
		//pr($city);
		$str = "";
		$str .= "<select class='last' name='vDestCity' id='vDestCity' tabindex='2'>";
		$str .= "<option value=''>City / Port</option>";
		for($i=0;$i<count($city);$i++) {
			$city_names = strtolower($city[$i]['code']);
			$str .= "<option rel='".$city[$i]['vSailingFrequency']."' value='".$city[$i]['cityid']."'>$city_names</option>";
		}
		$str .= "</select>";
		echo $str;exit;
	}
	
	
	function calculate_total() {
		
		//pr($this->input->post());
		$this->load->model('order_model');
		$this->load->model('location_model');
		$vOrigin = $this->input->post('vOrigin');
		$countries = $this->input->post('countries');
		$vDestCity = $this->input->post('vDestCity');
		$skid_arr = $this->input->post('iNoOfSkids');
		$iLength_arr = $this->input->post('iLength');
		$iWidth_arr = $this->input->post('iWidth');
		$iHeight_arr = $this->input->post('iHeight');
		$fWeightPItem_arr = $this->input->post('fWeightPItem');
		$dimension = $this->input->post('dimension');
		
		$gross_cbm = 0;
		$gross_weight = 0;		
		//pr($skid_arr);exit;
		if(count($skid_arr) > 0) {
			$order_arr = array();
			$order_arr['order_number'] = '';
			$order_arr['status'] = 'Order Coming';
			$order_arr['customer_id'] = '';
			$order_arr['ordered_on'] = date("Y-m-d H:i:s");;
			$order_arr['vOrigin'] = $vOrigin;
			$order_arr['vDestCountry'] = $countries;
			$order_arr['vDestCity'] = $vDestCity;
			$order_arr['dimension_type'] = $dimension;
			$order_arr['import'] = 'Yes';
				
			$rtn_arr = $this->order_model->save_order($order_arr);
			$orderid = $rtn_arr['id'];
			$refno = $rtn_arr['order_number'];
		}
		
		for($i=0;$i<count($skid_arr);$i++) {
			$items = array();
			$items['iNoOfSkids'] = $iNoOfSkids = $skid_arr[$i];
			$items['iLength'] 	 = $iLength = $iLength_arr[$i];
			$items['iWidth']  	 = $iWidth = $iWidth_arr[$i];
			$items['iHeight']    = $iHeight = $iHeight_arr[$i];
			$items['fWeightPItem']  = $fWeightPItem = $fWeightPItem_arr[$i];
			
			if($dimension == "cm/kg") {
				$total_weight_lbs = ($iNoOfSkids) * ($fWeightPItem);
				$cubic_feet = ((($iLength)*0.393) * (($iWidth)*0.393) * (($iHeight)*0.393)) / 1728;
				$total_volume_cbm = $cubic_feet / 35.3145;	
				$total_volume_cbm = $iNoOfSkids * $total_volume_cbm;			
				
				$total_weight_lbs_2 = $iNoOfSkids * $fWeightPItem;
				$total_volume_cbm_2 = $fWeightPItem / 1000;
				$total_volume_cbm_2 = $iNoOfSkids * $total_volume_cbm_2;
			} else {
				$total_weight_lbs = ($iNoOfSkids) * ($fWeightPItem);
				$cubic_feet = (($iLength) * ($iWidth) * ($iHeight)) / 1728;
				$total_volume_cbm = $cubic_feet / 35.3145;	
				$total_volume_cbm = $iNoOfSkids * $total_volume_cbm;			
				
				$total_weight_lbs_2 = $iNoOfSkids * $fWeightPItem;
				$fWeightPItem = $fWeightPItem / 2.205;
				$total_volume_cbm_2 = $fWeightPItem / 1000;
				$total_volume_cbm_2 = $iNoOfSkids * $total_volume_cbm_2;
			}
				
			$total_volume_dim_cbm = $total_volume_cbm;
			if($total_volume_cbm < $total_volume_cbm_2) {
				$total_volume_cbm =  $total_volume_cbm_2;
				$set_custom_message = "Yes";
				
			}
			
			$gross_cbm = $gross_cbm + $total_volume_cbm;
			$gross_weight = $gross_weight + $total_weight_lbs;
			$items['fTotalVolumeDimCBM'] = $total_volume_dim_cbm;
			$items['fTotalVolumeCBM'] = $total_volume_cbm;
			$items['fTotalWeightLBS'] = $total_weight_lbs;
			$items['order_id'] = $orderid;
			//pr($items);
			$this->order_model->insert_items($items);
		}
		$gross_cbm = round($gross_cbm,2);
		if($set_custom_message == "Yes") {
	$custom_message = 'Rate is based on "Weight Dimensional", <br/> basis i.e '.  $gross_cbm.' CBM';
			//$custom_message .= "<span style='color:red'>$custom_message</span>"; 
		}
		
		//error_reporting(E_ALL);
		//$gross_cbm = number_format($gross_cbm,'.','2');
		// create a order  in db + return the quate number
		
		$where = "gc_country_zone_areas_import.cityid = '$vDestCity' AND gc_country_zone_areas_import.eOrigin = '$vOrigin'";
		$fld = "fCBMRate,fMinimumCharges,fBLCharge";
		$cbm_info = $this->location_model->get_city_port_import($where,$fld);
	
		//pr($cbm_info);exit;
		$blfee = $cbm_info[0]->fBLCharge;
		$fCBMRate = $cbm_info[0]->fCBMRate;
		$fMinimumCharges = $cbm_info[0]->fMinimumCharges;
		if($fCBMRate < $fMinimumCharges) {
			$fCBMRate = $fMinimumCharges;
		}
		//echo $fCBMRate;exit;
		$custom_message = ($gross_cbm < 1) ? 'Minimum charge : 1 CBM' : $custom_message;
		$gross_cbm = ($gross_cbm < 1) ? 1 : $gross_cbm;
		//echo $gross_cbm;	
		//echo "<hr>";
		//echo $gross_weight; 
		
		// calucaltion of price and update in order table
		$this->load->model('settings_model');
		$admin_email = $this->settings_model->get_set_value('email');
		$admin_email = $admin_email[0]['setting'];
		$exchangerate = $this->settings_model->get_set_value('exchangerate');
		
		$exchangerate = $exchangerate[0]['setting'];
		$handlingfee = $this->settings_model->get_set_value('handlingfee');
		$handlingfee = $handlingfee[0]['setting'];
		$exportdeclarationfee = $this->settings_model->get_set_value('exportdeclarationfee');
		$exportdeclarationfee = $exportdeclarationfee[0]['setting'];
		$othersfee = $this->settings_model->get_set_value('othersfee');
		$othersfee = $othersfee[0]['setting'];
		$total_price = $gross_cbm * $fCBMRate;
		
		$total_price = $total_price + $handlingfee  + $exportdeclarationfee + $othersfee + $blfee;
		
		$total_price = number_format($total_price,2,'.','');		
		$canadian_total_price = $total_price * $exchangerate;
		$canadian_total_price = number_format($canadian_total_price,2,'.','');
		$where = "id = '$orderid'";
		$update_arr = array( "total" => $total_price,"subtotal" => $total_price,"handlingfee" => $handlingfee,"exportdeclarationfee" => $exportdeclarationfee,
						"othersfee" => $othersfee,"custommessage" => $custom_message,"blfee" =>  $blfee
						);
		//pr($update_arr);exit;
		$this->order_model->update_order($where,$update_arr);
		$this->send_quate('Cal',$refno);
		$json_arr = array('suuc' => 1,'gross_cbm' => $gross_cbm,'gross_weight' => $gross_weight,'refno' => $refno,'orderid' => $orderid,
							'total_price' => $total_price,'canadian_total_price' => $canadian_total_price,'custom_message' => $custom_message);
		echo json_encode($json_arr);	
		exit;
	}
	
		// this function is used for sending mail to the user
	function send_quate($type='',$order_number) {
		$this->load->model('order_model');
		$this->load->model('settings_model');
		
		//pr($this->input->post());exit;
		$to = $this->input->post('sender_email');
		//$order_number = $this->input->post('order_number');
		//$order_number = "144999673446";
		$admin_email = $this->settings_model->get_set_value('email');
		$admin_email = $admin_email[0]['setting'];
		
		$exchangerate = $this->settings_model->get_set_value('exchangerate');		
		$exchangerate = $exchangerate[0]['setting'];
		if($type == "Cal") {
			$to = $admin_email;
		} else {
			$order_number = $this->input->post('order_number');
		}
	
		$myquate = $this->order_model->order_information($order_number);
		//pr($myquate);exit;
		$custommessage = strip_tags($myquate[0]['custommessage']);
		$vOrigin = $myquate[0]['vOrigin'];
		$vQuote = $myquate[0]['order_number'];
		$vDestCountry = $myquate[0]['vDestCountry'];
		$vDestCity = $myquate[0]['vDestCity'];
		//$destination_info = $this->order_model->getDestinationINFO($vDestCity);
		$ex = "gc_country_zone_areas_import.eOrigin = '$vOrigin' AND gc_country_zone_areas_import.cityid = '$vDestCity' and gc_country_zone_areas_import.zone_id = '$vDestCountry'";
		$destination_info = $this->order_model->getDestinationINFOImport($ex);
		//pr($destination_info);exit;
		$city = $destination_info[0]['city'];
		$country = $destination_info[0]['country'];
		$total = $myquate[0]['total'];;
		$handlingfee  = $myquate[0]['handlingfee'];;
		$order_items = $myquate['order_items'];
		
		$total = number_format($total,2,'.','');		
		$canadian_total_price = $total * $exchangerate;
		$canadian_total_price = number_format($canadian_total_price,2,'.','');
		//pr($order_items);exit;
		$src = $this->config->site_url()."images/logo.png";
		$html_str = "<img src='$src' />";
		if($type == "Cal" || 1) {
			$html_str .= "<br><br>";
			$html_str .= "<div>";
			$html_str .= "<span><b>Quote : </b>$vQuote</span>";
			$html_str .= "<br>";
			$html_str .= "<span><b>Origin : </b>$city, $country</span>";
			$html_str .= "<br>";
			$html_str .= "<span><b>Destination: </b>$vOrigin</span>";		
			$html_str .= "</div>";
		}
		$dimension_type = ($myquate[0]['dimension_type'] == "in/lbs") ? "LBS" : "KGS";
		$html_str .= '<table width="100%"  cellspacing="1" cellpadding="1" border="1">';
        $html_str .=  "<tbody><tr><td>No.of SKD</td><td>L</td><td>W</td><td>H</td><td>Weight Per Item</td><td>Total Volume in CBM(dims)</td><td>Total Weight in $dimension_type </td>";
		
        $sum_fTotalVolumeCBM = 0;
		$sum_fTotalWeightLBS = 0;
		//pr($order_items);
		for($i=0;$i<count($order_items);$i++) {
			$iNoOfSkids = $order_items[$i]['iNoOfSkids'];
			$iLength = $order_items[$i]['iLength'];
			$iWidth = $order_items[$i]['iWidth'];
			$iHeight = $order_items[$i]['iHeight'];
			$fWeightPItem = $order_items[$i]['fWeightPItem'];
			$fTotalVolumeCBM = $order_items[$i]['fTotalVolumeCBM'];
			$fTotalVolumeDimCBM = $order_items[$i]['fTotalVolumeDimCBM'];
			$fTotalWeightLBS = $order_items[$i]['fTotalWeightLBS'];
			$sum_fTotalVolumeCBM += $fTotalVolumeDimCBM;
			$sum_fTotalWeightLBS += $fTotalWeightLBS;
			if($type == "Cal") {
				$display_cbm = $fTotalVolumeDimCBM;
			} else {
				$display_cbm = $fTotalVolumeDimCBM;
			}
			$html_str .=   "<tr >
						<td>$iNoOfSkids</td>
                       <td>$iLength</td>
                       <td>$iWidth</td>
                       <td>$iHeight</td>
                       <td>$fWeightPItem</td>
                       <td>$display_cbm</td>
                       <td>$fTotalWeightLBS</td>                    
                     </tr>";
		}
		$html_str .=   "<tr >
						<td colspan='5' ></td>
                       <td  > <b>  $sum_fTotalVolumeCBM</b></td>
                       <td><b>  $sum_fTotalWeightLBS</b></td>                    
                     </tr>";
	 $html_str .=   "<tr >
                       <td colspan='7' align='center'><b> Total Price USD $total</b><br>
					   <b> Total Price  CAD $canadian_total_price</b>
					   </td>
                                         
                     </tr>";
			 $html_str .='</tbody></table>';
			 if($type == "Cal" || 1) {
				$html_str .= "<br>";
				$html_str .= "<span style='color:red'>* ".$custommessage."</span>";
			 }
			 
			 $html_str .= "<br>";
			 $html_str .= "<div style='font-style: italic'>Note: Rates are for estimated purposes only and will be charged as per measurements received from CFS.</div>";
			 //echo $html_str;exit;
		
		
		$to = $to;
		//$subject = "Your quote";
		$subject = "Quote $vQuote $city, $country to $vOrigin";
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers = "From: $admin_email\r\n"."X-Mailer: php";
		
		$headers = "From: $admin_email" . "\r\n" .
                'Reply-To: me@gmail.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion() . "\r\n" .
                'Content-Type: text/html; charset=ISO-8859-1'."\r\n".
                'MIME-Version: 1.0'."\r\n\r\n";
		
		@mail($to,$subject,$html_str,$headers);
			if($type == "Cal") { 
				return false;
			} else {
				echo "success";
				exit;
			}
		
	
		
	}
	
	
	// script to prepare
	public function import_data() {
		echo 'testdata';
		exit;
		//error_reporting(E_ALL);
		$this->load->model('location_model');
		$country = $this->location_model->get_countries();
		//pr($country);
		$temp_country = array();
		for($i=0;$i<count($country);$i++) {
			$temp_country[ucfirst($country[$i]->name)] = $country[$i]->id;
		}
		//error_reporting(E_ALL);
		//pr($temp_country);
		//exit;
		$path = FCPATH."importcsv.csv";
		$htmlcontent = file_get_contents($html);		
		$file_handle = fopen($path,"r");
		while (!feof($file_handle) ) {
			$line_of_text[] = fgetcsv($file_handle, 1024);
		}
		//pr($line_of_text);exit;
		for($i=1;$i<count($line_of_text);$i++) {
			
			$cda = explode(', ',$line_of_text[$i][2]);
			$country = trim($cda[1]);	
			$city  = trim($cda[0]);
			$zone_id = $temp_country[$country];
			//pr($cda);exit;
			$this->location_model->update_importtype($country);
			$where = "gc_country_zones.country_id = '$zone_id' AND gc_country_zones.name = '$city'";
			$city_exists = $this->location_model->checkCityExists($where);
			$cityid = $city_exists[0]['id'];
			//pr($city_exists);
		
			if(is_array($city_exists) && count($city_exists) > 0) {
				$cityid = $city_exists[0]['id'];			
			} else if($zone_id > 0) {
				$code = strtoupper(substr($city, 0, 3));
				$imCity = array("country_id" => $zone_id, "code" => $code, "name" => $city, "status" => 1);				
				$cityid = $this->location_model->insertCityToMaster($imCity);
			}
			
			$insert_arr = array();
			$insert_arr['zone_id'] = $temp_country[$country];
			
			$insert_arr['eOrigin'] = $line_of_text[$i][1];
			$insert_arr['code'] = $city;
			$insert_arr['cityid'] = $cityid;
			$insert_arr['iTransitDays'] = $line_of_text[$i][4];
			$insert_arr['vSailingFrequency'] = $line_of_text[$i][3];
			$insert_arr['fCBMRate'] = $line_of_text[$i][5];
			$insert_arr['fMinimumCharges'] = $line_of_text[$i][6];
			$insert_arr['fBLCharge'] = $line_of_text[$i][7];
			//pr($insert_arr);exit;
			if($insert_arr['cityid'] > 0) {
				$this->location_model->insertIntoImportTable($insert_arr);
			}
			
		}
		echo "success";exit;
		exit;
	}
	
	
	
	
}