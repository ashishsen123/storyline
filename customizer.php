<?php
/**
 * storyline Theme Customizer
 *
 * @package ThemeGrill
 * @subpackage storyline
 * @since storyline 1.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function storyline_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'storyline_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function storyline_customize_preview_js() {
	wp_enqueue_script( 'storyline_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'storyline_customize_preview_js' );

/*****************************************************************************************/

function storyline_register_theme_customizer( $wp_customize ) {
class storyline_customize_textarea_control extends WP_Customize_Control {

        public $type = 'textarea';

        public function render_content() {
            ?>

            <label>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                <textarea rows="5" style="width:98%;" <?php $this->link(); ?>><?php echo esc_textarea($this->value()); ?></textarea>
            </label>

            <?php
        }

    }
	// remove control
	$wp_customize->remove_control('blogdescription');
	 
	// rename existing section
	$wp_customize->add_section( 'title_tagline' , array(
		'title' => __('Site Title', 'storyline' ),
		'priority' => 20
	) );

	class storyline_ADDITIONAL_Control extends WP_Customize_Control {
		public $type = 'textarea';

		public function render_content() {
			?>
			<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
			</label>
			<?php
		}
	}

	$wp_customize->add_setting(
		'storyline_color_scheme',
			array(
				'default'     	=> '#632E9B',
				'sanitize_callback' => 'storyline_sanitize_hex_color',
				'sanitize_js_callback' => 'storyline_sanitize_escaping'	
			)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'color_scheme',
			array(
				'label'      	=> __( 'Primary Color', 'storyline' ),
				'section'    	=> 'colors',
				'settings'   	=> 'storyline_color_scheme'
			)
		)
	);
/*custom-css*/
	$wp_customize->add_section(
		'storyline_custom_css_section',
		array(
			'title'     => __( 'Custom CSS', 'storyline' ),
			'priority'  => 200
		)
	);

	$wp_customize->add_setting(
		'storyline_custom_css',
		array(
		'default'    =>  '',
		'sanitize_callback' => 'storyline_sanitize_custom_css',
		'sanitize_js_callback' => 'storyline_sanitize_escaping'
		)
	);

	$wp_customize->add_control(
		new storyline_ADDITIONAL_Control (
			$wp_customize,
			'storyline_custom_css',			
			array(				
				'label'    	=> __( 'Add your custom css here and design live! (for advanced users)' , 'storyline' ),
				'section'   => 'storyline_custom_css_section',
				'settings'  => 'storyline_custom_css'
			)
		)
	);
/*end custom-css*/
	$wp_customize->add_section(
		'storyline_featured_section',
		array(
			'title'     => __( 'Front Page Featured Section', 'storyline' ),
			'priority'  => 220
		)
	);

	$wp_customize->add_setting(
		'page-setting-one',
		array(
			'sanitize_callback' => 'storyline_sanitize_integer'
		)
	);
	$wp_customize->add_setting(
		'page-setting-two',
		array(
			'sanitize_callback' => 'storyline_sanitize_integer'
		)
	);
	$wp_customize->add_setting(
		'page-setting-three',
		array(
			'sanitize_callback' => 'storyline_sanitize_integer'
		)
	);

	$wp_customize->add_control(
		'page-setting-one',
			array(
			'type' => 'dropdown-pages',
			'label' => __( 'First featured page', 'storyline' ),
			'section' => 'storyline_featured_section',
		)
	);
	$wp_customize->add_control(
		'page-setting-two',
			array(
			'type' => 'dropdown-pages',
			'label' => __( 'Second featured page', 'storyline' ),
			'section' => 'storyline_featured_section',
		)
	);
	$wp_customize->add_control(
		'page-setting-three',
			array(
			'type' => 'dropdown-pages',
			'label' => __( 'Third featured page', 'storyline' ),
			'section' => 'storyline_featured_section',
		)
	);
        
    /*color-scheme*/    
        $wp_customize->add_section( 'storyline_color_scheme_settings', array(
		'title'       => __( 'Color Scheme', 'storyline' ),
		'priority'    => 30,
		'description' => 'Select your color scheme',
	) );

	$wp_customize->add_setting( 'storyline_color_scheme', array(
		'default'        => 'red',
	) );

	$wp_customize->add_control( 'storyline_color_scheme', array(
		'label'   => 'Choose your color scheme',
		'section' => 'storyline_color_scheme_settings',
		'default'        => 'red',
		'type'       => 'radio',
		'choices'    => array(
			__( 'blue', 'locale' ) => 'blue',
			__( 'mustard', 'locale' ) => 'mustard',
			__( 'Green', 'locale' ) => 'green',
			__( 'purple', 'locale' ) => 'purple',
			__( 'teal', 'locale' ) => 'teal',
			__( 'red', 'locale' ) => 'red',
		),
	) );
/*end color-scheme*/

/*custom layout*/
$wp_customize->add_setting('sidebar_position', array());
$wp_customize->add_control('sidebar_position', array(
	'label'      => __('Sidebar position', 'Ari'),
	'section'    => 'layout',
	'settings'   => 'sidebar_position',
	'type'       => 'radio',
	'choices'    => array(
		'full-width'   => 'full-width',
		'box'  => 'box',
		
	),
));
$wp_customize->add_section('layout' , array(
    'title' => __('Layout','Ari'),
));

