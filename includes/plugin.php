<?php namespace WSUWP\Plugin\EmbedCodes;

class Plugin {


	private static $version = '1.0.0';


	public static function get( $property ) {

		switch ( $property ) {

			case 'version':
				return self::$version;

			case 'plugin_dir':
				return plugin_dir_path( dirname( __FILE__ ) );

			case 'plugin_url':
				return plugin_dir_url( dirname( __FILE__ ) );

			case 'template_dir':
				return plugin_dir_path( dirname( __FILE__ ) ) . '/templates';

			case 'class_dir':
				return plugin_dir_path( dirname( __FILE__ ) ) . '/classes';

			default:
				return '';

		}

	}

	public static function init() {

		require_once __DIR__ . '/post-type-embed-code.php';
		require_once __DIR__ . '/shortcode.php';
		require_once __DIR__ . '/profile.php';

	}


	public static function require_class( $class_name ) {

		require_once self::get( 'plugin_dir' ) . '/classes/class-' . $class_name . '.php';

	}

}

Plugin::init();
