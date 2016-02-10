<?php

namespace bootstrap_slider_space;

class bootstrap_slider {

	protected $loader;
	protected $plugin_name;
	protected $version;

	public function __construct() {

		$this->plugin_name = 'bootstrap_slider';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	private function load_dependencies() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-bootstrap_slider-loader.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-bootstrap_slider-i18n.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-bootstrap_slider-admin.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-bootstrap_slider-public.php';

		$this->loader = new Bootstrap_Slider_Loader();

	}

	private function set_locale() {

		$plugin_i18n = new Bootstrap_Slider_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	private function define_admin_hooks() {

		$plugin_admin = new Plugin_Name_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	private function define_public_hooks() {

		$plugin_public = new Plugin_Name_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	public function run() {
		$this->loader->run();
	}

	public function get_plugin_name() {
		return $this->plugin_name;
	}

	public function get_loader() {
		return $this->loader;
	}

	public function get_version() {
		return $this->version;
	}

}
