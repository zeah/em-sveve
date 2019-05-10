<?php 
/*
Plugin Name: EM Sveve
Description: Sveve integration
Version: 0.0.1
GitHub Plugin URI: zeah/em-sveve
*/

defined('ABSPATH') or die('Blank Space');


define('EM_SVEVE_PLUGIN_URL', plugin_dir_url(__FILE__));

require_once 'inc/emsveve-frontend.php';
require_once 'inc/emsveve-ajax.php';
require_once 'inc/emsveve-settings.php';


function init_em_sveve() {
	EM_sveve::get_instance();
}

init_em_sveve();


final class EM_sveve {
	private static $instance = null;

	public static function get_instance() {
		if (self::$instance === null) self::$instance = new self();

		return self::$instance;
	}

	private function __construct() {
		EM_sveve_frontend::get_instance();
		EM_sveve_ajax::get_instance();
		EM_sveve_settings::get_instance();
	}
}