/*end custom layout*/
// Add footer text section
    $wp_customize->add_section('storyline_footer', array(
        'title' => 'Footer Text', // The title of section
        'priority' => 70,
    ));

    $wp_customize->add_setting('storyline_footer_footer_text', array(
        'default' => '',
    ));
    $wp_customize->add_control(new storyline_customize_textarea_control($wp_customize, 'storyline_footer_footer_text', array(
        'section' => 'storyline_footer', // id of section to which the setting belongs
        'settings' => 'storyline_footer_footer_text',
    )));


 // Add new section for displaying Featured Posts on Front Page
    $wp_customize->add_section('storyline_front_page_post_options', array(
        'title' => __('Front Page Featured Posts', 'storyline'),
        'description' => __('Settings for displaying featured posts on Front Page', 'storyline'),
        'priority' => 60,
    ));
    // enable featured posts on front page?
    $wp_customize->add_setting('storyline_front_featured_posts_check', array('default' => 0));
    $wp_customize->add_control('storyline_front_featured_posts_check', array(
        'label' => __('Show featured posts on Front Page', 'storyline'),
        'section' => 'storyline_front_page_post_options',
        'priority' => 10,
        'type' => 'checkbox',
    ));

    // Front featured posts section headline
    $wp_customize->add_setting('storyline_front_featured_posts_title', array('default' => __('Latest Posts', 'storyline')));
    $wp_customize->add_control('storyline_front_featured_posts_title', array(
        'label' => __('Featured Section Title', 'storyline'),
        'section' => 'storyline_front_page_post_options',
        'settings' => 'storyline_front_featured_posts_title',
        'priority' => 10,
    ));

    // select number of posts for featured posts on front page
    $wp_customize->add_setting('storyline_front_featured_posts_count', array('default' => 3));
    $wp_customize->add_control('storyline_front_featured_posts_count', array(
        'label' => __('Number of posts to display', 'storyline'),
        'section' => 'storyline_front_page_post_options',
        'settings' => 'storyline_front_featured_posts_count',
        'priority' => 20,
    ));


    // featured post read more link
    $wp_customize->add_setting('storyline_front_featured_link_text', array('default' => __('Read more', 'storyline')));
    $wp_customize->add_control('storyline_front_featured_link_text', array(
        'label' => __('Posts Read More Link Text', 'storyline'),
        'section' => 'storyline_front_page_post_options',
        'settings' => 'storyline_front_featured_link_text',
        'priority' => 30,
    ));

    
// Add new section for displaying Featured Posts on Front Page
    $wp_customize->add_section('storyline_front_page_post_options', array(
        'title' => __('Front Page Featured Posts', 'storyline'),
        'description' => __('Settings for displaying featured posts on Front Page', 'storyline'),
        'priority' => 60,
    ));
    


	function storyline_sanitize_hex_color( $color ) {
		if ( $unhashed = sanitize_hex_color_no_hash( $color ) )
			return '#' . $unhashed;

		return $color;
	}

	function storyline_sanitize_custom_css( $input) {
		$input = wp_kses_stripslashes( $input);
		return $input;
	}	

	function storyline_sanitize_integer( $input ) {
    	if( is_numeric( $input ) ) {
        return intval( $input );
   	}
	}

	function storyline_sanitize_escaping( $input) {
		$input = esc_attr( $input);
		return $input;
	}

}
add_action( 'customize_register', 'storyline_register_theme_customizer' );


function storyline_customizer_css() {
	$primary_color =  get_theme_mod( 'storyline_color_scheme' );
	if( $primary_color && $primary_color != '#632e9b') {
		$customizer_css = '
			blockquote { border-color: #EAEAEA #EAEAEA #EAEAEA '.$primary_color.'; }
			a { color: '.$primary_color.'; }
			.site-title a:hover { color: '.$primary_color.'; }
			.main-navigation a:hover, .main-navigation ul li.current-menu-item a, .main-navigation ul li.current_page_ancestor a, .main-navigation ul li.current-menu-ancestor a, .main-navigation ul li.current_page_item a, .main-navigation ul li:hover > a { background-color: '.$primary_color.'; }
			.main-navigation ul li ul li a:hover, .main-navigation ul li ul li:hover > a, .main-navigation ul li.current-menu-item ul li a:hover { background-color: '.$primary_color.'; }
			#masthead .search-form { background-color: '.$primary_color.'; }
			.header-search-icon:before { color: '.$primary_color.'; }
			button, input[type="button"], input[type="reset"], input[type="submit"] { 	background-color: '.$primary_color.'; }
			#content .entry-title a:hover { color: '.$primary_color.'; }
			.entry-meta span:hover { color: '.$primary_color.'; }
			#content .entry-meta span a:hover { color: '.$primary_color.'; }
			#content .comments-area article header cite a:hover, #content .comments-area a.comment-edit-link:hover, #content .comments-area a.comment-permalink:hover { color: '.$primary_color.'; }
			.comments-area .comment-author-link a:hover { color: '.$primary_color.'; }
			.comment .comment-reply-link:hover { color: '.$primary_color.'; }
			.site-header .menu-toggle { background: '.$primary_color.'; }
			.site-header .menu-toggle:hover { background: '.$primary_color.'; }
			.main-small-navigation li:hover { background: '.$primary_color.'; }
			.main-small-navigation ul > .current_page_item, .main-small-navigation ul > .current-menu-item { background: '.$primary_color.'; }
			.main-small-navigation ul li ul li a:hover, .main-small-navigation ul li ul li:hover > a, .main-small-navigation ul li.current-menu-item ul li a:hover { background-color: '.$primary_color.'; }
			#featured_pages a.more-link:hover { border-color:'.$primary_color.'; color:'.$primary_color.'; }
			a#back-top:before { background-color:'.$primary_color.'; }';
	?>
	<style type="text/css"><?php echo $customizer_css; ?></style>
	<?php
	}
	?>
	<style type="text/css"><?php echo trim( get_theme_mod( 'storyline_custom_css' ) ); ?></style>
	<?php
}
add_action( 'wp_head', 'storyline_customizer_css' );
?>








