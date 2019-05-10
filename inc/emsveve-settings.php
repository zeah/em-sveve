<?php
defined('ABSPATH') or die('Blank Space');


final class EM_sveve_settings {
	private static $instance = null;

	public static function get_instance() {
		if (self::$instance === null) self::$instance = new self();

		return self::$instance;
	} 

	public function __construct() {
		add_action('admin_menu', [$this, 'add_menu']);
		add_action('admin_init', [$this, 'register_settings']);
	
	}


	public function add_menu() {
		add_submenu_page('options-general.php', 'Sveve Settings', 'EM Sveve', 'manage_options', 'em-sveve-page', [$this, 'page_callback']);
	}

	public function register_settings() {
		register_setting('em-sveve-settings', 'em_sveve', ['sanitize_callback' => [$this, 'sanitize']]);

		add_settings_section('em-sveve-section', '', [$this, 'name_section'], 'em-sveve-page');
		add_settings_field('em-sveve-name', 'gfunc url', [$this, 'input_setting'], 'em-sveve-page', 'em-sveve-section', 'url');
	}


	public function page_callback() {
		echo '<form action="options.php" method="POST">';
		settings_fields('em-sveve-settings');
		do_settings_sections('em-sveve-page');
		submit_button('save');
		echo '</form>';
	}

	public function name_section() {
		// echo 'name';
	}	

	public function input_setting($name) {
		echo sprintf('<input name="em_sveve[%s]" value="%s">', $name, $this->option($name));
	}

	private function option($name) {

		$opt = get_option('em_sveve');

		if (isset($opt[$name])) return esc_attr($opt[$name]);

		return '';

	}

	public static function sanitize($data) {
		if (!is_array($data)) return wp_kses_post($data);

		$d = [];
		foreach($data as $key => $value)
			$d[$key] = Axowl_settings::sanitize($value);

		return $d;
	}


}