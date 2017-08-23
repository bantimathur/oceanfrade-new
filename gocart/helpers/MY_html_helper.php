<?php



function getProductImage($json='',$type)
{
	$images_arr = json_decode($json);
//pr($images_arr);
	if(count($images_arr) > 0) {
		foreach($images_arr as $photo)
		{
			if(isset($photo->primary))
			{
				$primary    = $photo;
			}
		}
		$image = base_url('uploads/images/'.$type.'/'.$primary->filename);
	} else {
		$image = base_url('uploads/images/'.$type.'/noimage.jpg');
	}
	return $image;

}
function pr($arr=array())
{
	echo "<pre>";print_r($arr);echo "</pre>";
}

function get_lat_long($address){

    $address = str_replace(" ", "+", $address);

    $json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=$region");
    $json = json_decode($json);

    $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
    $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
	$arr['lat'] = $lat;
	$arr['long'] = $long;
	return $arr;
}

function getInr($price) {
	$CI =& get_instance();
	$usd_rate = $CI->session->userdata('usd_rate');
	return number_format(round($price * $usd_rate));
}

function load_jquery($front = false)
{
	
	//jquery & jquery ui files & path
	$path			= 'js/jquery';

	$jquery			= 'jquery-1.5.1.min.js';
	$jquery_ui		= 'jquery-ui-1.8.11.custom.min.js';
	$jquery_ui_css	= 'jquery-ui-1.8.11.custom.css';
	
	//load jquery ui css
	
	if($front)
	{
		echo link_tag($path.'/'.$front.'/'.$jquery_ui_css);
	}
	else
	{
		echo link_tag($path.'gocart/'.$jquery_ui_css);
	}
	//load scripts
	echo load_script($path.'/'.$jquery);
	echo load_script($path.'/'.$jquery_ui);
	
	//colorbox
	$path			= $path.'/colorbox';
	$colorbox		= 'jquery.colorbox-min.js';
	$colorbox_css	= 'colorbox.css';
	
	echo link_tag($path.'/'.$colorbox_css);
	echo load_script($path.'/'.$colorbox);
}

function load_script($path)
{
	return '<script type="text/javascript" src="/'.$path.'"></script>';
}

function getProductLink($slug) {
	return site_url().$slug;
}