<?php

namespace WPVK\Includes;


class Helper {

	/**
	 *  Create table when plugin installation.
	 */
	public static function create_table() {
		//check if can activate plugin
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}

		$plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
		check_admin_referer( "activate-plugin_{$plugin}" );

		global $wpdb;
		$table_name = $wpdb->prefix . 'wpvk';

		//db table migration if exists
		$charset_collate = '';
		if ( $wpdb->has_cap( 'collation' ) ) {
			if ( ! empty( $wpdb->charset ) ) {
				$charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
			}
			if ( ! empty( $wpdb->collate ) ) {
				$charset_collate .= " COLLATE $wpdb->collate";
			}
		}

		$sql = "CREATE TABLE {$table_name} (
				 `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
				 `firstname` varchar(255) NOT NULL,
				 `lastname` varchar(255) NOT NULL,
				 `email` varchar(255) NOT NULL,
				 `created_date`  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
				 `updated_date`  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
				PRIMARY KEY (id)
			)$charset_collate;";

		require_once( ABSPATH . "wp-admin/includes/upgrade.php" );
		dbDelta( $sql );

	}//end method create_table
}