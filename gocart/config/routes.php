<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

if(file_exists(FCPATH.'gocart/config/database.php'))
{
    $route['default_controller']	= "home";
}
else
{
    $route['default_controller']   = "install";   
}

//this for the admininstration console
$route['reset-password.html']			    = 'secure/reset_password';
$route['login']					= 'secure/login';
$route['register']			    = 'secure/register';
$route['forgotpassword']			    = 'secure/forgotpassword';
$route['step2']					= 'quote/step2';
$route['thank-you.html']		= 'quote/thankyou';
$route['thankyou.html']		= 'quote/thankyou';
$route['thankyou-payment.html']		= 'quote/thankyoupayment';
$route['fail-payment.html']		= 'quote/failpayment';
$route['notifypaypal.html']		= 'quote/notify';
$route['cancelpay.html']		= 'quote/cancel_paypal';

$route['pay.html']		= 'quote/pay';

$route['freight-(.*)-(.*).html']		= 'home/freightcity/$1/$2';
$route['([0-9])']	= "home";

$route['country/(.*)/(.*)/(.*)']	= "home/city_country_page/$1/$2/$3/countrytype";

$route['city/(.*)/(.*)']	= "home/city_country_page/$1/$2/citytype";

$route['city/(.*)/(.*)']	= "home/city_country_page/$1/$2/citytype";
$route['thankforregister']		= 'secure/thankyou';
