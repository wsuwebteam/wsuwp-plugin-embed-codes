<?php namespace WSUWP\Plugin\EmbedCodes;

class Shortcode {

	public static function init() {

		add_action( 'init', array( __CLASS__, 'register_shortcode' ) );

	}


	public static function register_shortcode() {

		add_shortcode( 'embed_code', array( __CLASS__, 'render_shortcode' ) );

	}


	public static function render_shortcode( $atts ) {

		$atts = shortcode_atts(
			array(
				'id' => 0,
			),
			$atts,
			'embed_code'
		);

		if ( ! empty( $atts['id'] ) ) {

			$embed_code = get_post_meta( $atts['id'], '_wsuwp_embed_code', true );

			return $embed_code;

		}

	}
}

Shortcode::init();
