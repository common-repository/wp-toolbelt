<?php
/**
 * Disable public access to the REST API.
 *
 * @package toolbelt
 */


/**
 * Disable the REST API for non-authenticated users.
 *
 * @param WP_Error|bool $access Whether the current request has access to the admin
 * 							interface and, if a REST API request, to the requested
 * 							rest_route.
 * @return WP_Error|bool
 */
function toolbelt_disable_rest_api( $access ) {

	if ( ! is_user_logged_in() ) {

		$access = new WP_Error(
			'rest_not_logged_in',
			esc_html__( 'Sorry, you are not allowed to access REST API.', 'wp-toolbelt' ),
			array( 'status' => 401 )
		);

	}

	return $access;

}

// Disable REST API for non-authenticated users.
add_filter( 'rest_authentication_errors', 'toolbelt_disable_rest_api' );
