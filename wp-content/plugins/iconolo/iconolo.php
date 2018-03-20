<?php
/*
Plugin Name: Iconolo
Plugin URI: http://www.wp-gama.cz
Description: Plugin management extension is under construction.
Version: 1.1
Author: Jaroslav Spurný
Author URI: http://www.jarynek.cz
*/
add_action('admin_menu', 'icons');

function icons(){
	add_menu_page('Icons', 'Icons', 'administrator', 'icons', 'dashboard');
	add_submenu_page( 'icons', 'scripts', 'scripts', 'administrator', 'scripts','iconsInit' );
}

function dashboard(){
	include_once ('routes/dashboard.php');
}

function iconsInit(){
	echo include_once ('routes/icons-insert.php');
}

function custom_admin_js() {
	$url = plugins_url() . '/iconolo/assets/js/icons_insert.js';
	echo '"<script type="text/javascript" src="'. $url . '"></script>"';
}
add_action('admin_footer', 'custom_admin_js');
