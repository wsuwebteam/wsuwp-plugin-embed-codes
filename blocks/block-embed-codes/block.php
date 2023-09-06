<?php namespace WSUWP\Plugin\EmbedCodes;

class Block_Embed_Code {

	protected static $block_name    = 'wsuwp/embed-code';

	protected static $default_args = array(
		'className'    => '',
		'embedId'      => '',
		'embedTitle'   => '',
		'url'          => '',
		'doBlocks'     => false,
		'isIframe'     => false,
		'isIframe'     => false,
		'iframeTitle'  => '',
		'iframeWidth'  => '100%',
		'iframeHeight' => '800px',
		'wrap'         => false,

	);


	public static function init() {


		add_action( 'init', array( __CLASS__, 'register_block' ) );

		add_filter( 'wsu_allowed_blocks_filter', array( __CLASS__, 'add_block' ) );

	}


	public static function render( $atts, $content = '' ) {

		$atts = array_merge( self::$default_args, $atts );

		if ( ! empty( $atts['embedId'] ) ) {

			if ( $atts['isIframe'] ) {

				ob_start();

				include __DIR__ . '/template.php';

				$content = ob_get_clean();

			} else {

				$content = get_post_meta( $atts['embedId'], '_wsuwp_embed_code', true );

				if ( ! empty( $atts['wrap'] ) ) {

					$content = '<div class="' . $atts['className'] . '">' . $content . '</div>';

				}
			}
		}

		return ( $atts['doBlocks'] ) ? do_blocks( $content ) : $content;

	}


	public static function register_block() {

		register_block_type(
			self::$block_name,
			array(
				'render_callback' => array( __CLASS__, 'render' ),
				'api_version'     => 2,
				'editor_script'   => 'wsuwp-plugin-embed-codes-editor-scripts',
				'editor_style'    => 'wsuwp-plugin-embed-codes-editor-styles',
			)
		);

	}


	public static function add_block( $blocks ) {

		if ( ! in_array( self::$block_name, $blocks, true ) ) {

			array_push( $blocks, self::$block_name );
		}

		return $blocks;

	}

}

Block_Embed_code::init();
