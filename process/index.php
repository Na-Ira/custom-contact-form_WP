<?php 

add_action( 'wp_ajax_get_in_touch_form_action', 'get_in_touch_form_action_callback' );
add_action( 'wp_ajax_nopriv_get_in_touch_form_action', 'get_in_touch_form_action_callback' );

function get_in_touch_form_action_callback() {

	/**
	 * Error array
	 */
	$errors = [];

	/**
	 * If it does not pass the nonce check, we block sending
	 */
	if ( !wp_verify_nonce( $_POST['nonce'], 'get-in-touch-form-nonce' ) ) {
		wp_die( 'The data was sent from an invalid address' );
	}

	/**
	 * Check the name field, if it's empty, then write a message in the error array
	 */
	if ( empty( $_POST['name'] ) || !isset( $_POST['name'] ) ) {
		$errors['name'] = 'Please enter your name.';
	} else {
		$name = sanitize_text_field( $_POST['name'] );
	}

	/**
	 * Check email fields, if empty, then write a message in the error array
	 */
   if ( empty( $_POST['email'] ) || !isset( $_POST['email'] ) ) {
		$errors['email'] = 'Please enter your email address.';
	} elseif ( !preg_match( "/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", $_POST['email'] ) ) {
		$errors['email'] = 'The email address is incorrect.';
	} else {
		$email = sanitize_email( $_POST['email'] );
	}

	/**
	 * Check the message field, if it's empty, then write the default message
	 */
   if ( empty( $_POST['comment'] ) || !isset( $_POST['comment'] ) ) {
		$errors['comment'] = 'Please enter your message.';
	} else {
		$comment = sanitize_textarea_field( $_POST['comment'] );
	}


	/**
	 * Check the error array, if it is not empty, then send the message. 
	 * If all is well, send email
	 */
	if ( $errors ) {

		wp_send_json_error( $errors );

	} else {

		/**
		 * Find out from which site the email came
		 */
		$home_url = wp_parse_url( home_url() );
		$subject = 'Email from John Doe';

		/**
		 * Email recipients
		 */
		$email_to = 'narinaua@gmail.com';
		$email_from = get_option( 'admin_email' );

		/**
		 * Putting together email
		 */
		$body  = "Name: $name \n\n";
		$body .= "Email: $email \n\n";
		$body .= "Message: $comment \n\n";
      $body .= "Thank you!";

		$headers = 'From: ' . $home_url['host'] . ' <' . $email_from . '>' . "\r\n" . 'Reply-To: ' . $email_from;

		/**
		 * Sending
		 */
		wp_mail( $email_to, $subject, $body, $headers );

		/**
		 * Sending a message about successful sending
		 */
		$message_success = 'Thanks, your email was sent successfully';
		wp_send_json_success( $message_success );
	}

	/**
	 * Killing the ajax process
	 */
	wp_die();

}

?>
