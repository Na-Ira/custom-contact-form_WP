<?php
/**
 * 
 * Custom Contact form functions
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
	wp_register_style( 'contact-form',
		plugins_url( 'css/contact-form.css', __FILE__ ),
		array(),
		time()
		);
	wp_enqueue_style( 'contact-form' );

	/**
	 * Ajax script file
	 */
	wp_enqueue_script(
		'contact-form',
		plugins_url( 'js/contact-form.js', __FILE__ ),
		array( 'jquery' ),
		'1.0',
		true
	);

	/**
	 * Setting ajax object data
	 */
	wp_localize_script(
		'contact-form',
		'contact_form_object',
		array(
			'url'   => admin_url( 'admin-ajax.php' ),
			'nonce' => wp_create_nonce( 'contact-form-nonce' ),
		)
	);
}
