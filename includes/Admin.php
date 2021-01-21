<?php

namespace WPVK\Includes;

class Admin {

	public function __construct() {
		add_action( 'admin_menu', [ $this, 'admin_menu' ] );
	}

	/**
	 *
	 */
	public function admin_menu() {
		global $submenu;

		$capability = 'manage_options';

		$slug = 'wp-vue-kickstart';

		$hook = add_menu_page(
			__( 'WP Vue', 'wp-vue-kickstart' ),
			__( 'WP Vue', 'wp-vue-kickstart' ),
			$capability,
			$slug,
			[ $this, 'menu_page_template' ],
			''
		);

		if ( current_user_can( $capability ) ) {
			$submenu[ $slug ][] = [ __( 'WpVue', 'wp-vue-kickstart' ), $capability, 'admin.php?page=' . $slug . '#/' ];
			$submenu[ $slug ][] = [ __( 'Settings', 'wp-vue-kickstart' ), $capability, 'admin.php?page=' . $slug . '#/settings' ];
		}
		add_action( 'load-' . $hook, [ $this, 'init_hooks'] );
	}

	public function init_hooks() {
		$this->load_scripts();
		$this->load_style();
	}

	/**
	 *
	 */
	public function load_scripts() {

		wp_register_script( 'wpvk-manifest', WPVK_PLUGIN_URL . 'assets/js/manifest.js', [], WPVK_VERSION, true );
		wp_register_script( 'wpvk-vendor', WPVK_PLUGIN_URL . 'assets/js/vendor.js', [ 'wpvk-manifest' ], WPVK_VERSION, true );
		wp_register_script( 'wpvk-admin', WPVK_PLUGIN_URL . 'assets/js/admin.js', [ 'wpvk-vendor' ], WPVK_VERSION, true );

		wp_enqueue_script( 'wpvk-manifest' );
		wp_enqueue_script( 'wpvk-vendor' );
		wp_enqueue_script( 'wpvk-admin' );


		wp_localize_script( 'wpvk-admin', 'wpvkAdmin', [
			'adminURL' => admin_url( '/' ),
			'ajaxURL'  => admin_url( 'admin-ajax.php' ),
			'apiURL'   => home_url( '/wp-json' ),
		] );

	}

	/**
	 *
	 */
	public function load_style() {
		wp_register_style( 'wpvk-admin', WPVK_PLUGIN_URL . 'assets/css/admin.css' );

		wp_enqueue_style( 'wpvk-admin' );
	}


	public function menu_page_template() {
		echo '<div class="warp"><div id="wpvk-admin-app"></div></div>';
	}

}