<?php

class Quote extends Front_Controller {

	function index()
	{
		//echo "Coming Soon....";exit;
		//echo "reading csv files from";
		exit;
		$this->load->model('location_model');
		$country = $this->location_model->get_countries();
		//pr($country);
		$temp_country = array();
		for($i=0;$i<count($country);$i++) {
			$temp_country[strtoupper($country[$i]->name)] = $country[$i]->id;
		}
		//error_reporting(E_ALL);
		//pr($temp_country);
		$path = FCPATH."LCL_Ocean-Copy.csv";
		$file_handle = fopen($path,"r");
		while (!feof($file_handle) ) {
			$line_of_text[] = fgetcsv($file_handle, 1024);
		}
		pr($line_of_text);exit;
		@fclose($file);
		for($i=1;$i<count($line_of_text);$i++) {
			if( $line_of_text[$i][0] == "") {continue;}
			$portarray = array();
			$portarray['zone_id'] = $temp_country[$line_of_text[$i][0]];
			$portarray['eOrigin'] = $line_of_text[$i][2];
			$portarray['code'] = $line_of_text[$i][1];
			$portarray['vDestCode'] = $line_of_text[$i][3];
			$portarray['vSailingFrequency'] = $line_of_text[$i][4];
			$portarray['iTransitDays'] = $line_of_text[$i][5];
			$portarray['tax'] = 11;
			$portarray['fCBMRate'] = $line_of_text[$i][6];
			$portarray['fMinimumCharges'] = $line_of_text[$i][7];
			//pr($portarray);exit;
			if( $portarray['zone_id'] == "") {continue;}
			//$this->location_model->insert_zone_areas($portarray);
			
		}
		echo "finishes";
		exit;
		//$this->view('homepage', $data);
	}

	function step2($q) {
		$this->load->model('location_model');
		$country = $this->location_model->get_countries_dropdown();
		$data['country'] = $country;
		$this->view('step2', $data);
	}
	
	function getMarker() {
		$this->load->model('location_model');
		$origin_arr = array("Toronto" => array(43.7000,-79.4000),
							"Montreal" => array(45.5017,-73.56),
							"Vancouver" => array(49.28,-123.12));
		//pr($this->input->post());
		$dest_city 	= $this->input->post('dest_city');
		$eOrigin 	= $this->input->post('eOrigin');
		$countries = $this->input->post('countries');
		$countries = $this->location_model->get_country($countries);
		$countries = $countries->name;
		
		$dest_city = @explode("via",$dest_city);
		$dest_city = $dest_city[0];
		$address = $dest_city." , ".$countries;
		$dest_lat = get_lat_long($address);
		//pr($origin_arr);
		$origin_arr = $origin_arr[$eOrigin];
		//pr($origin_arr);
		$marker = array();
		$marker[] = array($eOrigin,$origin_arr[0],$origin_arr[1]);
		$marker[] = array($dest_city,$dest_lat['lat'],$dest_lat['long']);
		//pr($marker);exit;
		//$arr['markers'] = "[['Delhi', 23.02,72.5],['Palace of Westminster London', 23.66,72.55]]";
				echo json_encode($marker);
		exit;
	}
	
	function getSellingInfo() {
		$this->load->model('location_model');
		
		$dest_city 	= $this->input->post('dest_city');
		$eOrigin 	= $this->input->post('eOrigin');
		$countries = $this->input->post('countries');
		$countries = $this->location_model->get_country($countries);
		$countries = $countries->name;
		exit;
		
	}
	
