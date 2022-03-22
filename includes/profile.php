<?php namespace WSUWP\Plugin\EmbedCodes;

class Profile {

	public static function init() {

		add_action( 'show_user_profile', array( __CLASS__, 'render_embed_code_checkbox' ) );
		add_action( 'edit_user_profile', array( __CLASS__, 'render_embed_code_checkbox' ) );
		add_action( 'personal_options_update', array( __CLASS__, 'embed_code_access_save' ) );
		add_action( 'edit_user_profile_update', array( __CLASS__, 'embed_code_access_save' ) );
		add_action( 'user_register', array( __CLASS__, 'embed_code_access_save' ) );

	}


	public static function render_embed_code_checkbox( $user ) {

		if ( is_super_admin() ) {

			include Plugin::get( 'plugin_dir' ) . '/templates/profile.php';

		}

	}

	
	public static function embed_code_access_save( $user_id ) {

		if ( is_super_admin() ) {

			if ( isset( $_REQUEST['wsuwp_allow_embed_code'] ) ) {

				update_user_meta( $user_id, '_wsuwp_allow_embed_code', $_REQUEST['wsuwp_allow_embed_code'] );

			} else {

				update_user_meta( $user_id, '_wsuwp_allow_embed_code', false );
			}
		}
	}

}

Profile::init();
