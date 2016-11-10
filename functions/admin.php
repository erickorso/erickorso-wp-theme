<?php 

/**
 * CMB2 Theme Adimin Options
 * @version 0.1.0
 */
class EV_Admin {
	// admin tabs, page_open, page_close, script, style
	private $tabs;
	private $page_open;
	private $page_close;
	private $script;
	private $style;
	
	/**
 	 * Option key, and option page slug
 	 * @var string
 	 */
	private $key = 'screen_options';

	/**
 	 * Options page metabox id
 	 * @var string
 	 */
	private $metabox_id = 'screen_option_metabox';

	/**
	 * Options Page title
	 * @var string
	 */
	protected $title = 'Theme Options';

	/**
	 * Options Page hook
	 * @var string
	 */
	protected $options_page = '';

	/**
	 * Holds an instance of the object
	 *
	 * @var EV_Admin
	 **/
	private static $instance = null;

	/**
	 * Constructor
	 * @since 0.1.0
	 */
	private function __construct() {
		// Set our title
		$this->title = __( 'Theme Options', LANG );
	}

	/**
	 * Returns the running object
	 *
	 * @return EV_Admin
	 **/
	public static function get_instance() {
		if( is_null( self::$instance ) ) {
			self::$instance = new self();
			self::$instance->hooks();
		}
		return self::$instance;
	}

	/**
	 * Initiate our hooks
	 * @since 0.1.0
	 */
	public function hooks() {
		add_action( 'admin_init', array( $this, 'init' ) );
		add_action( 'admin_menu', array( $this, 'add_options_page' ) );
		add_action( 'cmb2_admin_init', array( $this, 'add_options_page_metabox' ) );
	}


	/**
	 * Register our setting to WP
	 * @since  0.1.0
	 */
	public function init() {
		register_setting( $this->key, $this->key );
	}

	/**
	 * Add menu options page
	 * @since 0.1.0
	 */
	public function add_options_page() {
		$this->options_page = add_menu_page( $this->metabox_id, $this->title, 'manage_options', $this->key, array( $this, 'admin_page_display' ) , 'dashicons-welcome-widgets-menus', 99);

		// Include CMB CSS in the head to avoid FOUC
		// wp_register_style( 'style_CMB2',    THEME_URI.'/css/style_CMB2.css', false, '3', false );
		add_action( "admin_print_styles-{$this->options_page}", array( 'CMB2_hookup', 'enqueue_cmb_css' ) );
	}

	/**
	 * Admin page markup. Mostly handled by CMB2
	 * @since  0.1.0
	 */
	public function admin_page_display() {
		?>
		<div class="wrap cmb2-options-page <?php echo $this->key; ?>">
			<h2 style="float:right"><?php echo esc_html( $this->title ); ?></h2>
			<h2 class="nav-tab-wrapper">
				<a href="#" class="page nav-tab nav-tab-active" data-tab="home-tab">Home</a>
				<a href="#" class="page nav-tab" data-tab="about-tab">About Us</a>
				<a href="#" class="page nav-tab" data-tab="service-tab">Asesorias</a>
				<a href="#" class="page nav-tab" data-tab="libro-tab">Libro de Vida</a>
				<a href="#" class="page nav-tab" data-tab="product-tab">Productos</a>
				<a href="#" class="component nav-tab" data-tab="menu-tab">Menu</a>
				<a href="#" class="component nav-tab" data-tab="slider-tab">Slider</a>
				<a href="#" class="component nav-tab" data-tab="comment-tab">Comment</a>
				<a href="#" class="component nav-tab" data-tab="contact-tab">Contact</a>
				<a href="#" class="component nav-tab" data-tab="social-tab">Social</a>
				<a href="#" class="component nav-tab" data-tab="aside-tab">Aside</a>
				<a href="#" class="component nav-tab" data-tab="general-tab header-tab">Header</a>
				<a href="#" class="component nav-tab" data-tab="footer-tab">Footer</a>
				<!--
					<a href="#" class="nav-tab" data-tab="chatra-tab">Chatra</a>
					<a href="#" class="nav-tab" data-tab="instagram-tab">Instagram</a>
				-->
			</h2>
			<h3 style="float:right" class="tabs-title">General</h3>
			<?php cmb2_metabox_form( $this->metabox_id, $this->key ); ?>
		</div>
		<?php
		echo $this->create_tabs_script();
	}

	/**
	 * Add the options metabox to the array of metaboxes
	 * @since  0.1.0
	 */

	// after row
	public function create_tabs_script(){
		return $this->style.'
<script>
	jQuery(function () {
		jQuery(".nav-tab-wrapper a").click(function (e) {
			e.preventDefault();
			var tab_class = jQuery(this).data("tab"); 
			var target = jQuery(this).data("target");
			var title = jQuery(this).text();

			jQuery(".tabs-title").fadeOut(function(){
	          	jQuery(".tabs-title").text(title).fadeIn();
	        })

			jQuery(this).parent().find(".nav-tab").removeClass("nav-tab-active");
			jQuery(this).addClass("nav-tab-active");
		
			jQuery(".tab").not("."+tab_class).parentsUntil(".cmb-repeat-group-wrap").fadeOut(600);
			jQuery("."+tab_class).parentsUntil(".cmb-repeat-group-wrap").fadeIn(1000);

		});
		jQuery(".hide-clone").parentsUntil(".cmb-row").fadeOut();
		jQuery(".hide-remove").parentsUntil(".cmb-remove-field-row").fadeOut();
	});
</script>
<style>
	.page, .component{
		background:#6bb1a3;
		border-radius: 10px 10px 0px 0px;
		border:solid 2px gray;
		color:white;

	}
	.page:hover, .component:hover{
		background:#4b9183;
		color:black;

	}
	.component{
		background:#8bd1c3;
	}
</style>';
	}
	

	/**
	 * Hook in and add a metabox to add fields to taxonomy terms
	 */
	public function add_options_page_metabox() {


		// hook in our save notices
		add_action( "cmb2_save_options-page_fields_{$this->metabox_id}", array( $this, 'settings_notices' ), 10, 2 );

		//---------------------------------------------->
		// header
		//----------------------------------------------<
		$tabs = 'header';
		$header = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );
		$group_field_id = $header->add_field( array(
			'id'          => $tabs . '-identity',
			'type'        => 'group',
			'description' => __( '<span class="tab general-tab header-tab no-repeat"></span>', LANG ),
			'options'     => array(
				'group_title'   => __( 'Logos', LANG ), // {#} gets replaced by row number
				'add_button'    => __( '<span class="hide-clone"></span>', LANG ),
				'remove_button' => false,
				'sortable'      => false,
				'clonable'      =>false,
				'remove_button' => __( '<span class="hide-remove"></span>', LANG ), 
				'closed'     => true, // true to have the groups closed by default
			),
		) );

		$header->add_group_field( $group_field_id, array(
								'id'        => 'logo',
								'name'      => 'Logo Principal',
								'desc'      => __( 'Upload an image or enter a URL.', LANG ),
								'type'      => 'file',
							));
		$header->add_group_field( $group_field_id, array(
								'id'        => 'logo-secundario',
								'name'      => 'Logo Secundario',
								'desc'      => __( 'Upload an image or enter a URL.', LANG ),
								'type'      => 'file',
							));
		$header->add_group_field( $group_field_id, array(
								'id'        => 'logo-bg-left',
								'name'      => 'Logo Bg Left',
								'desc'      => __( 'Upload an image or enter a URL.', LANG ),
								'type'      => 'file',
							));
		$header->add_group_field( $group_field_id, array(
								'id'        => 'logo-bg-right',
								'name'      => 'Logo Bg Right',
								'desc'      => __( 'Upload an image or enter a URL.', LANG ),
								'type'      => 'file',
							));
		
