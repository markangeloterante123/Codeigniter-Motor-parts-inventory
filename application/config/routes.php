<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//$route['admin'] = 'admin/index';
$route['(:any)'] = 'pages/view/$1';
$route['default_controller'] = 'pages/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
