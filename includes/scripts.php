<?php namespace WSUWP\Plugin\EmbedCodes;

class Scripts {

	public static function register_block_editor_assets() {

		$editor_asset = include plugin_dir_path( dirname( __FILE__ ) ) . 'assets/dist/index.asset.php';

		// register editor assets
		wp_register_script(
			'wsuwp-plugin-embed-codes-editor-scripts',
			plugin_dir_url( dirname( __FILE__ ) ) . 'assets/dist/index.js',
			$editor_asset['dependencies'],
			$editor_asset['version'],
			true,
		);

		wp_register_style(
			'wsuwp-plugin-embed-codes-editor-styles',
			plugin_dir_url( dirname( __FILE__ ) ) . 'assets/dist/index.css',
			array(),
			$editor_asset['version']
		);

	}


	public static function init() {

		add_action( 'init', array( __CLASS__, 'register_block_editor_assets' ) );

	}
}

Scripts::init();
