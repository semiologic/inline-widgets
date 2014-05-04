<?php


/**
 * inline_widgets_admin
 *
 * @package default
 **/

class inline_widgets_admin {
	/**
	 * Plugin instance.
	 *
	 * @see get_instance()
	 * @type object
	 */
	protected static $instance = NULL;

	/**
	 * URL to this plugin's directory.
	 *
	 * @type string
	 */
	public $plugin_url = '';

	/**
	 * Path to this plugin's directory.
	 *
	 * @type string
	 */
	public $plugin_path = '';

	protected $tinymce4 = false;

	/**
	 * Access this plugin’s working instance
	 *
	 * @wp-hook plugins_loaded
	 * @return  object of this class
	 */
	public static function get_instance()
	{
		NULL === self::$instance and self::$instance = new self;

		return self::$instance;
	}


	/**
	 * Constructor.
	 *
	 *
	 */
	public function __construct() {
		$this->plugin_url    = plugins_url( '/', __FILE__ );
		$this->plugin_path   = plugin_dir_path( __FILE__ );

		global $wp_version;
		if ( version_compare( $wp_version, '3.9', '>=' ) )
			$this->tinymce4 = true;

		$this->init();
    } #inline_widgets_admin

	/**
	 * init()
	 *
	 * @return void
	 **/
	function init() {
		// more stuff: register actions and filters
		add_filter('admin_footer', array($this, 'footer_js'), 5);
        add_filter('mce_external_plugins', array($this, 'editor_plugin'));
        add_filter('mce_buttons_4', array($this, 'editor_button'), 20);
		add_filter('tiny_mce_before_init', array($this, 'editor_init'), 20);

		add_action('admin_enqueue_scripts', array($this, 'admin_scripts'));
	}


	/**
	 * admin_scripts()
	 *
	 * @return void
	 **/

	function admin_scripts() {
//		wp_enqueue_script('inline_widgets', plugins_url( '/js/admin.js', __FILE__), array('jquery'), '20140503', false);
	} # admin_scripts()

    /**
	 * footer_js()
	 *
	 * @package default
	 **/
	
	function footer_js() {
		if ( !$GLOBALS['editing'] )
			return;
		
		global $wp_registered_widgets;
		$widgets = wp_get_sidebars_widgets();
		
		$wp_registered_widgets = (array) $wp_registered_widgets;
		$widgets = (isset($widgets['inline_widgets'])) ? (array) $widgets['inline_widgets'] : array();

		$_widgets = array();
		
		foreach ( $widgets as $key )
			$_widgets[$key] = false;
		
		$widgets = $_widgets;
		
		foreach ( array_keys($widgets) as $id ) {
			if ( isset($wp_registered_widgets[$id]) && is_callable($wp_registered_widgets[$id]['callback']) )
				$widgets[$id] = $wp_registered_widgets[$id];
			else
				unset($widgets[$id]);
		}
		
		$args = array(
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '%BEG_OF_TITLE%',
			'after_title' => '%END_OF_TITLE%'
			);
		
		foreach ( $widgets as $id => $widget ) {
			$params = array($args, (array) $widget['params'][0]);
			
			ob_start();
			call_user_func_array($widget['callback'], $params);
			$label = ob_get_clean();
			
			if ( preg_match("/%BEG_OF_TITLE%(.*?)%END_OF_TITLE%/", "$label", $label) ) {
				$label = end($label);
				$label = strip_tags($label);
				$label = @html_entity_decode($label, ENT_COMPAT, get_option('blog_charset'));
				$label = $widget['name'] . ': ' . $label;
			} else {
				$label = $widget['name'];
			}
			
			$widgets[$id] = $label;
		}

		if ( $this->tinymce4 )
			$listitem_text = "text";
		else
			$listitem_text = "label";

		$i = 0;
		$js_options = array();
		
		foreach ( $widgets as $id => $label ) {
			$js_option = "inlineWidgetItems['"
				. $i++
				. "']"
				. "= {"
				. $listitem_text . ": '" . str_replace(
						array("\\", "'"),
						array("\\\\", "\\'"),
						$label
					) . "', "
				. "value: '" . str_replace(
						array("\\", "'"),
						array("\\\\", "\\'"),
						$id
					) . "'"
				. "};";
			//var_dump($js_option);
			$js_options[] = $js_option;
		}

?><script type="text/javascript"><!--//--><![CDATA[//><!--
var inlineWidgetItems = new Array();
<?php echo implode("\n", $js_options) . "\n"; ?>
document.inlineWidgetItems = inlineWidgetItems;
//alert(document.inlineWidgetItems);
//--><!]]></script>
<?php
	} # footer_js()
	
	
	/**
	 * editor_plugin()
	 *
	 * @param array $plugin_array
	 * @return array $plugin_array
     *
	 **/
	
	function editor_plugin($plugin_array) {
		if ( get_user_option('rich_editing') == 'true') {
			if ($this->tinymce4 )
				$plugin = plugin_dir_url(__FILE__) . 'tinymce/plugin.js';
			else
				$plugin = plugin_dir_url(__FILE__) . 'tinymce/editor_plugin.js';
				
			$plugin_array['inline_widgets'] = $plugin;
		}
		
		return $plugin_array;
	} # editor_plugin()
	
	
	/**
	 * editor_button()
	 *
	 * @param array $buttons
	 * @return array $buttons
	 **/
	
	function editor_button($buttons) {
		if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') )
			return $buttons;
		
		if ( !empty($buttons) )
			$buttons[] = '|';
		
		$buttons[] = 'inline_widgets';
		
		return $buttons;
	} # editor_button()


	/**
	 * editor_init()
	 *
	 * @param array  $mceInit   An array with TinyMCE config.
	 **/

	function editor_init($mceInit) {

		$toolbar4 = explode( ',', $mceInit['toolbar4']);
		if ( count ($toolbar4 ) <= 1) {
			if ( $toolbar4[0] == 'inline_widgets') {
				if ( !empty($mceInit['toolbar3'] )) {
					$mceInit['toolbar3'] .= ',inline_widgets';
				}
				else {
					$mceInit['toolbar2'] .= ',inline_widgets';
				}
				$mceInit['toolbar4'] = '';
			}
		}

		return $mceInit;
	} # editor_init()
} # inline_widgets_admin

$inline_widgets_admin = inline_widgets_admin::get_instance();