	function getPort() {
	
		$this->load->model('location_model');
		//pr($this->input->post());
		$zone_id = $this->input->post('zone_id');
		$eOrigin = $this->input->post('eOrigin');
		
		//exit;
		
		$where = "eOrigin = '$eOrigin' AND zone_id = $zone_id";
		$fld = "id,code,vSailingFrequency";
		$city =  $this->location_model->get_city_port($where,$fld);
		//pr($city);
		$str = "";
		$str .= "<select class='last' name='vDestCity' id='vDestCity' tabindex='2'>";
		$str .= "<option value=''>City / Port</option>";
		for($i=0;$i<count($city);$i++) {
			$city_names = strtolower($city[$i]->code);
			$str .= "<option rel='".$city[$i]->vSailingFrequency."' value='".$city[$i]->id."'>$city_names</option>";
		}
		$str .= "</select>";
		echo $str;exit;
			
	}
	function getCMap() {
	
		$this->load->model('location_model');
		#pr($this->input->post());exit;
		$zone_id = $this->input->post('zone_id');
		$eOrigin = $this->input->post('eOrigin');
		$origin_arr = array("Toronto" => array('A',43.7000,-79.4000),
							"Montreal" => array('A',45.5017,-73.56),
							"Vancouver" => array('A',49.28,-123.12));
		if($eOrigin != "" && ($zone_id == "" || $zone_id == 'Select Country') ) {
			$marker = array();
			$marker[] = $origin_arr[$eOrigin];
			echo json_encode($marker);
			exit;
		}
		
		$countries = $this->location_model->get_country($zone_id);
		$countries = $countries->name;
		
		$dest_lat = get_lat_long($countries);
		//pr($origin_arr);
		$origin_arr = $origin_arr[$eOrigin];
		//pr($origin_arr);
		$marker = array();	
		$marker[] = array('',$dest_lat['lat'],$dest_lat['long']);
	
				echo json_encode($marker);
		exit;
		//exit;
		
		$where = "eOrigin = '$eOrigin' AND zone_id = $zone_id AND vLat != ''";
		$fld = "id,code,vLat,vLong";
		$city =  $this->location_model->get_city_port($where,$fld);
		//pr($city);
		//exit;
		$marker = array();
		for($i=0;$i<count($city);$i++) {
			$marker[] = array('A',$city[$i]->vLat,$city[$i]->vLong);
			$marker[] = array('A',$city[$i]->vLat,$city[$i]->vLong);
		}	
		echo json_encode($marker);
		exit;
		
		echo "[['Delhi', 23.02,72.5],['Palace of Westminster London', 23.66,72.55]]";exit;
			
			
	}
	
	function print_pdf() {
		
	}
	
