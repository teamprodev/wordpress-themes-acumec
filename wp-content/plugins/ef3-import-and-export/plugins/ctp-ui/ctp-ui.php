<?php
/**
 * Created by PhpStorm.
 * User: FOX
 * Date: 4/1/2016
 * Time: 10:54 AM
 */

// No direct access
if ( ! defined( 'ABSPATH' ) ) exit;

function ef3_ctp_ui_export($file){
    global $wp_filesystem;

    if(function_exists('cptui_get_post_type_data')) {
        $cptui_post_types = cptui_get_post_type_data();
        $wp_filesystem->put_contents($file . 'post-type.json', json_encode($cptui_post_types), FS_CHMOD_FILE);
    }

    if(function_exists('cptui_get_taxonomy_data')) {
        $cptui_taxonomies = cptui_get_taxonomy_data();
        $wp_filesystem->put_contents($file . 'taxonomies.json', json_encode($cptui_taxonomies), FS_CHMOD_FILE);
    }
}

/**
 * @param $file
 */
function ef3_ctp_ui_import($file){

    if(!function_exists('cptui_import_types_taxes_settings'))
        return;

    // File exists?
    if (file_exists($file . 'post-type.json')){
        // Get file contents and decode
        $data = file_get_contents($file . 'post-type.json');

        cptui_import_types_taxes_settings_no_nonce_field(array('cptui_post_import' => $data, 'cptui_tax_import' => '' ));
    }

    // File exists?
    if (file_exists($file . 'taxonomies.json')){
        // Get file contents and decode
        $data = file_get_contents($file . 'taxonomies.json');

        cptui_import_types_taxes_settings_no_nonce_field(array('cptui_tax_import' => $data, 'cptui_post_import' => '' ));
    }
}

function cptui_import_types_taxes_settings_no_nonce_field( $postdata = [] ) {
	if ( ! isset( $postdata['cptui_post_import'] ) && ! isset( $postdata['cptui_tax_import'] ) ) {
		return false;
	}
  
	$status  = 'import_fail';
	$success = false;

	/**
	 * Filters the post type data to import.
	 *
	 * Allows third parties to provide their own data dump and import instead of going through our UI.
	 *
	 * @since 1.2.0
	 *
	 * @param bool $value Default to no data.
	 */
	$third_party_post_type_data = apply_filters( 'cptui_third_party_post_type_import', false );

	/**
	 * Filters the taxonomy data to import.
	 *
	 * Allows third parties to provide their own data dump and import instead of going through our UI.
	 *
	 * @since 1.2.0
	 *
	 * @param bool $value Default to no data.
	 */
	$third_party_taxonomy_data  = apply_filters( 'cptui_third_party_taxonomy_import', false );

	if ( false !== $third_party_post_type_data ) {
		$postdata['cptui_post_import'] = $third_party_post_type_data;
	}

	if ( false !== $third_party_taxonomy_data ) {
		$postdata['cptui_tax_import'] = $third_party_taxonomy_data;
	}

	if ( ! empty( $postdata['cptui_post_import'] ) ) {
		$cpt_data = stripslashes_deep( trim( $postdata['cptui_post_import'] ) );
		$settings = json_decode( $cpt_data, true );

		// Add support to delete settings outright, without accessing database.
		// Doing double check to protect.
		if ( null === $settings && '{""}' === $cpt_data ) {

			/**
			 * Filters whether or not 3rd party options were deleted successfully within post type import.
			 *
			 * @since 1.3.0
			 *
			 * @param bool  $value    Whether or not someone else deleted successfully. Default false.
			 * @param array $postdata Post type data.
			 */
			if ( false === ( $success = apply_filters( 'cptui_post_type_import_delete_save', false, $postdata ) ) ) {
				$success = delete_option( 'cptui_post_types' );
			}
		}

		if ( $settings ) {
			if ( false !== cptui_get_post_type_data() ) {
				/** This filter is documented in /inc/import-export.php */
				if ( false === ( $success = apply_filters( 'cptui_post_type_import_delete_save', false, $postdata ) ) ) {
					delete_option( 'cptui_post_types' );
				}
			}

			/**
			 * Filters whether or not 3rd party options were updated successfully within the post type import.
			 *
			 * @since 1.3.0
			 *
			 * @param bool  $value    Whether or not someone else updated successfully. Default false.
			 * @param array $postdata Post type data.
			 */
			if ( false === ( $success = apply_filters( 'cptui_post_type_import_update_save', false, $postdata ) ) ) {
				$success = update_option( 'cptui_post_types', $settings );
			}
		}
		// Used to help flush rewrite rules on init.
		set_transient( 'cptui_flush_rewrite_rules', 'true', 5 * 60 );

		if ( $success ) {
			$status = 'import_success';
		}
	} elseif ( ! empty( $postdata['cptui_tax_import'] ) ) {
		$tax_data = stripslashes_deep( trim( $postdata['cptui_tax_import'] ) );
		$settings = json_decode( $tax_data, true );

		// Add support to delete settings outright, without accessing database.
		// Doing double check to protect.
		if ( null === $settings && '{""}' === $tax_data ) {

			/**
			 * Filters whether or not 3rd party options were deleted successfully within taxonomy import.
			 *
			 * @since 1.3.0
			 *
			 * @param bool  $value    Whether or not someone else deleted successfully. Default false.
			 * @param array $postdata Taxonomy data
			 */
			if ( false === ( $success = apply_filters( 'cptui_taxonomy_import_delete_save', false, $postdata ) ) ) {
				$success = delete_option( 'cptui_taxonomies' );
			}
		}

		if ( $settings ) {
			if ( false !== cptui_get_taxonomy_data() ) {
				/** This filter is documented in /inc/import-export.php */
				if ( false === ( $success = apply_filters( 'cptui_taxonomy_import_delete_save', false, $postdata ) ) ) {
					delete_option( 'cptui_taxonomies' );
				}
			}
			/**
			 * Filters whether or not 3rd party options were updated successfully within the taxonomy import.
			 *
			 * @since 1.3.0
			 *
			 * @param bool  $value    Whether or not someone else updated successfully. Default false.
			 * @param array $postdata Taxonomy data.
			 */
			if ( false === ( $success = apply_filters( 'cptui_taxonomy_import_update_save', false, $postdata ) ) ) {
				$success = update_option( 'cptui_taxonomies', $settings );
			}
		}
		// Used to help flush rewrite rules on init.
		set_transient( 'cptui_flush_rewrite_rules', 'true', 5 * 60 );
		if ( $success ) {
			$status = 'import_success';
		}
	}

	return $status;
}