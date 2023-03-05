<?php
/**
 * 
 * Get in Touch Form functions
 *
 */


 /**
  * Ajax call
  */
add_action( 'wp_enqueue_scripts', 'ajax_form_scripts', 20 );
function ajax_form_scripts() {

	/**
	 * Process form fields
	 */
	wp_enqueue_script( 'jquery-form' );

	/**
	 * Styles
	 */
	wp_register_style( 'get-in-touch-form',
		plugins_url( 'css/get-in-touch-form.css', __FILE__ ),
		array(),
		time()
		);
	wp_enqueue_style( 'get-in-touch-form' );

	/**
	 * Ajax script file
	 */
	wp_enqueue_script(
		'get-in-touch-form',
		plugins_url( 'js/get-in-touch-form.js', __FILE__ ),
		array( 'jquery' ),
		'1.0',
		true
	);

	/**
	 * Setting ajax object data
	 */
	wp_localize_script(
		'get-in-touch-form',
		'get_in_touch_form_object',
		array(
			'url'   => admin_url( 'admin-ajax.php' ),
			'nonce' => wp_create_nonce( 'get-in-touch-form-nonce' ),
		)
	);
}