	function pdf_generation() {
		
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
		$import =  $myquate[0]['import'];
		//pr($myquate);exit;
		$custommessage = strip_tags($myquate[0]['custommessage']);
		$vOrigin = $myquate[0]['vOrigin'];
		$vQuote = $myquate[0]['order_number'];
		$vDestCountry = $myquate[0]['vDestCountry'];
		$vDestCity = $myquate[0]['vDestCity'];
		if($import == "Yes") {
			$ex = "gc_country_zone_areas_import.eOrigin = '$vOrigin' AND gc_country_zone_areas_import.cityid = '$vDestCity' and gc_country_zone_areas_import.zone_id = '$vDestCountry'";
			$destination_info = $this->order_model->getDestinationINFOImport($ex);
		} else {
			$destination_info = $this->order_model->getDestinationINFO($vDestCity);
		}
		
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
			if($import == "Yes") {
				$html_str .= "<span><b>Origin : </b>$city</span>, <span>$country</span>";
				$html_str .= "<br>";
				$html_str .= "<span><b>Destination : </b>$vOrigin</span>";
			} else {
				$html_str .= "<span><b>Origin : </b>$vOrigin</span>";
				$html_str .= "<br>";
				$html_str .= "<span><b>Destination City: </b>$city</span>";
				$html_str .= "<br>";
				$html_str .= "<span><b>Destination Country : </b>$country</span>";
			}
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
		if($import == "Yes") {
				///$html_str .= "<span><b>Origin : </b>$city</span>, <span>$country</span>";
				$subject = "Quote $vQuote $city, $country  to $vOrigin";
		} else {
				$subject = "Quote $vQuote $vOrigin to $city";
		}
		
		
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
	
	function calculate_total_volume_cbm() {
		$dimension = $this->input->post('dimension');
		$length = $this->input->post('length');
		$weight = $this->input->post('weight');
		$height = $this->input->post('height');
		$skids = $this->input->post('skids');
		$total_weight = $this->input->post('total_weight');
		
		$cbm = $this->total_cbm_row($dimension,$length,$weight,$height,$skids,$total_weight);
		
	}
	
	
	
	function total_cbm_row($dimension,$length,$weight,$height,$skids,$total_weight) {
		if($dimension == "KG") {
			return $total_weight/1000;
		} else {
			$cubic_feet = $length * $weight * $height;
			$cbm = $cubic_feet/35.3145;
		}
		return $cbm;
	}
	function send_mail_to_admin($order_number) {
		$type = 'Cal';
		$this->load->model('order_model');
		$this->load->model('location_model');
		$this->load->model('settings_model');
		
		//pr($this->input->post());exit;
		$to = $this->input->post('sender_email');
		//$order_number = $this->input->post('order_number');
		//$order_number = "144999673446";
		$admin_email = $this->settings_model->get_set_value('email');
		$admin_email = $admin_email[0]['setting'];
		if($type == "Cal") {
			$to = $admin_email;
		} else {
			$order_number = $this->input->post('order_number');
		}
	
		$myquate = $this->order_model->order_information($order_number);
		$import =  $myquate[0]['import'];
		$ship_email = $myquate[0]['ship_email'];
		//pr($myquate);
		$shipper_country = $this->location_model->get_country($myquate[0]['bill_country']);
		//pr($country);
		$vOrigin = $myquate[0]['vOrigin'];
		$vDestCountry = $myquate[0]['vDestCountry'];
		$vDestCity = $myquate[0]['vDestCity'];
		if($import == "Yes") { 
			$ex = "gc_country_zone_areas_import.eOrigin = '$vOrigin' AND gc_country_zone_areas_import.cityid = '$vDestCity' and gc_country_zone_areas_import.zone_id = '$vDestCountry'";
			$destination_info = $this->order_model->getDestinationINFOImport($ex);
		} else {
			$destination_info = $this->order_model->getDestinationINFO($vDestCity);
		}
		//pr($destination_info);exit;
		$city = $destination_info[0]['city'];
		$country = $destination_info[0]['country'];
		$total = $myquate[0]['total'];;
		$handlingfee  = $myquate[0]['handlingfee'];;
		$order_items = $myquate['order_items'];
		//pr($order_items);exit;
		$src = $this->config->site_url()."images/logo.png";
		$html_str = "<img src='$src' />";
		
		 $img = $this->config->site_url()."images/feature-1.jpg";
			  $html_str .= "<br> <br><img width='600px;' height='300px' src='".$img."' >";
		if($type == "Cal") {
			$html_str .= "<br>";
			$html_str .= "<div>";
			if($import == "Yes") {
				$html_str .= "<span><b>Origin : </b>$city</span>, <span><b>Origin : </b>$country</span>";
				$html_str .= "<br>";
				$html_str .= "<span><b>Destination : </b>$vOrigin</span>";
			} else {
				$html_str .= "<span><b>Origin : </b>$vOrigin</span>";
				$html_str .= "<br>";
				$html_str .= "<span><b>Destination City: </b>$city</span>";
				$html_str .= "<br>";
				$html_str .= "<span><b>Destination Country : </b>$country</span>";
			}
			$html_str .= "</div>";
			
		$html_str .= '<table width="100%"   style=" border: 1px solid #000; border-collapse: collapse;">';
        $html_str .=  "<tbody><tr><td style=' border: 1px solid #000;'>No.of SKD</td><td style=' border: 1px solid #000;'>L</td>
						<td style=' border: 1px solid #000;'>W</td>
						<td style=' border: 1px solid #000;'>H</td>
						<td style=' border: 1px solid #000;'>Weight Per Item</td>
						<td style=' border: 1px solid #000;'>Total Volume in CBM</td>
						<td style=' border: 1px solid #000;'>Total Weight in LBS </td>";
		
        $sum_fTotalVolumeCBM = 0;
		$sum_fTotalWeightLBS = 0;
		
		for($i=0;$i<count($order_items);$i++) {
			$iNoOfSkids = $order_items[$i]['iNoOfSkids'];
			$iLength = $order_items[$i]['iLength'];
			$iWidth = $order_items[$i]['iWidth'];
			$iHeight = $order_items[$i]['iHeight'];
			$fWeightPItem = $order_items[$i]['fWeightPItem'];
			$fTotalVolumeCBM = $order_items[$i]['fTotalVolumeCBM'];
			$fTotalWeightLBS = $order_items[$i]['fTotalWeightLBS'];
			$sum_fTotalVolumeCBM += $fTotalVolumeCBM;
			$sum_fTotalWeightLBS += $fTotalWeightLBS;
			$html_str .=   "<tr >
						<td style=' border: 1px solid #000;'>$iNoOfSkids</td>
                       <td style=' border: 1px solid #000;'>$iLength</td>
                       <td style=' border: 1px solid #000;'>$iWidth</td>
                       <td style=' border: 1px solid #000;'>$iHeight</td>
                       <td style=' border: 1px solid #000;'>$fWeightPItem</td>
                       <td style=' border: 1px solid #000;'>$fTotalVolumeCBM</td>
                       <td style=' border: 1px solid #000;'>$fTotalWeightLBS</td>                    
                     </tr>";
		}
		$html_str .=   "<tr >
						<td style=' border: 1px solid #000;' colspan='5' ></td>
                       <td style=' border: 1px solid #000;' > <b>  $sum_fTotalVolumeCBM</b></td>
                       <td style=' border: 1px solid #000;'><b>  $sum_fTotalWeightLBS</b></td>                    
                     </tr>";
	 $html_str .=   "<tr >
                       <td style=' border: 1px solid #000;' colspan='7' align='center'><b> Total Price $ $total</b></td>
                                         
                     </tr>";
			 $html_str .='</tbody></table> <br>';
			
			//$html_str .= "<div style='border:1px solid #0075be; clear: both;padding: 10px;margin: 10px;border-radius: 7px;'>";
				$html_str .= "<div style='color : red;padding-bottom:1px;font-size:21px;'><b>Shipping Details</b></div>";
				$html_str .= '<table width="60%"   style=" border: 1px solid #000; border-collapse: collapse;">';
				$html_str .=  "<tbody><tr><td style=' border: 1px solid #000;'><b style='color:#0075be;'>Shipper Name : </b></td>
							<td style=' border: 1px solid #000;'>".$myquate[0]['ship_firstname']."</td><tr>";
				$html_str .=  "<tbody><tr><td style=' border: 1px solid #000;'><b style='color:#0075be;'>Company Name : </b></td>
							<td style=' border: 1px solid #000;'>".$myquate[0]['ship_company']."</td><tr>";
				$html_str .=  "<tbody><tr><td style=' border: 1px solid #000;'><b style='color:#0075be;'>Address : </b></td>
							<td style=' border: 1px solid #000;'>".$myquate[0]['ship_address1']."</td><tr>";
				$html_str .=  "<tbody><tr><td style=' border: 1px solid #000;'><b style='color:#0075be;'>Address2 : </b></td>
							<td style=' border: 1px solid #000;'>".$myquate[0]['ship_address2']."</td><tr>";							
				$html_str .=  "<tbody><tr><td style=' border: 1px solid #000;'><b style='color:#0075be;'>City : </b></td>
							<td style=' border: 1px solid #000;'>".$myquate[0]['ship_city']."</td><tr>";
				$html_str .=  "<tbody><tr><td style=' border: 1px solid #000;'><b style='color:#0075be;'>Postal Code : </b></td>
							<td style=' border: 1px solid #000;'>".$myquate[0]['ship_zip']."</td><tr>";
				$html_str .=  "<tbody><tr><td style=' border: 1px solid #000;'><b style='color:#0075be;'>Province : </b></td>
							<td style=' border: 1px solid #000;'>".$myquate[0]['ship_zone']."</td><tr>";
				$html_str .=  "<tbody><tr><td style=' border: 1px solid #000;'><b style='color:#0075be;'>Phone : </b></td>
							<td style=' border: 1px solid #000;'>".$myquate[0]['ship_phone']."</td><tr>";
				$html_str .=  "<tbody><tr><td style=' border: 1px solid #000;'><b style='color:#0075be;'>Email : </b></td>
							<td style=' border: 1px solid #000;'>".$myquate[0]['ship_email']."</td><tr>";
				$html_str .='</tbody></table> <br>';				
				
			//$html_str .= "</div>";
				$html_str .= "<div style='color : red;padding-bottom:4px;font-size:21px;'><b>Consignee Details</b></div>";
				$html_str .= '<table width="60%"   style=" border: 1px solid #000; border-collapse: collapse;">';
				$html_str .=  "<tbody><tr><td style=' border: 1px solid #000;'><b style='color:#0075be;'>Receiver Name : </b></td>
							<td style=' border: 1px solid #000;'>".$myquate[0]['bill_firstname']."</td><tr>";
				$html_str .=  "<tbody><tr><td style=' border: 1px solid #000;'><b style='color:#0075be;'>Company Name : </b></td>
							<td style=' border: 1px solid #000;'>".$myquate[0]['bill_company']."</td><tr>";
				$html_str .=  "<tbody><tr><td style=' border: 1px solid #000;'><b style='color:#0075be;'>Address : </b></td>
							<td style=' border: 1px solid #000;'>".$myquate[0]['bill_address1']."</td><tr>";
				$html_str .=  "<tbody><tr><td style=' border: 1px solid #000;'><b style='color:#0075be;'>Province : </b></td>
							<td style=' border: 1px solid #000;'>".$myquate[0]['bill_zone']."</td><tr>";							
				$html_str .=  "<tbody><tr><td style=' border: 1px solid #000;'><b style='color:#0075be;'>Country : </b></td>
							<td style=' border: 1px solid #000;'>".$shipper_country->name."</td><tr>";
				$html_str .=  "<tbody><tr><td style=' border: 1px solid #000;'><b style='color:#0075be;'>Postal Code : </b></td>
							<td style=' border: 1px solid #000;'>".$myquate[0]['bill_zip']."</td><tr>";
				$html_str .=  "<tbody><tr><td style=' border: 1px solid #000;'><b style='color:#0075be;'>Province : </b></td>
							<td style=' border: 1px solid #000;'>".$myquate[0]['ship_zone']."</td><tr>";
				$html_str .=  "<tbody><tr><td style=' border: 1px solid #000;'><b style='color:#0075be;'>Phone : </b></td>
							<td style=' border: 1px solid #000;'>".$myquate[0]['bill_phone']."</td><tr>";
				$html_str .=  "<tbody><tr><td style=' border: 1px solid #000;'><b style='color:#0075be;'>Email : </b></td>
							<td style=' border: 1px solid #000;'>".$myquate[0]['bill_email']."</td><tr>";
				$html_str .='</tbody></table> <br>';
				
				$html_str .= "<div style='color : red;padding-bottom:4px;font-size:21px;'><b>Commodity & Additional Comments</b></div>";
				$html_str .= '<table width="60%"   style=" border: 1px solid #000; border-collapse: collapse;">';
				$html_str .=  "<tbody><tr><td style=' border: 1px solid #000;'><b style='color:#0075be;'>Commodity : </b></td>";
				$html_str .= "<td style=' border: 1px solid #000;'>".$myquate[0]['tCommodity']."</td><tr>";
				$html_str .=  "<tr><td style=' border: 1px solid #000;'><b style='color:#0075be;'>Comment : </b></td>";
				$html_str .= "<td style=' border: 1px solid #000;'>".$myquate[0]['tCommodityComment']."</td><tr>";

				$html_str .='</tbody></table> <br>';
				$myquate[0]['pick_dock'] = (trim($myquate[0]['pick_postalcode']) == "" ) ? '' : $myquate[0]['pick_dock'];
				$html_str .= "<div style='color : red;padding-bottom:4px;font-size:21px;'><b>Pick Up Address</b></div>";
				$html_str .= '<table width="60%"   style=" border: 1px solid #000; border-collapse: collapse;">';
				$html_str .=  "<tbody><tr><td style=' border: 1px solid #000;'><b style='color:#0075be;'>Pick Up Postal code : </b></td>";
				$html_str .= "<td style=' border: 1px solid #000;'>".$myquate[0]['pick_postalcode']."</td><tr>";
				$html_str .=  "<tr><td style=' border: 1px solid #000;'><b style='color:#0075be;'>Dock Facility : </b></td>";
				$html_str .= "<td style=' border: 1px solid #000;'>".$myquate[0]['pick_dock']."</td><tr>";
				$html_str .=  "<tr><td style=' border: 1px solid #000;'><b style='color:#0075be;'>Email : </b></td>";
				$html_str .= "<td style=' border: 1px solid #000;'>".$myquate[0]['pick_email']."</td><tr>";
				$html_str .=  "<tr><td style=' border: 1px solid #000;'><b style='color:#0075be;'>Phone : </b></td>";
				$html_str .= "<td style=' border: 1px solid #000;'>".$myquate[0]['pick_phone']."</td><tr>";
				$html_str .=  "<tr><td style=' border: 1px solid #000;'><b style='color:#0075be;'>Additional Info : </b></td>";
				$html_str .= "<td style=' border: 1px solid #000;'>".$myquate[0]['pick_additional_info']."</td><tr>";

				$html_str .='</tbody></table> <br>';
				
		
			
		}
		
		
			 $html_str .= "<br>";
			   $html_str .= "<div style='font-style: italic'>Note: Rates are for estimated purposes only and will be charged as per measurements received from CFS.</div>";
			  $img = $this->config->site_url()."images/feature-2.jpg";
			  $html_str .= "<img width='600px;' height='300px' src='".$img."' >";
			  //echo $html_str;exit;
		
		
		$to = $to;		
		$subject = "Quote $order_number $vOrigin to $city";
		if($import == "Yes") {				
				$subject = "Quote $order_number  $city, $country  to $vOrigin";
		} else {
			$subject = "Quote $order_number $vOrigin to $city";
		}
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers = "From: $admin_email\r\n"."X-Mailer: php";
		
		$headers = "From: $admin_email" . "\r\n" .
                'Reply-To: me@gmail.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion() . "\r\n" .
                'Content-Type: text/html; charset=ISO-8859-1'."\r\n".
                'MIME-Version: 1.0'."\r\n\r\n";
		
		@mail($to,$subject,$html_str,$headers);
			$to = $ship_email;
		@mail($to,$subject,$html_str,$headers);
			if($type == "Cal") { 
				return false;
			} else {
				echo "success";
				exit;
			}
		
	
		
	}
	
	
	function calculate_total() {
		
		//pr($this->input->post());exit;
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
		
		$where = "gc_country_zone_areas.id = '$vDestCity'";
		$fld = "fCBMRate,fMinimumCharges";
		$cbm_info = $this->location_model->get_city_port($where,$fld);
		//pr($cbm_info);
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
		
		$total_price = $total_price + $handlingfee  + $exportdeclarationfee + $othersfee;
		
		$total_price = number_format($total_price,2,'.','');		
		$canadian_total_price = $total_price * $exchangerate;
		$canadian_total_price = number_format($canadian_total_price,2,'.','');
		$where = "id = '$orderid'";
		$update_arr = array( "total" => $total_price,"subtotal" => $total_price,"handlingfee" => $handlingfee,"exportdeclarationfee" => $exportdeclarationfee,
						"othersfee" => $othersfee,"custommessage" => $custom_message  
						);
		$this->order_model->update_order($where,$update_arr);
		$this->send_quate('Cal',$refno);
		$json_arr = array('suuc' => 1,'gross_cbm' => $gross_cbm,'gross_weight' => $gross_weight,'refno' => $refno,'orderid' => $orderid,
							'total_price' => $total_price,'canadian_total_price' => $canadian_total_price,'custom_message' => $custom_message);
		echo json_encode($json_arr);	
		exit;
	}
	
	function step2_action() {
		//pr($this->input->post());exit;
		$this->load->model('order_model');
		$order_number = $this->input->post('order_number');
		$type = $this->input->post('type');
		$update_arr = array();
		$update_arr = $this->input->post();
		$update_arr['status'] = '';
		unset($update_arr['order_number']);
		unset($update_arr['type']);
		unset($update_arr['currency_code']);
		unset($update_arr['bn']);
		unset($update_arr['cmd']);
		unset($update_arr['no_note']);
		unset($update_arr['lc']);
		//pr($update_arr);exit;
		$where = "order_number = '$order_number'";
		$this->order_model->update_order($where,$update_arr);
		//send_mail_to_admin
		$this->send_mail_to_admin($order_number);
		//exit;
		if($type == "paynow") {
			// redirect to paypal page
			///echo "paypal code start here";exit;
			//$this->paypal_pay($order_number);
			$json_array  = array('order_number' =>$order_number);
			echo json_encode($json_array);exit;
		} else {
			// simple thank u page
			redirect($this->config->site_url()."thank-you.html");
		}
		
	}
	
	
	function step3_action() { 
		//echo APPPATH;
		//pr($this->input->post());
		//exit;
		$this->load->model('settings_model');
		$stripe_secret_key = $this->settings_model->get_set_value('stripe_secret_key');
		//pr($stripe_secret_key);exit;
		$stripe_secret_key = $stripe_secret_key[0]['setting'];
		$stripe_secret_key_usd = $this->settings_model->get_set_value('stripe_secret_key_usd');
		//pr($stripe_secret_key);exit;
		$stripe_secret_key_usd = $stripe_secret_key_usd[0]['setting'];
		$currency = $this->input->post('currency');
		 $currency = $currency[0];
		$amount = $this->input->post('amount');
		//exit;
		$amount = $amount * 100;
				
		try {	
			require_once(APPPATH.'Stripe/lib/Stripe.php');
			
			if($currency == "cad") {
				//echo $stripe_secret_key;exit;
				Stripe::setApiKey($stripe_secret_key); //Replace with your Secret Key			
				$charge = Stripe_Charge::create(array(
					"amount" => $amount,
					"currency" => "cad",
					"card" => $_POST['stripeToken'],
					"description" => "Transaction"
				));
			} else {	
				//echo $stripe_secret_key_usd;exit;
				Stripe::setApiKey($stripe_secret_key_usd); //Replace with your Secret Key			
				$charge = Stripe_Charge::create(array(
					"amount" => $amount,
					"currency" => "usd",
					"card" => $_POST['stripeToken'],
					"description" => "Transaction"
				));
			}	
			


			//print_r($charge);exit;
			$this->load->model('order_model');
			#echo 'notify test';exit;
			$order_number = $this->input->post('order_number');
			$update_arr = array("payment_info" => 'Stripe');	
			$where = "order_number = '$order_number'";
			$this->order_model->update_order($where,$update_arr);
			redirect($this->config->site_url()."thankyou-payment.html");
			exit;		
		}

		catch(Stripe_CardError $e) {
			//pr($e);	exit;		
			redirect($this->config->site_url()."fail-payment.html");
			exit;
		}

		//catch the errors in any way you like

		catch (Stripe_InvalidRequestError $e) {
			//echo "6";
			//pr($e);	exit;
		 	 redirect($this->config->site_url()."fail-payment.html");
			exit;

		} catch (Stripe_AuthenticationError $e) {	
			//echo "7";
			//pr($e);	exit;	  
		  	redirect($this->config->site_url()."fail-payment.html");
			exit;
		} catch (Stripe_ApiConnectionError $e) {
			//echo "8";
			//pr($e);	exit;		
		 	 redirect($this->config->site_url()."fail-payment.html");
			exit;
		} catch (Stripe_Error $e) {
			//echo "9";
			//pr($e);	exit;
		  	redirect($this->config->site_url()."fail-payment.html");
			exit;		
		} catch (Exception $e) {
			//echo "10";
			//pr($e);	exit;
		  	redirect($this->config->site_url()."fail-payment.html");
			exit;		 
		}
	}

	function failpayment() {
		$data = array();
		$this->view('failpayment', $data);
	}

	function paypal_pay($order_number) {
		$paypal_email = 'hbdemoemail-facilitator@gmail.com';
		$return_url = $this->config->site_url()."thankyou.html";
		
		$cancel_url = $this->config->site_url()."quote/cancel_paypal?order_number=".$order_number;
		$notify_url = $this->config->site_url()."notifypaypal.html?order_number=".$order_number;
		$item_name = 'Test Item';
		$item_amount = 5.00;
		$querystring = '';
	
	// Firstly Append paypal account to querystring
	$querystring .= "?business=".urlencode($paypal_email)."&";
	
	// Append amount& currency (£) to quersytring so it cannot be edited in html
	
	//The item name and amount can be brought in dynamically by querying the $_POST['item_number'] variable.
	$querystring .= "item_name=".urlencode($item_name)."&";
	$querystring .= "amount=".urlencode($item_amount)."&";
	
	//loop for posted values and append to querystring
	foreach($_POST as $key => $value){
		$value = urlencode(stripslashes($value));
		$querystring .= "$key=$value&";
	}
	
	// Append paypal return addresses
	$querystring .= "return=".urlencode(stripslashes($return_url))."&";
	$querystring .= "cancel_return=".urlencode(stripslashes($cancel_url))."&";
	$querystring .= "notify_url=".urlencode($notify_url);
	
	// Append querystring with custom field
	//$querystring .= "&custom=".USERID;
	
	// Redirect to paypal IPN
	//echo $querystring;exit;
	header('location:https://www.sandbox.paypal.com/cgi-bin/webscr'.$querystring);
	exit();
		
	}
	
	function notify() {
		$this->load->model('order_model');
		#echo 'notify test';exit;
		$order_number = $this->input->get('order_number');
		$update_arr = array("payment_info" => 'PayPal');	
		$where = "order_number = '$order_number'";
		$this->order_model->update_order($where,$update_arr);
		exit;
	}
	
	function cancel_paypal() {
		echo 'cancel  by paypal';exit;
	}
	


	function thankyou() {
		$data = array();
		$this->view('thankyou', $data);
	}
	
	function thankyoupayment() {
		$data = array();
		$this->view('thankyoupayment', $data);
	}
	
	function send_email_quastion()  {
		$this->load->model('settings_model');
		#pr($this->input->post());	exit;;	
		//$cc = $contact_email;
		parse_str($this->input->post('formdata'));
		
		if($sendcopy == "Yes") {
			$cc = $contact_email;
		}
		
		$admin_email = $this->settings_model->get_set_value('email');
		$admin_email = $admin_email[0]['setting'];
	
		$html = "User have a question";
		$html .= "\r\n\r\n";
		$html .= "Contact Name : ".$contact_name;
		$html .= "\r\n\r\n";
		$html .= "Phone Number: ".$phonenumber;
		$html .= "\r\n\r\n";
		$html .= "Email : ".$contact_email;
		$html .= "\r\n\r\n";
		$html .= "Questions : ".$queastion;
		//echo $html;
		
		$to = $admin_email;
		$subject = "Question From Customer";
		
		$headers = "From: $admin_email" . "\r\n" .
		"CC: $cc";
		$header .= "MIME-Version: 1.0\r\n";
		$header .= "Content-type: text/html\r\n";
		
		@mail($to,$subject,$html,$headers);
		//echo $admin_email;
		$json_array = array("succ" => 1);
		echo json_encode($json_array);
		exit;
	}
	
	function  pageopen($id = false)
	{
		//if there is no page id provided redirect to the homepage.
		$data['page']	= $this->Page_model->get_page($this->input->get('id'));
		//pr($data);
		//exit;
		$title = $data['page']->title;
		$str .= "<div style='font-size:18px;color:black;padding: 9px 15px;border-bottom: 1px solid #eee;'><b>$title</b></div>";
		$str .= "<div>";
		$str .= $data['page']->content;
		$str .= "</div>";
		echo $str;exit;
		
		//echo $id;exit;
	}
	
	function pay() {
		#echo "ds";exit;
		$data = array();
		$this->view('pay', $data);
	}
	
	
}	