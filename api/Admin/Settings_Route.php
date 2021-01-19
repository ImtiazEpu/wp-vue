<?php

namespace WPVK\Api\Admin;


use WP_Error;
use WP_HTTP_Response;
use WP_REST_Controller;
use WP_REST_Response;
use WP_REST_Server;

class Settings_Route extends WP_REST_Controller {
	protected $namespace;
	protected $rest_base;

	public function __construct() {
		$this->namespace = 'wpvk/v1';
		$this->rest_base = '/settings';
	}

	/**
	 * Register Routes
	 */
	public function register_routes() {
		register_rest_route(
			$this->namespace,
			$this->rest_base,
			[
				[
					'methods'             => WP_REST_Server::READABLE,
					'callback'            => [ $this, 'get_items' ],
					'permission_callback' => [ $this, 'get_route_access' ]
				],
				[
					'methods'             => WP_REST_Server::CREATABLE,
					'callback'            => [ $this, 'create_items' ],
					'permission_callback' => [ $this, 'get_route_access' ]
				]
			]
		);
	}

	/**
	 * Get item Response
	 *
	 * @param $request
	 *
	 * @return WP_Error|WP_HTTP_Response|WP_REST_Response
	 */
	public function get_items( $request ) {
		$response = [
			'firstname' => get_option( 'wpvk_settings_firstname' ),
			'lastname'  => get_option( 'wpvk_settings_lastname' ),
			'email'     => get_option( 'wpvk_settings_email' )
		];

		return rest_ensure_response( $response );
	}


	/**
	 * Create item
	 *
	 * @param $request
	 *
	 * @return WP_Error|WP_HTTP_Response|WP_REST_Response
	 */

	public function create_items( $request ) {
		$firstname = isset( $request['firstname'] ) ? sanitize_text_field( $request['firstname'] ) : '';
		$lastname  = isset( $request['lastname'] ) ? sanitize_text_field( $request['lastname'] ) : '';
		$email     = isset( $request['email'] ) && is_email( $request['email'] ) ? sanitize_email( $request['email'] ) : '';

		//save option data in the WP

		update_option( 'wpvk_settings_firstname', $firstname );
		update_option( 'wpvk_settings_lastname', $lastname );
		update_option( 'wpvk_settings_email', $email );

		//sent a success response

		$response = [
			'firstname' => get_option( 'wpvk_settings_firstname' ),
			'lastname'  => get_option( 'wpvk_settings_lastname' ),
			'email'     => get_option( 'wpvk_settings_email' ),
		];

		return rest_ensure_response( $response );
	}

	/**
	 * get route access
	 *
	 *
	 * @return bool
	 */
	public function get_route_access(): bool {
		return true;
	}

}