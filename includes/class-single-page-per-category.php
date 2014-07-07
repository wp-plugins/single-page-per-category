<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class Single_Page_Per_Category {

	/**
	 * The single instance of Single_Page_Per_Category.
	 * @var 	object
	 * @access  private
	 * @since 	1.0.0
	 */
	private static $instance = null;

	/**
	 * The version number.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $version;

	/**
	 * The token.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $token;

	/**
	 * The main plugin file.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $file;

	/**
	 * The main plugin directory.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $dir;

	/**
	 * Constructor function.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function __construct ( $file = '', $version = '1.0.0' ) {
		$this->version = $version;
		$this->token = 'single_page_per_category';

		$this->file = $file;
		$this->dir = dirname( $this->file );

		register_activation_hook( $this->file, array( $this, 'install' ) );
	}

	/**
	 * Main Single_Page_Per_Category Instance
	 *
	 * Ensures only one instance of Single_Page_Per_Category is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see Single_Page_Per_Category()
	 * @return Main Single_Page_Per_Category instance
	 */
	public static function instance ( $file = '', $version = '1.0.0' ) {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self( $file, $version );
		}
		return self::$instance;
	}

	/**
	 * Installation. Runs on activation.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function install () {
		$this->log_version_number();
	}

	/**
	 * Log the plugin version number.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	private function log_version_number () {
		update_option( $this->token . '_version', $this->version );
	}

		public function get_single_per_category_template($default_template) {
			$possible_files = array();
			foreach( (array) get_the_category() as $category ) {
				$possible_files[] = TEMPLATEPATH . "/single-{$category->term_id}.php";
				$possible_files[] = TEMPLATEPATH . "/single-{$category->slug}.php";
			}
			$possible_files[] = $default_template;

			return reset(array_filter($possible_files, 'file_exists'));
		}
}
