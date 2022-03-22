<?php namespace WSUWP\Plugin\EmbedCodes;

class Post_Type_Embed_Code {


	protected static $post_type = 'wsuwp_embed_code';
	protected static $nonce = 'wsuwp_embed_code_nonce';
	protected static $nonce_action = 'wsuwp_embed_code_nonce_save_post';


	public static function get( $name ) {

		switch ( $name ) {

			case 'post_type':
				return self::$post_type;
			case 'nonce':
				return self::$nonce;
			case 'nonce_action':
				return self::$nonce_action;
			default:
				return '';

		}

	}


	public static function init() {

		add_action( 'init', array( __CLASS__, 'register_post_type' ), 99 );

		

		if ( is_admin() ) {

			add_action( 'edit_form_after_title', array( __CLASS__, 'render_editor' ) );

			add_action( 'save_post_' . self::$post_type, array( __CLASS__, 'save_embed_code' ), 10, 3 );
		}

	}


    public static function register_post_type() {

		$can_edit = get_the_author_meta( '_wsuwp_allow_embed_code', get_current_user_id() );

        $args = array(
			'labels' => array(
				'name'               => 'Embed Codes',
				'singular_name'      => 'Embed Code',
				'all_items'          => 'Embed Codes',
				'view_item'          => 'View Embed Code',
				'add_new_item'       => 'Add New Embed Code',
				'add_new'            => 'Add New',
				'edit_item'          => 'Edit Embed Code',
				'update_item'        => 'Update Embed Code',
				'search_items'       => 'Search Content Embed Codes',
				'not_found'          => 'Not found',
				'not_found_in_trash' => 'Not found in Trash',
			),
			'description'         => 'WSU Content Embed Codes',
			'public'              => false,
			'exclude_from_search' => true,
			'show_ui'             => ( empty( $can_edit ) ) ? false : true, // set this
			'show_in_menu'        => ( empty( $can_edit ) ) ? false : 'tools.php', // set this
			'show_in_nav_menus'   => ( empty( $can_edit ) ) ? false : true,
			'menu_position'       => 20,
			'hierarchical'        => false,
			'menu_icon'           => 'dashicons-embed-photo',
			'supports'            => array(
				'title',
			),
			'rewrite'             => 'embed-code',
		);

		register_post_type( self::$post_type, $args );

    }


	public static function render_editor( $post ) {

		if ( self::$post_type === $post->post_type ) {

			$embed_code = get_post_meta( $post->ID, '_wsuwp_embed_code', true );

			wp_nonce_field( self::get( 'nonce_action' ), self::get( 'nonce' ) );

			$post_id = $post->ID;

			include Plugin::get( 'plugin_dir' ) . '/templates/editor.php';

		}

	}


	public static function save_embed_code( $post_id, $post, $update ) {

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {

			return false;

		}

		if ( wp_is_post_revision( $post_id ) ) {

			return false;

		}

		if ( ! wp_verify_nonce( $_REQUEST[ self::get( 'nonce' ) ], self::get( 'nonce_action' ) ) ) {

			return false;

		}


		// Check if the current user has permission to edit the post.
		if ( ! current_user_can( 'edit_post', $post_id ) ) {

			return false;

		} // End if

		if ( isset( $_REQUEST['wsuwp_embed_code'] ) ) {

			$embed_code = $_REQUEST['wsuwp_embed_code'];

			update_post_meta( $post_id, '_wsuwp_embed_code', $embed_code );

		}

	}

}

Post_Type_Embed_Code::init();