		//---------------------------------------------->
		// slider static fields 
		//----------------------------------------------<
		//home
		$tabs = 'slider-middle';
		$slider = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );
		$group_field_id = $slider->add_field( array(
			'id'          => $tabs . '-group',
			'type'        => 'group',
			'description' => __( '<span class="tab home-tab slider-tab no-repeat"></span>', LANG ),
			'options'     => array(
				'group_title'   => __( 'Slider Home {#}', LANG ), // {#} gets replaced by row number
				'add_button'    => __( 'Add slider Item', LANG ),
				'remove_button' => false,
				'sortable'      => true,
				'remove_button' => __( 'Remove slider Item', LANG ), 
				'closed'     => true, // true to have the groups closed by default
			),
		) );
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'image-bg',
								'name'      => __( 'Background Image', LANG ),
								'type'      => 'file',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'shadow',
								'name'      => __( 'Shadow Color', LANG ),
								'type'      => 'colorpicker',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'shadow-opacity',
								'name'      => __( 'Shadow Color Opacity', LANG ),
								'type'      => 'text',
								'desc'=>'You must enter a %', 
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'slider-title',
								'name'      => __( 'Slider Title', LANG ),
								'type'      => 'text',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'slider-subtitle',
								'name'      => __( 'Slider Subtitle', LANG ),
								'type'      => 'text',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'slider-author',
								'name'      => __( 'Slider Author', LANG ),
								'type'      => 'text',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'slider-action-text',
								'name'      => __( 'Slider Action Text', LANG ),
								'type'      => 'text',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'slider-action-link',
								'name'      => __( 'Slider Action Link', LANG ),
								'type'      => 'text',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'image-in',
								'name'      => __( 'Secundary Image', LANG ),
								'type'      => 'file',
							));
		//victoria about us
		$tabs = 'slider-about';
		$slider = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );
		$group_field_id = $slider->add_field( array(
			'id'          => $tabs . '-group',
			'type'        => 'group',
			'description' => __( '<span class="tab about-tab slider-tab no-repeat"></span>', LANG ),
			'options'     => array(
				'group_title'   => __( 'Slider About {#}', LANG ), // {#} gets replaced by row number
				'add_button'    => __( 'Add slider Item', LANG ),
				'remove_button' => false,
				'sortable'      => true,
				'remove_button' => __( 'Remove slider Item', LANG ), 
				'closed'     => true, // true to have the groups closed by default
			),
		) );
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'image-bg',
								'name'      => __( 'Background Image', LANG ),
								'type'      => 'file',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'shadow',
								'name'      => __( 'Shadow Color', LANG ),
								'type'      => 'colorpicker',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'shadow-opacity',
								'name'      => __( 'Shadow Color Opacity', LANG ),
								'type'      => 'text',
								'desc'=>'You must enter a %', 
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'slider-title',
								'name'      => __( 'Slider Title', LANG ),
								'type'      => 'text',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'slider-subtitle',
								'name'      => __( 'Slider Subtitle', LANG ),
								'type'      => 'text',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'slider-author',
								'name'      => __( 'Slider Author', LANG ),
								'type'      => 'text',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'slider-action-text',
								'name'      => __( 'Slider Action Text', LANG ),
								'type'      => 'text',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'slider-action-link',
								'name'      => __( 'Slider Action Link', LANG ),
								'type'      => 'text',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'image-in',
								'name'      => __( 'Secundary Image', LANG ),
								'type'      => 'file',
							));
		//victoria service
		$tabs = 'slider-service';
		$slider = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );
		$group_field_id = $slider->add_field( array(
			'id'          => $tabs . '-group',
			'type'        => 'group',
			'description' => __( '<span class="tab service-tab slider-tab no-repeat"></span>', LANG ),
			'options'     => array(
				'group_title'   => __( 'Slider Asesorias {#}', LANG ), // {#} gets replaced by row number
				'add_button'    => __( 'Add slider Item', LANG ),
				'remove_button' => false,
				'sortable'      => true,
				'remove_button' => __( 'Remove slider Item', LANG ), 
				'closed'     => true, // true to have the groups closed by default
			),
		) );
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'image-bg',
								'name'      => __( 'Background Image', LANG ),
								'type'      => 'file',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'shadow',
								'name'      => __( 'Shadow Color', LANG ),
								'type'      => 'colorpicker',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'shadow-opacity',
								'name'      => __( 'Shadow Color Opacity', LANG ),
								'type'      => 'text',
								'desc'=>'You must enter a %', 
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'slider-title',
								'name'      => __( 'Slider Title', LANG ),
								'type'      => 'text',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'slider-subtitle',
								'name'      => __( 'Slider Subtitle', LANG ),
								'type'      => 'text',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'slider-author',
								'name'      => __( 'Slider Author', LANG ),
								'type'      => 'text',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'slider-action-text',
								'name'      => __( 'Slider Action Text', LANG ),
								'type'      => 'text',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'slider-action-link',
								'name'      => __( 'Slider Action Link', LANG ),
								'type'      => 'text',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'image-in',
								'name'      => __( 'Secundary Image', LANG ),
								'type'      => 'file',
							));
		//libro de vida
		$tabs = 'slider-libro';
		$slider = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );
		$group_field_id = $slider->add_field( array(
			'id'          => $tabs . '-group',
			'type'        => 'group',
			'description' => __( '<span class="tab libro-tab slider-tab no-repeat"></span>', LANG ),
			'options'     => array(
				'group_title'   => __( 'Slider Libro de Vida {#}', LANG ), // {#} gets replaced by row number
				'add_button'    => __( 'Add slider Item', LANG ),
				'remove_button' => false,
				'sortable'      => true,
				'remove_button' => __( 'Remove slider Item', LANG ), 
				'closed'     => true, // true to have the groups closed by default
			),
		) );
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'image-bg',
								'name'      => __( 'Background Image', LANG ),
								'type'      => 'file',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'shadow',
								'name'      => __( 'Shadow Color', LANG ),
								'type'      => 'colorpicker',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'shadow-opacity',
								'name'      => __( 'Shadow Color Opacity', LANG ),
								'type'      => 'text',
								'desc'=>'You must enter a %', 
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'slider-title',
								'name'      => __( 'Slider Title', LANG ),
								'type'      => 'text',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'slider-subtitle',
								'name'      => __( 'Slider Subtitle', LANG ),
								'type'      => 'text',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'slider-author',
								'name'      => __( 'Slider Author', LANG ),
								'type'      => 'text',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'slider-action-text',
								'name'      => __( 'Slider Action Text', LANG ),
								'type'      => 'text',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'slider-action-link',
								'name'      => __( 'Slider Action Link', LANG ),
								'type'      => 'text',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'image-in',
								'name'      => __( 'Secundary Image', LANG ),
								'type'      => 'file',
							));
		//libro de vida
		$tabs = 'slider-libro-about';
		$slider = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );
		$group_field_id = $slider->add_field( array(
			'id'          => $tabs . '-group',
			'type'        => 'group',
			'description' => __( '<span class="tab libro-tab slider-tab no-repeat"></span>', LANG ),
			'options'     => array(
				'group_title'   => __( 'Slider Acerca del Libro de Vida {#}', LANG ), // {#} gets replaced by row number
				'add_button'    => __( 'Add Item', LANG ),
				'remove_button' => false,
				'sortable'      => true,
				'remove_button' => __( 'Remove Item', LANG ), 
				'closed'     => true, // true to have the groups closed by default
			),
		) );
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'image-bg',
								'name'      => __( 'Background Image', LANG ),
								'type'      => 'file',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'shadow',
								'name'      => __( 'Shadow Color', LANG ),
								'type'      => 'colorpicker',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'shadow-opacity',
								'name'      => __( 'Shadow Color Opacity', LANG ),
								'type'      => 'text',
								'desc'=>'You must enter a %', 
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'slider-title',
								'name'      => __( 'Slider Title', LANG ),
								'type'      => 'text',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'slider-subtitle',
								'name'      => __( 'Slider Subtitle', LANG ),
								'type'      => 'text',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'slider-author',
								'name'      => __( 'Slider Author', LANG ),
								'type'      => 'text',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'slider-action-text',
								'name'      => __( 'Slider Action Text', LANG ),
								'type'      => 'text',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'slider-action-link',
								'name'      => __( 'Slider Action Link', LANG ),
								'type'      => 'text',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'image-in',
								'name'      => __( 'Secundary Image', LANG ),
								'type'      => 'file',
							));
		//libro de vida
		$tabs = 'slider-app-about';
		$slider = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );
		$group_field_id = $slider->add_field( array(
			'id'          => $tabs . '-group',
			'type'        => 'group',
			'description' => __( '<span class="tab libro-tab slider-tab no-repeat"></span>', LANG ),
			'options'     => array(
				'group_title'   => __( 'Slider Acerca de la App de Vida {#}', LANG ), // {#} gets replaced by row number
				'add_button'    => __( 'Add Item', LANG ),
				'remove_button' => false,
				'sortable'      => true,
				'remove_button' => __( 'Remove Item', LANG ), 
				'closed'     => true, // true to have the groups closed by default
			),
		) );
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'image-bg',
								'name'      => __( 'Background Image', LANG ),
								'type'      => 'file',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'shadow',
								'name'      => __( 'Shadow Color', LANG ),
								'type'      => 'colorpicker',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'shadow-opacity',
								'name'      => __( 'Shadow Color Opacity', LANG ),
								'type'      => 'text',
								'desc'=>'You must enter a %', 
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'slider-title',
								'name'      => __( 'Slider Title', LANG ),
								'type'      => 'text',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'slider-subtitle',
								'name'      => __( 'Slider Subtitle', LANG ),
								'type'      => 'text',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'slider-author',
								'name'      => __( 'Slider Author', LANG ),
								'type'      => 'text',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'slider-action-text',
								'name'      => __( 'Slider Action Text', LANG ),
								'type'      => 'text',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'slider-action-link',
								'name'      => __( 'Slider Action Link', LANG ),
								'type'      => 'text',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'image-in',
								'name'      => __( 'Secundary Image', LANG ),
								'type'      => 'file',
							));
		//libro de vida
		$tabs = 'slider-friends-about';
		$slider = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );
		$group_field_id = $slider->add_field( array(
			'id'          => $tabs . '-group',
			'type'        => 'group',
			'description' => __( '<span class="tab libro-tab slider-tab no-repeat"></span>', LANG ),
			'options'     => array(
				'group_title'   => __( 'Slider Amigos MLDV {#}', LANG ), // {#} gets replaced by row number
				'add_button'    => __( 'Add Item', LANG ),
				'remove_button' => false,
				'sortable'      => true,
				'remove_button' => __( 'Remove Item', LANG ), 
				'closed'     => true, // true to have the groups closed by default
			),
		) );
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'image-bg',
								'name'      => __( 'Background Image', LANG ),
								'type'      => 'file',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'shadow',
								'name'      => __( 'Shadow Color', LANG ),
								'type'      => 'colorpicker',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'shadow-opacity',
								'name'      => __( 'Shadow Color Opacity', LANG ),
								'type'      => 'text',
								'desc'=>'You must enter a %', 
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'slider-title',
								'name'      => __( 'Slider Title', LANG ),
								'type'      => 'text',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'slider-subtitle',
								'name'      => __( 'Slider Subtitle', LANG ),
								'type'      => 'text',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'slider-author',
								'name'      => __( 'Slider Author', LANG ),
								'type'      => 'text',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'slider-action-text',
								'name'      => __( 'Slider Action Text', LANG ),
								'type'      => 'text',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'slider-action-link',
								'name'      => __( 'Slider Action Link', LANG ),
								'type'      => 'text',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'image-in',
								'name'      => __( 'Secundary Image', LANG ),
								'type'      => 'file',
							));
		//libro de vida
		$tabs = 'slider-post';
		$slider = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );
		$group_field_id = $slider->add_field( array(
			'id'          => $tabs . '-group',
			'type'        => 'group',
			'description' => __( '<span class="tab libro-tab slider-tab no-repeat"></span>', LANG ),
			'options'     => array(
				'group_title'   => __( 'Slider Post {#}', LANG ), // {#} gets replaced by row number
				'add_button'    => __( 'Add Item', LANG ),
				'remove_button' => false,
				'sortable'      => true,
				'remove_button' => __( 'Remove Item', LANG ), 
				'closed'     => true, // true to have the groups closed by default
			),
		) );
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'image-bg',
								'name'      => __( 'Background Image', LANG ),
								'type'      => 'file',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'shadow',
								'name'      => __( 'Shadow Color', LANG ),
								'type'      => 'colorpicker',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'shadow-opacity',
								'name'      => __( 'Shadow Color Opacity', LANG ),
								'type'      => 'text',
								'desc'=>'You must enter a %', 
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'slider-title',
								'name'      => __( 'Slider Title', LANG ),
								'type'      => 'text',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'slider-subtitle',
								'name'      => __( 'Slider Subtitle', LANG ),
								'type'      => 'text',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'slider-author',
								'name'      => __( 'Slider Author', LANG ),
								'type'      => 'text',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'slider-action-text',
								'name'      => __( 'Slider Action Text', LANG ),
								'type'      => 'text',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'slider-action-link',
								'name'      => __( 'Slider Action Link', LANG ),
								'type'      => 'text',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'image-in',
								'name'      => __( 'Secundary Image', LANG ),
								'type'      => 'file',
							));
		//contact
		$tabs = 'slider-contact';
		$slider = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );
		$group_field_id = $slider->add_field( array(
			'id'          => $tabs . '-group',
			'type'        => 'group',
			'description' => __( '<span class="tab contact-tab slider-tab no-repeat"></span>', LANG ),
			'options'     => array(
				'group_title'   => __( 'Slider Contact {#}', LANG ), // {#} gets replaced by row number
				'add_button'    => __( 'Add Item', LANG ),
				'remove_button' => false,
				'sortable'      => true,
				'remove_button' => __( 'Remove Item', LANG ), 
				'closed'     => true, // true to have the groups closed by default
			),
		) );
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'image-bg',
								'name'      => __( 'Background Image', LANG ),
								'type'      => 'file',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'shadow',
								'name'      => __( 'Shadow Color', LANG ),
								'type'      => 'colorpicker',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'shadow-opacity',
								'name'      => __( 'Shadow Color Opacity', LANG ),
								'type'      => 'text',
								'desc'=>'You must enter a %', 
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'slider-title',
								'name'      => __( 'Slider Title', LANG ),
								'type'      => 'text',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'slider-subtitle',
								'name'      => __( 'Slider Subtitle', LANG ),
								'type'      => 'text',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'slider-author',
								'name'      => __( 'Slider Author', LANG ),
								'type'      => 'text',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'slider-action-text',
								'name'      => __( 'Slider Action Text', LANG ),
								'type'      => 'text',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'slider-action-link',
								'name'      => __( 'Slider Action Link', LANG ),
								'type'      => 'text',
							));
		$slider->add_group_field( $group_field_id, array(
								'id'        => 'image-in',
								'name'      => __( 'Secundary Image', LANG ),
								'type'      => 'file',
							));
		//---------------------------------------------->
		// libro static fields
		//----------------------------------------------<
		//home
		$tabs = 'libro';
		$libro = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );
		$group_field_id = $libro->add_field( array(
			'id'          => $tabs . '-group',
			'type'        => 'group',
			'description' => __( '<span class="tab home-tab libro-tab no-repeat"></span>', LANG ),
			'options'     => array(
				'group_title'   => __( 'Caracteristicas Home{#}', LANG ), // {#} gets replaced by row number
				'add_button'    => __( 'Add Item', LANG ),
				'remove_button' => false,
				'sortable'      => true,
				'remove_button' => __( 'Remove Item', LANG ), 
				'closed'     => true, // true to have the groups closed by default
			),
		) );
		$libro->add_group_field( $group_field_id, array(
								'id'        => 'image-bg',
								'name'      => __( 'Background Image', LANG ),
								'type'      => 'file',
							));
		$libro->add_group_field( $group_field_id, array(
								'id'        => 'color-bg',
								'name'      => __( 'Background Color', LANG ),
								'type'      => 'colorpicker',
							));
		$libro->add_group_field( $group_field_id, array(
								'id'        => 'title',
								'name'      => __( 'Title', LANG ),
								'type'      => 'text',
							));
		$libro->add_group_field( $group_field_id, array(
								'id'        => 'content',
								'name'      => __( 'Content', LANG ),
								'type'      => 'wysiwyg',
							));
		$libro->add_group_field( $group_field_id, array(
								'id'        => 'color-font',
								'name'      => __( 'Font Color', LANG ),
								'type'      => 'colorpicker',
							));
		$libro->add_group_field( $group_field_id, array(
								'id'        => 'action-text',
								'name'      => __( 'Action Text', LANG ),
								'type'      => 'text',
							));
		$libro->add_group_field( $group_field_id, array(
								'id'        => 'action-link',
								'name'      => __( 'Action Link', LANG ),
								'type'      => 'text',
							));
		$libro->add_group_field( $group_field_id, array(
								'id'        => 'image-in',
								'name'      => __( 'In Image', LANG ),
								'type'      => 'file',
							));
		$libro->add_group_field( $group_field_id, array(
								'id'        => 'align',
								'name'      => __( 'Right Image', LANG ),
								'type'      => 'checkbox',
							));
		$libro->add_group_field( $group_field_id, array(
								'id'        => 'vertical',
								'name'      => __( 'Vertical Align', LANG ),
								'type'             => 'select',
								'options'          => array(
									'flex-start' => 'Top',
									'center'     => 'Center',
									'flex-end'   => 'Bottom',
								),
							));
		//about
		$tabs = 'libro-about';
		$libro = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );
		$group_field_id = $libro->add_field( array(
			'id'          => $tabs . '-group',
			'type'        => 'group',
			'description' => __( '<span class="tab about-tab libro-tab no-repeat"></span>', LANG ),
			'options'     => array(
				'group_title'   => __( 'Caracteristicas Victoria Page {#}', LANG ), // {#} gets replaced by row number
				'add_button'    => __( 'Add Item', LANG ),
				'remove_button' => false,
				'sortable'      => true,
				'remove_button' => __( 'Remove Item', LANG ), 
				'closed'     => true, // true to have the groups closed by default
			),
		) );
		$libro->add_group_field( $group_field_id, array(
								'id'        => 'image-bg',
								'name'      => __( 'Background Image', LANG ),
								'type'      => 'file',
							));
		$libro->add_group_field( $group_field_id, array(
								'id'        => 'color-bg',
								'name'      => __( 'Background Color', LANG ),
								'type'      => 'colorpicker',
							));
		$libro->add_group_field( $group_field_id, array(
								'id'        => 'title',
								'name'      => __( 'Title', LANG ),
								'type'      => 'text',
							));
		$libro->add_group_field( $group_field_id, array(
								'id'        => 'content',
								'name'      => __( 'Content', LANG ),
								'type'      => 'wysiwyg',
							));
		$libro->add_group_field( $group_field_id, array(
								'id'        => 'color-font',
								'name'      => __( 'Font Color', LANG ),
								'type'      => 'colorpicker',
							));
		$libro->add_group_field( $group_field_id, array(
								'id'        => 'action-text',
								'name'      => __( 'Action Text', LANG ),
								'type'      => 'text',
							));
		$libro->add_group_field( $group_field_id, array(
								'id'        => 'action-link',
								'name'      => __( 'Action Link', LANG ),
								'type'      => 'text',
							));
		$libro->add_group_field( $group_field_id, array(
								'id'        => 'image-in',
								'name'      => __( 'In Image', LANG ),
								'type'      => 'file',
							));
		$libro->add_group_field( $group_field_id, array(
								'id'        => 'align',
								'name'      => __( 'Right Image', LANG ),
								'type'      => 'checkbox',
							));
		$libro->add_group_field( $group_field_id, array(
								'id'        => 'vertical',
								'name'      => __( 'Vertical Align', LANG ),
								'type'             => 'select',
								'options'          => array(
									'flex-start' => 'Top',
									'center'     => 'Center',
									'flex-end'   => 'Bottom',
								),
							));
		//about
		$tabs = 'libro-about-page';
		$libro = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );
		$group_field_id = $libro->add_field( array(
			'id'          => $tabs . '-group',
			'type'        => 'group',
			'description' => __( '<span class="tab libro-about-tab libro-tab no-repeat"></span>', LANG ),
			'options'     => array(
				'group_title'   => __( 'Comprar', LANG ), // {#} gets replaced by row number
				'add_button'    => __( '<span class="hide-clone"></span>', LANG ),
				'remove_button' => false,
				'sortable'      => false,
				'remove_button' => __( '<span class="hide-remove"></span>', LANG ),
				'closed'     => true, // true to have the groups closed by default
			),
		) );
		$libro->add_group_field( $group_field_id, array(
								'id'        => 'image-bg',
								'name'      => __( 'Background Image', LANG ),
								'type'      => 'file',
							));
		$libro->add_group_field( $group_field_id, array(
								'id'        => 'btn',
								'name'      => __( 'Butoon Text', LANG ),
								'type'      => 'text',
							));
		$libro->add_group_field( $group_field_id, array(
								'id'        => 'btn-link',
								'name'      => __( 'Button Link', LANG ),
								'type'      => 'text',
							));
		$libro->add_group_field( $group_field_id, array(
								'id'        => 'pdf',
								'name'      => __( 'Pdf File', LANG ),
								'type'      => 'file',
							));
		$libro->add_group_field( $group_field_id, array(
								'id'        => 'pdf-btn',
								'name'      => __( 'Pdf Button text', LANG ),
								'type'      => 'text',
							));
		$libro->add_group_field( $group_field_id, array(
								'id'        => 'pdf-img',
								'name'      => __( 'Pdf Front Image', LANG ),
								'type'      => 'file',
							));
		$libro->add_group_field( $group_field_id, array(
								'id'        => 'modal-title',
								'name'      => __( 'Modal Title', LANG ),
								'type'      => 'text',
							));
		$tabs = 'libro-about-modal';
		$libro = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );
		$group_field_id = $libro->add_field( array(
			'id'          => $tabs . '-group',
			'type'        => 'group',
			'description' => __( '<span class="tab libro-about-tab libro-tab no-repeat"></span>', LANG ),
			'options'     => array(
				'group_title'   => __( 'Comprar Modal {#}', LANG ), //  gets replaced by row number
				'add_button'    => __( 'Add Item', LANG ),
				'remove_button' => false,
				'sortable'      => true,
				'remove_button' => __( 'Remove Item', LANG ),
				'closed'     => true, // true to have the groups closed by default
			),
		) );
		$libro->add_group_field( $group_field_id, array(
								'id'        => 'title1',
								'name'      => __( 'Titulo 1', LANG ),
								'type'      => 'text',
							));
		$libro->add_group_field( $group_field_id, array(
								'id'        => 'title2',
								'name'      => __( 'Titulo 2', LANG ),
								'type'      => 'text',
							));
		$libro->add_group_field( $group_field_id, array(
								'id'        => 'content',
								'name'      => __( 'Descripción', LANG ),
								'type'      => 'textarea_small',
							));
		$libro->add_group_field( $group_field_id, array(
								'id'        => 'action-text',
								'name'      => __( 'Action Text', LANG ),
								'type'      => 'text',
							));
		$libro->add_group_field( $group_field_id, array(
								'id'        => 'action-link',
								'name'      => __( 'Action Link', LANG ),
								'type'      => 'text',
							));
		$libro->add_group_field( $group_field_id, array(
								'id'        => 'img',
								'name'      => __( 'Image', LANG ),
								'type'      => 'file',
							));
		//about
		$tabs = 'app-about-page';
		$libro = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );
		$group_field_id = $libro->add_field( array(
			'id'          => $tabs . '-group',
			'type'        => 'group',
			'description' => __( '<span class="tab libro-tab no-repeat"></span>', LANG ),
			'options'     => array(
				'group_title'   => __( 'about App Extra content', LANG ), // {#} gets replaced by row number
				'add_button'    => __( '<span class="hide-clone"></span>', LANG ),
				'remove_button' => false,
				'sortable'      => false,
				'remove_button' => __( '<span class="hide-remove"></span>', LANG ),
				'closed'     => true, // true to have the groups closed by default
			),
		) );
		$libro->add_group_field( $group_field_id, array(
								'id'        => 'subtitle',
								'name'      => __( 'Sub-title', LANG ),
								'type'      => 'text',
							));
		$libro->add_group_field( $group_field_id, array(
								'id'        => 'content',
								'name'      => __( 'Benefits', LANG ),
								'type'      => 'wysiwyg',
							));
		$libro->add_group_field( $group_field_id, array(
								'id'        => 'footer-img',
								'name'      => __( 'Footer Image', LANG ),
								'type'      => 'file',
							));
		//about
		$tabs = 'app-about-page-item';
		$libro = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );
		$group_field_id = $libro->add_field( array(
			'id'          => $tabs . '-group',
			'type'        => 'group',
			'description' => __( '<span class="tab libro-tab no-repeat"></span>', LANG ),
			'options'     => array(
				'group_title'   => __( 'App Step {#} ', LANG ), // {#} gets replaced by row number
				'add_button'    => __( 'Add Item', LANG ),
				'remove_button' => false,
				'sortable'      => true,
				'remove_button' => __( 'Remove Item', LANG ),
				'closed'     => true, // true to have the groups closed by default
			),
		) );
		$libro->add_group_field( $group_field_id, array(
								'id'        => 'title',
								'name'      => __( 'Title', LANG ),
								'type'      => 'text',
							));
		$libro->add_group_field( $group_field_id, array(
								'id'        => 'subtitle',
								'name'      => __( 'Sub-title', LANG ),
								'type'      => 'text',
							));
		$libro->add_group_field( $group_field_id, array(
								'id'        => 'img',
								'name'      => __( 'Image', LANG ),
								'type'      => 'file',
							));
		//about
		$tabs = 'friends-about-page';
		$libro = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );
		$group_field_id = $libro->add_field( array(
			'id'          => $tabs . '-group',
			'type'        => 'group',
			'description' => __( '<span class="tab libro-tab no-repeat"></span>', LANG ),
			'options'     => array(
				'group_title'   => __( 'Friends Content  ', LANG ), // {#} gets replaced by row number
				'add_button'    => __( '<span class="hide-clone"></span>', LANG ),
				'remove_button' => false,
				'sortable'      => false,
				'remove_button' => __( '<span class="hide-remove"></span>', LANG ),
				'closed'     => true, // true to have the groups closed by default
			),
		) );
		$libro->add_group_field( $group_field_id, array(
								'id'        => 'title',
								'name'      => __( 'Title', LANG ),
								'type'      => 'text',
							));
		$libro->add_group_field( $group_field_id, array(
								'id'        => 'subtitle',
								'name'      => __( 'Sub-title', LANG ),
								'type'      => 'text',
							));
		$libro->add_group_field( $group_field_id, array(
								'id'        => 'content',
								'name'      => __( 'Content', LANG ),
								'type'      => 'wysiwyg',
							));
		$libro->add_group_field( $group_field_id, array(
								'id'        => 'img',
								'name'      => __( 'Image', LANG ),
								'type'      => 'file',
							));
		//about
		$tabs = 'friends-about-page-item';
		$libro = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );
		$group_field_id = $libro->add_field( array(
			'id'          => $tabs . '-group',
			'type'        => 'group',
			'description' => __( '<span class="tab libro-tab no-repeat"></span>', LANG ),
			'options'     => array(
				'group_title'   => __( 'Friends {#} ', LANG ), // {#} gets replaced by row number
				'add_button'    => __( 'Add Item', LANG ),
				'remove_button' => false,
				'sortable'      => true,
				'remove_button' => __( 'Remove Item', LANG ),
				'closed'     => true, // true to have the groups closed by default
			),
		) );
		$libro->add_group_field( $group_field_id, array(
								'id'        => 'link',
								'name'      => __( 'Link', LANG ),
								'type'      => 'text',
							));
		$libro->add_group_field( $group_field_id, array(
								'id'        => 'img',
								'name'      => __( 'Image', LANG ),
								'type'      => 'file',
							));
		//service
		$tabs = 'service-general-page';
		$service = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );
		$group_field_id = $service->add_field( array(
			'id'          => $tabs . '-group',
			'type'        => 'group',
			'description' => __( '<span class="tab service-tab no-repeat"></span>', LANG ),
			'options'     => array(
				'group_title'   => __( 'Service General ', LANG ), // {#} gets replaced by row number
				'add_button'    => __( '<span class="hide-clone"></span>', LANG ),
				'remove_button' => false,
				'sortable'      => false,
				'remove_button' => __( '<span class="hide-remove"></span>', LANG ),
				'closed'     => true, // true to have the groups closed by default
			),
		) );
		$service->add_group_field( $group_field_id, array(
								'id'        => 'title',
								'name'      => __( 'Title Service Areas', LANG ),
								'type'      => 'text',
							));
		$service->add_group_field( $group_field_id, array(
								'id'        => 'bg-separador-1',
								'name'      => __( 'Separador 1', LANG ),
								'type'      => 'file',
							));
		$service->add_group_field( $group_field_id, array(
								'id'        => 'bg-separador-2',
								'name'      => __( 'Separador 2', LANG ),
								'type'      => 'file',
							));

		$tabs = 'service-page';
		$service = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );
		$group_field_id = $service->add_field( array(
			'id'          => $tabs . '-group',
			'type'        => 'group',
			'description' => __( '<span class="tab service-tab no-repeat"></span>', LANG ),
			'options'     => array(
				'group_title'   => __( 'Service Item {#} ', LANG ), // {#} gets replaced by row number
				'add_button'    => __( 'Add Item', LANG ),
				'remove_button' => false,
				'sortable'      => true,
				'remove_button' => __( 'Remove Item', LANG ),
				'closed'     => true, // true to have the groups closed by default
			),
		) );
		$service->add_group_field( $group_field_id, array(
								'id'        => 'img',
								'name'      => __( 'Image', LANG ),
								'type'      => 'file',
							));
		$service->add_group_field( $group_field_id, array(
								'id'        => 'title',
								'name'      => __( 'Title', LANG ),
								'type'      => 'text',
							));
		$service->add_group_field( $group_field_id, array(
								'id'        => 'content',
								'name'      => __( 'Contenido', LANG ),
								'type'      => 'textarea_small',
							));
		$service->add_group_field( $group_field_id, array(
								'id'        => 'action',
								'name'      => __( 'Action', LANG ),
								'type'      => 'text',
							));
		$service->add_group_field( $group_field_id, array(
								'id'        => 'right',
								'name'      => __( 'Right Text', LANG ),
								'type'      => 'checkbox',
							));
				//service
		$tabs = 'service-areas-page';
		$service = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );
		$group_field_id = $service->add_field( array(
			'id'          => $tabs . '-group',
			'type'        => 'group',
			'description' => __( '<span class="tab service-tab no-repeat"></span>', LANG ),
			'options'     => array(
				'group_title'   => __( 'Service Area {#} ', LANG ), // {#} gets replaced by row number
				'add_button'    => __( 'Add Item', LANG ),
				'remove_button' => false,
				'sortable'      => true,
				'remove_button' => __( 'Remove Item', LANG ),
				'closed'     => true, // true to have the groups closed by default
			),
		) );
		$service->add_group_field( $group_field_id, array(
								'id'        => 'img',
								'name'      => __( 'Image', LANG ),
								'type'      => 'file',
							));
		$service->add_group_field( $group_field_id, array(
								'id'        => 'title',
								'name'      => __( 'Title', LANG ),
								'type'      => 'text',
							));
		$service->add_group_field( $group_field_id, array(
								'id'        => 'content',
								'name'      => __( 'Contenido', LANG ),
								'type'      => 'textarea_small',
							));
		//---------------------------------------------->
		// comment fields
		//----------------------------------------------<
		//home
		$tabs = 'comment';
		$comment = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );
		$group_field_id = $comment->add_field( array(
			'id'          => $tabs . '-group',
			'type'        => 'group',
			'description' => __( '<span class="tab home-tab comment-tab no-repeat"></span>', LANG ),
			'options'     => array(
				'group_title'   => __( 'Testimonios', LANG ), // {#} gets replaced by row number
				'add_button'    => __( '<span class="hide-clone"></span>', LANG ),
				'remove_button' => false,
				'sortable'      => false,
				'remove_button' => __( '<span class="hide-remove"></span>', LANG ), 
				'closed'     => true, // true to have the groups closed by default
			),
		) );
		$comment->add_group_field( $group_field_id, array(
								'id'        => 'title',
								'name'      => __( 'Title Section', LANG ),
								'type'      => 'text',
							));
		$comment->add_group_field( $group_field_id, array(
								'id'        => 'img',
								'name'      => __( 'Comillas Gigantes', LANG ),
								'type'      => 'file',
							));
		$comment->add_group_field( $group_field_id, array(
								'id'        => 'count',
								'name'      => __( 'Comentarios a mostrar', LANG ),
								'type'             => 'select',
								'options'          => array(
									'1' => 'Uno',
									'2' => 'Dos',
									'3' => 'Tres',
								),
							));
		$tabs = 'comment-item';
		$comment = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );
		$group_field_id = $comment->add_field( array(
			'id'          => $tabs . '-group',
			'type'        => 'group',
			'description' => __( '<span class="tab home-tab comment-tab no-repeat"></span>', LANG ),
			'options'     => array(
				'group_title'   => __( 'Testimonios Home {#}', LANG ), // {#} gets replaced by row number
				'add_button'    => __( 'Add Item', LANG ),
				'remove_button' => false,
				'sortable'      => true,
				'remove_button' => __( 'Remove Item', LANG ), 
				'closed'     => true, // true to have the groups closed by default
			),
		) );
		$comment->add_group_field( $group_field_id, array(
								'id'        => 'author',
								'name'      => __( 'Author', LANG ),
								'type'      => 'text',
							));
		$comment->add_group_field( $group_field_id, array(
								'id'        => 'title',
								'name'      => __( 'Title', LANG ),
								'type'      => 'text',
							));
		$comment->add_group_field( $group_field_id, array(
								'id'        => 'content',
								'name'      => __( 'Content', LANG ),
								'type'      => 'wysiwyg',
							));
		//about
		$tabs = 'comment-item-about';
		$comment = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );
		$group_field_id = $comment->add_field( array(
			'id'          => $tabs . '-group',
			'type'        => 'group',
			'description' => __( '<span class="tab about-tab comment-tab no-repeat"></span>', LANG ),
			'options'     => array(
				'group_title'   => __( 'Comentarios About Item {#}', LANG ), // {#} gets replaced by row number
				'add_button'    => __( 'Add Item', LANG ),
				'remove_button' => false,
				'sortable'      => true,
				'remove_button' => __( 'Remove Item', LANG ), 
				'closed'     => true, // true to have the groups closed by default
			),
		) );
		$comment->add_group_field( $group_field_id, array(
								'id'        => 'author',
								'name'      => __( 'Author', LANG ),
								'type'      => 'text',
							));
		$comment->add_group_field( $group_field_id, array(
								'id'        => 'title',
								'name'      => __( 'Title', LANG ),
								'type'      => 'text',
							));
		$comment->add_group_field( $group_field_id, array(
								'id'        => 'content',
								'name'      => __( 'Content', LANG ),
								'type'      => 'wysiwyg',
							));
		//about
		$tabs = 'comment-item-service';
		$comment = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );
		$group_field_id = $comment->add_field( array(
			'id'          => $tabs . '-group',
			'type'        => 'group',
			'description' => __( '<span class="tab service-tab comment-tab no-repeat"></span>', LANG ),
			'options'     => array(
				'group_title'   => __( 'Comentarios Asesorias Item {#}', LANG ), // {#} gets replaced by row number
				'add_button'    => __( 'Add Item', LANG ),
				'remove_button' => false,
				'sortable'      => true,
				'remove_button' => __( 'Remove Item', LANG ), 
				'closed'     => true, // true to have the groups closed by default
			),
		) );
		$comment->add_group_field( $group_field_id, array(
								'id'        => 'author',
								'name'      => __( 'Author', LANG ),
								'type'      => 'text',
							));
		$comment->add_group_field( $group_field_id, array(
								'id'        => 'title',
								'name'      => __( 'Title', LANG ),
								'type'      => 'text',
							));
		$comment->add_group_field( $group_field_id, array(
								'id'        => 'content',
								'name'      => __( 'Content', LANG ),
								'type'      => 'wysiwyg',
							));
		//about libro
		$tabs = 'comment-item-about-libro';
		$comment = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );
		$group_field_id = $comment->add_field( array(
			'id'          => $tabs . '-group',
			'type'        => 'group',
			'description' => __( '<span class="tab about-tab comment-tab no-repeat"></span>', LANG ),
			'options'     => array(
				'group_title'   => __( 'Comentarios About Libro Item {#}', LANG ), // {#} gets replaced by row number
				'add_button'    => __( 'Add Item', LANG ),
				'remove_button' => false,
				'sortable'      => true,
				'remove_button' => __( 'Remove Item', LANG ), 
				'closed'     => true, // true to have the groups closed by default
			),
		) );
		$comment->add_group_field( $group_field_id, array(
								'id'        => 'author',
								'name'      => __( 'Author', LANG ),
								'type'      => 'text',
							));
		$comment->add_group_field( $group_field_id, array(
								'id'        => 'title',
								'name'      => __( 'Title', LANG ),
								'type'      => 'text',
							));
		$comment->add_group_field( $group_field_id, array(
								'id'        => 'content',
								'name'      => __( 'Content', LANG ),
								'type'      => 'wysiwyg',
							));
		//about app
		$tabs = 'comment-item-about-app';
		$comment = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );
		$group_field_id = $comment->add_field( array(
			'id'          => $tabs . '-group',
			'type'        => 'group',
			'description' => __( '<span class="tab about-tab comment-tab no-repeat"></span>', LANG ),
			'options'     => array(
				'group_title'   => __( 'Comentarios About App Item {#}', LANG ), // {#} gets replaced by row number
				'add_button'    => __( 'Add Item', LANG ),
				'remove_button' => false,
				'sortable'      => true,
				'remove_button' => __( 'Remove Item', LANG ), 
				'closed'     => true, // true to have the groups closed by default
			),
		) );
		$comment->add_group_field( $group_field_id, array(
								'id'        => 'author',
								'name'      => __( 'Author', LANG ),
								'type'      => 'text',
							));
		$comment->add_group_field( $group_field_id, array(
								'id'        => 'title',
								'name'      => __( 'Title', LANG ),
								'type'      => 'text',
							));
		$comment->add_group_field( $group_field_id, array(
								'id'        => 'content',
								'name'      => __( 'Content', LANG ),
								'type'      => 'wysiwyg',
							));
		// ---------------------------------------------->
		// product static fields
		// ----------------------------------------------<
		$tabs = 'product';
		$product = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );
		$group_field_id = $product->add_field( array(
			'id'          => $tabs . '-group',
			'type'        => 'group',
			'description' => __( '<span class="tab product-tab libro-tab no-repeat"></span>', LANG ),
			'options'     => array(
				'group_title'   => __( 'Productos Mi Libro de Vida{#}', LANG ), // {#} gets replaced by row number
				'add_button'    => __( 'Add Item', LANG ),
				'remove_button' => false,
				'sortable'      => true,
				'remove_button' => __( 'Remove Item', LANG ), 
				'closed'     => true, // true to have the groups closed by default
			),
		) );
		$product->add_group_field( $group_field_id, array(
								'id'        => 'icon',
								'name'      => __( 'Product Icon', LANG ),
								'type'      => 'file',
							));
		$product->add_group_field( $group_field_id, array(
								'id'        => 'link',
								'name'      => __( 'Product Link', LANG ),
								'type'      => 'text',
							));
		$product->add_group_field( $group_field_id, array(
								'id'        => 'btn',
								'name'      => __( 'Product Text', LANG ),
								'type'      => 'text',
							));

		$tabs = 'twitter-about';
		$about = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );
		$group_field_id = $about->add_field( array(
			'id'          => $tabs . '-group',
			'type'        => 'group',
			'description' => __( '<span class="tab about-tab social-tab no-repeat"></span>', LANG ),
			'options'     => array(
				'group_title'   => __( 'Twitter Section', LANG ), // {#} gets replaced by row number
				'add_button'    => __( '<span class="hide-clone"></span>', LANG ),
				'remove_button' => false,
				'sortable'      => false,
				'remove_button' => __( '<span class="hide-remove"></span>', LANG ),  
				'closed'     => true, // true to have the groups closed by default
			),
		) );
		$about->add_group_field( $group_field_id, array(
								'id'        => 'twitter-img',
								'name'      => __( 'Twitter Image', LANG ),
								'type'      => 'file',
							));
		$about->add_group_field( $group_field_id, array(
								'id'        => 'twitter-btn',
								'name'      => __( 'Twitter Button', LANG ),
								'type'      => 'text',
							));
		$tabs = 'twitter-about-item';
		$about = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );
		$group_field_id = $about->add_field( array(
			'id'          => $tabs . '-group',
			'type'        => 'group',
			'description' => __( '<span class="tab about-tab social-tab no-repeat"></span>', LANG ),
			'options'     => array(
				'group_title'   => __( 'Twitter Item {#}', LANG ), // {#} gets replaced by row number
				'add_button'    => __( 'Add Item', LANG ),
				'remove_button' => false,
				'sortable'      => true,
				'remove_button' => __( 'Remove Item', LANG ), 
				'closed'     => true, // true to have the groups closed by default
			),
		) );
		$about->add_group_field( $group_field_id, array(
								'id'        => 'twitter',
								'name'      => __( 'Twitter Text', LANG ),
								'type'      => 'text',
							));

		
		
		
		//---------------------------------------------->
		// about us
		//----------------------------------------------<
		$tabs = 'about-content';
		$about = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );
		$group_field_id = $about->add_field( array(
			'id'          => $tabs . '-group',
			'type'        => 'group',
			'description' => __( '<span class="tab about-tab no-repeat"></span>', LANG ),
			'options'     => array(
				'group_title'   => __( 'About Content', LANG ), // {#} gets replaced by row number
				'add_button'    => __( '<span class="hide-clone"></span>', LANG ),
				'remove_button' => false,
				'sortable'      => false,
				'remove_button' => __( '<span class="hide-remove"></span>', LANG ), 
				'closed'     => true, // true to have the groups closed by default
			),
		) );
		$about->add_group_field( $group_field_id, array(
								'id'        => 'bg',
								'name'      => __( 'Background', LANG ),
								'type'      => 'file',
							));
		$about->add_group_field( $group_field_id, array(
								'id'        => 'img',
								'name'      => __( 'Thumb', LANG ),
								'type'      => 'file',
							));
		$about->add_group_field( $group_field_id, array(
								'id'        => 'title',
								'name'      => __( 'Title', LANG ),
								'type'      => 'text',
							));
		$about->add_group_field( $group_field_id, array(
								'id'        => 'content',
								'name'      => __( 'Content', LANG ),
								'type'      => 'wysiwyg',
							));
		$tabs = 'about-values';
		$about = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );
		$group_field_id = $about->add_field( array(
			'id'          => $tabs . '-group',
			'type'        => 'group',
			'description' => __( '<span class="tab about-tab no-repeat"></span>', LANG ),
			'options'     => array(
				'group_title'   => __( 'About Values', LANG ), // {#} gets replaced by row number
				'add_button'    => __( '<span class="hide-clone"></span>', LANG ),
				'remove_button' => false,
				'sortable'      => false,
				'remove_button' => __( '<span class="hide-remove"></span>', LANG ), 
				'closed'     => true, // true to have the groups closed by default
			),
		) );
		$about->add_group_field( $group_field_id, array(
								'id'        => 'bg',
								'name'      => __( 'Background', LANG ),
								'type'      => 'file',
							));
		$about->add_group_field( $group_field_id, array(
								'id'        => 'title',
								'name'      => __( 'Title', LANG ),
								'type'      => 'text',
							));
		$about->add_group_field( $group_field_id, array(
								'id'        => 'bg-color',
								'name'      => __( 'Bg Color', LANG ),
								'type'      => 'colorpicker',
							));
		$tabs = 'about-values-item';
		$about = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );
		$group_field_id = $about->add_field( array(
			'id'          => $tabs . '-group',
			'type'        => 'group',
			'description' => __( '<span class="tab about-tab no-repeat"></span>', LANG ),
			'options'     => array(
				'group_title'   => __( 'About Value Item {#}', LANG ), // {#} gets replaced by row number
				'add_button'    => __( 'Add Item', LANG ),
				'remove_button' => false,
				'sortable'      => true,
				'remove_button' => __( 'Remove Item', LANG ),  
				'closed'     => true, // true to have the groups closed by default
			),
		) );
		$about->add_group_field( $group_field_id, array(
								'id'        => 'icon',
								'name'      => __( 'Icon', LANG ),
								'type'      => 'file',
							));
		$about->add_group_field( $group_field_id, array(
								'id'        => 'title',
								'name'      => __( 'Title', LANG ),
								'type'      => 'text',
							));
		$about->add_group_field( $group_field_id, array(
								'id'        => 'content',
								'name'      => __( 'Content', LANG ),
								'type'      => 'textarea_small',
							));
		$tabs = 'about-office';
		$about = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );
		$group_field_id = $about->add_field( array(
			'id'          => $tabs . '-group',
			'type'        => 'group',
			'description' => __( '<span class="tab about-tab no-repeat"></span>', LANG ),
			'options'     => array(
				'group_title'   => __( 'About Office', LANG ), // {#} gets replaced by row number
				'add_button'    => __( '<span class="hide-clone"></span>', LANG ),
				'remove_button' => false,
				'sortable'      => false,
				'remove_button' => __( '<span class="hide-remove"></span>', LANG ), 
				'closed'     => true, // true to have the groups closed by default
			),
		) );
		$about->add_group_field( $group_field_id, array(
								'id'        => 'bg',
								'name'      => __( 'Background', LANG ),
								'type'      => 'file',
							));
		$about->add_group_field( $group_field_id, array(
								'id'        => 'img',
								'name'      => __( 'Thumb', LANG ),
								'type'      => 'file_list',
							));
		$about->add_group_field( $group_field_id, array(
								'id'        => 'title',
								'name'      => __( 'Title', LANG ),
								'type'      => 'text',
							));
		$about->add_group_field( $group_field_id, array(
								'id'        => 'content',
								'name'      => __( 'Content', LANG ),
								'type'      => 'wysiwyg',
							));
		//---------------------------------------------->
		// aside
		//----------------------------------------------<
		$tabs = 'aside';
		$aside = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );
		$group_field_id = $aside->add_field( array(
			'id'          => $tabs . '-group',
			'type'        => 'group',
			'description' => __( '<span class="tab aside-tab no-repeat"></span>', LANG ),
			'options'     => array(
				'group_title'   => __( 'Aside Noticias', LANG ), // {#} gets replaced by row number
				'add_button'    => __( '<span class="hide-clone"></span>', LANG ),
				'remove_button' => false,
				'sortable'      => false,
				'remove_button' => __( '<span class="hide-remove"></span>', LANG ),
				'closed'     => true, // true to have the groups closed by default
			),
		) );
		$aside->add_group_field( $group_field_id, array(
								'id'        => 'cats',
								'name'      => __( 'Categorías de Noticias', LANG ),
								'type'      => 'text',
							));
		$aside->add_group_field( $group_field_id, array(
								'id'        => 'recientes',
								'name'      => __( 'Noticias Recientes', LANG ),
								'type'      => 'text',
							));
		$aside->add_group_field( $group_field_id, array(
								'id'        => 'tags',
								'name'      => __( 'Etiquetas', LANG ),
								'type'      => 'text',
							));
		$aside->add_group_field( $group_field_id, array(
								'id'        => 'file',
								'name'      => __( 'Archivo de Noticias', LANG ),
								'type'      => 'text',
							));	
		//---------------------------------------------->
		// social
		//----------------------------------------------<
		$tabs = 'social';
		$footer = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );
		$group_field_id = $footer->add_field( array(
			'id'          => $tabs . '-group',
			'type'        => 'group',
			'description' => __( '<span class="tab footer-tab social-tab"></span>', LANG ),
			'options'     => array(
				'group_title'   => __( 'Social {#}', LANG ), // {#} gets replaced by row number
				'add_button'    => __( 'Add Social Item', LANG ),
				'remove_button' => false,
				'sortable'      => false,
				'remove_button' => __( 'Remove Social Item', LANG ), 
				'closed'     => true, // true to have the groups closed by default
			),
		) );
		$footer->add_group_field( $group_field_id, array(
								'id'        => 'social-icon',
								'name'      => __( 'Social Icon (Fontawesome)', LANG ),
								'type'             => 'select',
								'options'          => array(
									'fa-facebook' => 'Facebook',
									'fa-twitter' => 'Twitter',
									'fa-instagram' => 'Instagram',
									'fa-pinterest' => 'Pinterest',
									'fa-yelp' => 'Yelp',
									'fa-tripadvisor' => 'Tripadvisor',
									'fa-youtube' => 'Youtube',
								),
							));
		$footer->add_group_field( $group_field_id, array(
								'id'        => 'social-link',
								'name'      => __( 'Social Link', LANG ),
								'type'      => 'text',
							));
		$footer->add_group_field( $group_field_id, array(
								'id'        => 'social-label',
								'name'      => __( 'Social Label', LANG ),
								'type'      => 'text',
							));
		//---------------------------------------------->
		// footer sponsor
		//----------------------------------------------<
		$tabs = 'sponsor';
		$sponsor = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );
		$group_field_id = $sponsor->add_field( array(
			'id'          => $tabs . '-group',
			'type'        => 'group',
			'description' => __( '<span class="tab footer-tab no-repeat"></span>', LANG ),
			'options'     => array(
				'group_title'   => __( 'Sponsor', LANG ), // {#} gets replaced by row number
				'add_button'    => __( 'Add Item', LANG ),
				'remove_button' => false,
				'sortable'      => true,
				'remove_button' => __( 'Remove Item', LANG ), 
				'closed'     => true, // true to have the groups closed by default
			),
		) );
		$sponsor->add_group_field( $group_field_id, array(
								'id'        => 'sponsor',
								'name'      => __( 'Sponsor Image', LANG ),
								'type'      => 'file',
							));
		$sponsor->add_group_field( $group_field_id, array(
								'id'        => 'sponsor-link',
								'name'      => __( 'Sponsor Link', LANG ),
								'type'      => 'text',
							));
		//---------------------------------------------->
		// contact
		//----------------------------------------------<
		$tabs = 'contact';
		$contact = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );
		$group_field_id = $contact->add_field( array(
			'id'          => $tabs . '-group',
			'type'        => 'group',
			'description' => __( '<span class="tab contact-tab footer-tab no-repeat"></span>', LANG ),
			'options'     => array(
				'group_title'   => __( 'Contact Form', LANG ), // {#} gets replaced by row number
				'add_button'    => __( '<span class="hide-clone"></span>', LANG ),
				'remove_button' => false,
				'sortable'      => false,
				'remove_button' => __( '<span class="hide-remove"></span>', LANG ),
				'closed'     => true, // true to have the groups closed by default
			),
		) );
		$contact->add_group_field( $group_field_id, array(
								'id'        => 'title',
								'name'      => __( 'Title', LANG ),
								'type'      => 'text',
							));
		$contact->add_group_field( $group_field_id, array(
								'id'        => 'form',
								'name'      => __( 'Form', LANG ),
								'type'      => 'text',
							));
		$contact->add_group_field( $group_field_id, array(
								'id'        => 'contact',
								'name'      => __( 'Contact text', LANG ),
								'type'      => 'text',
							));
		$contact->add_group_field( $group_field_id, array(
								'id'        => 'phone',
								'name'      => __( 'Phone', LANG ),
								'type'      => 'text',
							));
		$tabs = 'contact-help';
		$contact = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );
		$group_field_id = $contact->add_field( array(
			'id'          => $tabs . '-group',
			'type'        => 'group',
			'description' => __( '<span class="tab contact-tab footer-tab no-repeat"></span>', LANG ),
			'options'     => array(
				'group_title'   => __( 'Contact Help {#}', LANG ), // {#} gets replaced by row number
				'add_button'    => __( 'Add Item', LANG ),
				'remove_button' => false,
				'sortable'      => false,
				'remove_button' => __( 'Remove Item', LANG ),
				'closed'     => true, // true to have the groups closed by default
			),
		) );
		$contact->add_group_field( $group_field_id, array(
								'id'        => 'title',
								'name'      => __( 'Title', LANG ),
								'type'      => 'text',
							));
		$contact->add_group_field( $group_field_id, array(
								'id'        => 'content',
								'name'      => __( 'Content', LANG ),
								'type'      => 'text',
							));
		$contact->add_group_field( $group_field_id, array(
								'id'        => 'link',
								'name'      => __( 'Link', LANG ),
								'type'      => 'text',
							));
		//---------------------------------------------->
		// footer
		//----------------------------------------------<
		$tabs = 'footer';
		$footer = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );
		$group_field_id = $footer->add_field( array(
			'id'          => $tabs . '-group',
			'type'        => 'group',
			'description' => __( '<span class="tab footer-tab no-repeat"></span>', LANG ),
			'options'     => array(
				'group_title'   => __( 'Copyright', LANG ), // {#} gets replaced by row number
				'add_button'    => __( '<span class="hide-clone"></span>', LANG ),
				'remove_button' => false,
				'sortable'      => false,
				'remove_button' => __( '<span class="hide-remove"></span>', LANG ),
				'closed'     => true, // true to have the groups closed by default
			),
		) );
		$footer->add_group_field( $group_field_id, array(
								'id'        => 'copy',
								'name'      => __( 'Copyright', LANG ),
								'type'      => 'text',
							));
		$footer->add_group_field( $group_field_id, array(
								'id'        => 'footer-tender',
								'name'      => __( 'Footer Image Top', LANG ),
								'type'      => 'file',
							));
		$footer->add_group_field( $group_field_id, array(
								'id'        => 'footer-img',
								'name'      => __( 'Footer Image Bench', LANG ),
								'type'      => 'file',
							));
		
		// //---------------------------------------------->
		// // chatra
		// //----------------------------------------------<
		// $tabs = 'chatra';
		// $chatra = new_cmb2_box( array(
		// 	'id'         => $this->metabox_id,
		// 	'hookup'     => false,
		// 	'cmb_styles' => false,
		// 	'show_on'    => array(
		// 		// These are important, don't remove
		// 		'key'   => 'options-page',
		// 		'value' => array( $this->key, )
		// 	),
		// ) );
		// $group_field_id = $home->add_field( array(
		// 	'id'          => $tabs . '-group',
		// 	'type'        => 'group',
		// 	'description' => __( '<span class="tab chatra-tab no-repeat"></span>', LANG ),
		// 	'options'     => array(
		// 		'group_title'   => __( 'Chatra', LANG ), // {#} gets replaced by row number
		// 		'add_button'    => __( '<span class="hide-clone"></span>', LANG ),
		// 		'remove_button' => false,
		// 		'sortable'      => false,
		// 		'remove_button' => __( '<span class="hide-remove"></span>', LANG ),
		// 		'closed'     => true, // true to have the groups closed by default
		// 	),
		// ) );
		// $chatra->add_group_field( $group_field_id, array(
		// 						'id'        => 'code',
		// 						'name'      => 'Chatra Code',
		// 						'type'      => 'textarea',
		// 						'desc'      => 'Enter the chatra code.', 
		// 					));
		// //---------------------------------------------->
		// // instagram
		// //----------------------------------------------<
		// $tabs = 'instagram';
		// $home = new_cmb2_box( array(
		// 	'id'         => $this->metabox_id,
		// 	'hookup'     => false,
		// 	'cmb_styles' => false,
		// 	'show_on'    => array(
		// 		// These are important, don't remove
		// 		'key'   => 'options-page',
		// 		'value' => array( $this->key, )
		// 	),
		// ) );
		// $group_field_id = $home->add_field( array(
		// 	'id'          => $tabs . '-instagram',
		// 	'type'        => 'group',
		// 	'description' => __( '<span class="tab instagram-tab no-repeat"></span>', LANG ),
		// 	'options'     => array(
		// 		'group_title'   => __( 'Instagram', LANG ), // {#} gets replaced by row number
		// 		'add_button'    => __( '<span class="hide-clone"></span>', LANG ),
		// 		'remove_button' => false,
		// 		'sortable'      => false,
		// 		'remove_button' => __( '<span class="hide-remove"></span>', LANG ),
		// 		'closed'     => true, // true to have the groups closed by default
		// 	),
		// ) );
		// $home->add_group_field( $group_field_id, array(
		// 						'id'        => $tabs . '-api-client',
		// 						'name'      => __( 'Instagram API Client', LANG ),
		// 						'type'      => 'text',
		// 					));
		// $home->add_group_field( $group_field_id, array(
		// 						'id'        => $tabs . '-api-token',
		// 						'name'      => __( 'Instagram API Token', LANG ),
		// 						'type'      => 'text',
		// 					));
		// $home->add_group_field( $group_field_id, array(
		// 						'id'        => $tabs . '-api-fee',
		// 						'name'      => __( 'Image Fee', LANG ),
		// 						'type'      => 'text',
		// 					));
		// $home->add_group_field( $group_field_id, array(
		// 						'id'        => $tabs . '-image-border',
		// 						'name'      => __( 'Border Image', LANG ),
		// 						'type'      => 'file',
		// 					));
		//---------------------------------------------->
		// 
		//----------------------------------------------<
		
	}

	/**
	 * Register settings notices for display
	 *
	 * @since  0.1.0
	 * @param  int   $object_id Option key
	 * @param  array $updated   Array of updated fields
	 * @return void
	 */
	public function settings_notices( $object_id, $updated ) {
		if ( $object_id !== $this->key || empty( $updated ) ) {
			return;
		}

		add_settings_error( $this->key . '-notices', '', __( 'Settings updated.', LANG ), 'updated' );
		settings_errors( $this->key . '-notices' );
	}

	/**
	 * Public getter method for retrieving protected/private variables
	 * @since  0.1.0
	 * @param  string  $field Field to retrieve
	 * @return mixed          Field value or exception is thrown
	 */
	public function __get( $field ) {
		// Allowed fields to retrieve
		if ( in_array( $field, array( 'key', 'metabox_id', 'title', 'options_page' ), true ) ) {
			return $this->{$field};
		}

		throw new Exception( 'Invalid property: ' . $field );
	}

}

/**
 * Helper function to get/return the EV_Admin object
 * @since  0.1.0
 * @return EV_Admin object
 */
function EV_admin() {
	return EV_Admin::get_instance();
}

/**
 * Wrapper function around cmb2_get_option
 * @since  0.1.0
 * @param  string  $key Options array key
 * @return mixed        Option value
 */
function EV_get_option( $key = '' ) {
	return cmb2_get_option( EV_admin()->key, $key );
}
// Get it started
EV_admin();

