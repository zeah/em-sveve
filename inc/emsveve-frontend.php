<?php 
defined('ABSPATH') or die('Blank Space');


final class EM_sveve_frontend {
	private static $instance = null;

	public static function get_instance() {
		if (self::$instance === null) self::$instance = new self();

		return self::$instance;
	} 

	public function __construct() {
		// wp_die('<xmp>'.print_r('hi', true).'</xmp>');
		add_action('admin_bar_menu', [$this, 'add_toolbar_items'], 100);
		add_action('wp_enqueue_scripts', [$this, 'add_sands']);
	}


	/**
	 *
	 */
	public function add_toolbar_items($admin_bar){
	    
	    $admin_bar->add_menu( array(
	        'id'    => 'sveve',
	        'title' => 'Sveve',
	        // 'href'  => '#',
	        'meta'  => array(
	            'title' => __('Sveve')
	            // 'html' => '<h4>test</h4>'            
	        ),
	    ));

	    $admin_bar->add_menu( array(
	        'id'    => 'sveve-nyhetsbrev',
	        'parent' => 'sveve',
	        'title' => 'Send SMS',
	        'href'  => '#',
	        'meta'  => array(
	            'title' => __('My Sub Menu Item'),
	            'target' => '_blank',
	            'class' => 'my_menu_item_class'
	        ),
	    ));

	    // $admin_bar->add_menu( array(
	    //     'id'    => 'my-second-sub-item',
	    //     'parent' => 'sveve',
	    //     'title' => 'My Second Sub Menu Item',
	    //     'href'  => '#',
	    //     'meta'  => array(
	    //         'title' => __('My Second Sub Menu Item'),
	    //         'target' => '_blank',
	    //         'class' => 'my_menu_item_class'
	    //     ),
	    // ));
	}




	/**
	 *
	 */
	public function add_sands() {
        // wp_enqueue_style('jqslid', '//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css', false);
        wp_enqueue_style('emsveve-style', EM_SVEVE_PLUGIN_URL.'assets/css/pub/emsveve.css', array(), '0.0.1', '(min-width: 901px)');
        wp_enqueue_style('emsveve-mobile', EM_SVEVE_PLUGIN_URL.'assets/css/pub/emsveve-mobile.css', array(), '0.0.1', '(max-width: 900px)');
        
        wp_enqueue_script('jquery-cdn', '//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js', [], false, true);
        // wp_enqueue_script('jquery-ui', '//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js', [], false, true);
        wp_enqueue_script('jquery-touch', '//cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js', [], false, true);

        wp_enqueue_script('emsveve', EM_SVEVE_PLUGIN_URL.'assets/js/pub/emsveve.js', [], '0.0.1', true);
		
		wp_localize_script( 'emsveve', 'emurl', ['ajax_url' => admin_url( 'admin-ajax.php')]);
	}
}

