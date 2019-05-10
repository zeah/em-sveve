<?php
defined('ABSPATH') or die('Blank Space');



final class EM_sveve_ajax {
	private static $instance = null;

	public static function get_instance() {
		if (self::$instance === null) self::$instance = new self();

		return self::$instance;
	} 

	public function __construct() {
		add_action('wp_ajax_nopriv_sveve', [$this, 'sveve']);
		add_action('wp_ajax_sveve', [$this, 'sveve']);
	}

	public function sveve() {

		// echo preg_replace('/\r\n|\n|\r/', '%0a', $_POST['text']);
		// exit;

		// $opt = get_option('em_sveve');

		// if (isset($opt['url'])) $opt = $opt['url'];

		// if (!filter_var($opt, FILTER_VALIDATE_URL)) exit;

		// $response = wp_remote_get($opt);
		// print_r($response);
		
		// if (is_wp_error($response)) {
		// 	echo '{"status": "error", "code": "'.wp_remote_retrieve_response_code($response).'"}';
		// 	// return;
		// }


		// $res = json_decode(wp_remote_retrieve_body($response), true);

		// if (!is_array($res) || !isset($res['status'])) return;
		// // echo $res;
		// echo 'hi';
		// exit;


		$text = (isset($_POST['text']) ? $_POST['text'] : '') .'%0a'. (isset($_POST['link']) ? $_POST['link'] : '');

		$data = [
			'text' => preg_replace('/\r\n|\n|\r/', '%0a', $_POST['text']),
			'min_age' => isset($_POST['min_age']) ? $_POST['min_age'] : '',
			'max_age' => isset($_POST['max_age']) ? $_POST['max_age'] : '',
			'min_salery' => isset($_POST['min_salery']) ? $_POST['min_salery'] : '',
			'max_salery' => isset($_POST['max_salery']) ? $_POST['max_salery'] : '',
			'gender' => isset($_POST['gender']) ? $_POST['gender'] : ''
		];


		wp_remote_get(trim($opt).'?'.http_build_query($data), ['blocking' => false]);

		print_r($data);

		exit;
	}

}