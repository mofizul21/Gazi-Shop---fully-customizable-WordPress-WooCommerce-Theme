<?php

/**
 * gazishop functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package gazishop
 */

if (! defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.0.0');
}

/**
 * Function to check required plugins
 *
 */
function gazi_shop_theme_check_required_plugins() {
    if (! class_exists('WooCommerce') || ! class_exists('AWS_Main')) {
        add_action('admin_notices', 'gazi_shop_theme_required_plugins_notice');
        return false;
    }
    return true;
}

function gazi_shop_theme_required_plugins_notice() {
?>
    <div class="notice notice-error">
        <p><?php _e('The theme requires WooCommerce and Advanced Woo Search plugins to be activated. Please install and activate these plugins for full functionality.', 'mytheme'); ?></p>
    </div>
<?php
}
add_action('after_switch_theme', 'gazi_shop_theme_check_required_plugins');

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function gazishop_setup() {
    /*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on gazishop, use a find and replace
		* to change 'gazishop' to the name of your theme in all the template files.
		*/
    load_theme_textdomain('gazishop', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
    add_theme_support('title-tag');

    /*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
    add_theme_support('post-thumbnails');

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(
        array(
            'menu-1' => esc_html__('Primary', 'gazishop'),
        )
    );

    /*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    // Set up the WordPress core custom background feature.
    add_theme_support(
        'custom-background',
        apply_filters(
            'gazishop_custom_background_args',
            array(
                'default-color' => 'ffffff',
                'default-image' => '',
            )
        )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support(
        'custom-logo',
        array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        )
    );
}
add_action('after_setup_theme', 'gazishop_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function gazishop_content_width() {
    $GLOBALS['content_width'] = apply_filters('gazishop_content_width', 640);
}
add_action('after_setup_theme', 'gazishop_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function gazishop_widgets_init() {
    register_sidebar(
        array(
            'name'          => esc_html__('Sidebar', 'gazishop'),
            'id'            => 'sidebar-1',
            'description'   => esc_html__('Add widgets here.', 'gazishop'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action('widgets_init', 'gazishop_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function gazishop_scripts() {
    wp_enqueue_style('gazishop-style', get_stylesheet_uri(), array(), _S_VERSION);
    wp_enqueue_style('gazishop-bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), _S_VERSION);
    wp_enqueue_style('gazishop-custom-style', get_template_directory_uri() . '/css/custom-style.css', array(), _S_VERSION);
    wp_enqueue_style('bootstrap-icons', '//cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css');
    wp_style_add_data('gazishop-style', 'rtl', 'replace');


    wp_enqueue_script('gazishop-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);
    wp_enqueue_script('bootstrap-popper', get_template_directory_uri() . '/js/popper.min.js', array('jquery'));
    wp_enqueue_script('bootstrap-min', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'));
    wp_enqueue_script('gazishop-custom', get_template_directory_uri() . '/js/custom.js', array('jquery'));

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'gazishop_scripts');

/**
 * Custom Fonts
 * font-family: "Nunito", sans-serif;
 * font-family: "Source Sans 3", sans-serif;
 */
function enqueu_custom_fonts() {
    if (!is_admin()) {
        wp_register_style('source_sans_pro', 'https://fonts.googleapis.com/css2?family=Source+Sans+3:ital,wght@0,200..900;1,200..900&display=swap');
        wp_register_style('nunito', 'https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap');
        wp_enqueue_style('source_sans_pro');
        wp_enqueue_style('nunito');
    }
}
add_action('wp_enqueue_scripts', 'enqueu_custom_fonts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Show cart contents / total Ajax
 */
add_filter('woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

function woocommerce_header_add_to_cart_fragment($fragments) {
    global $woocommerce;

    ob_start();

?>
    <a class="cart-customlocation" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count); ?> – <?php echo $woocommerce->cart->get_cart_total(); ?></a>
<?php
    $fragments['a.cart-customlocation'] = ob_get_clean();
    return $fragments;
}

/**
 * WooCommerrce Content page
 */
add_theme_support('woocommerce');

/**
 * Footer Widget 1st Column
 */
function footer_widget_1st_column() {
    register_sidebar(array(
        'name'          => __('Footer Widget 1st Column', 'textdomain'),
        'id'            => 'footer-widget-1st-column',
        'description'   => __('Widgets in this area will be shown in the footer column 1.', 'textdomain'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h5 class="widget-title">',
        'after_title'   => '</h5>',
    ));
}
add_action('widgets_init', 'footer_widget_1st_column');

/**
 * Footer Widget 2nd Column
 */
function footer_widget_2nd_column() {
    register_sidebar(array(
        'name'          => __('Footer Widget 2nd Column', 'textdomain'),
        'id'            => 'footer-widget-2nd-column',
        'description'   => __('Widgets in this area will be shown in the footer column 2.', 'textdomain'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h5 class="widget-title">',
        'after_title'   => '</h5>',
    ));
}
add_action('widgets_init', 'footer_widget_2nd_column');

/**
 * Footer Widget 3rd Column
 */
function footer_widget_3rd_column() {
    register_sidebar(array(
        'name'          => __('Footer Widget 3rd Column', 'textdomain'),
        'id'            => 'footer-widget-3rd-column',
        'description'   => __('Widgets in this area will be shown in the footer column 3.', 'textdomain'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h5 class="widget-title">',
        'after_title'   => '</h5>',
    ));
}
add_action('widgets_init', 'footer_widget_3rd_column');

/**
 * Footer Widget 4th Column
 */
function footer_widget_4th_column() {
    register_sidebar(array(
        'name'          => __('Footer Widget 4th Column', 'textdomain'),
        'id'            => 'footer-widget-4th-column',
        'description'   => __('Widgets in this area will be shown in the footer column 4.', 'textdomain'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h5 class="widget-title">',
        'after_title'   => '</h5>',
    ));
}
add_action('widgets_init', 'footer_widget_4th_column');

/**
 * Add Theme Customizer Settings and Controls
 */
function gazi_shop_theme_customizer_settings($wp_customize) {
    // Header Top Setting
    $wp_customize->add_setting('phone_number', array(
        'default'           => '+88 01789 123456',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('phone_number', array(
        'label'    => __('Phone Number', 'textdomain'),
        'section'  => 'header_top_info_section',
        'type'     => 'text',
        'priority' => 10,
    ));

    $wp_customize->add_setting('email_address', array(
        'default'           => 'contact@gazishop.com',
        'sanitize_callback' => 'sanitize_email',
    ));

    $wp_customize->add_control('email_address', array(
        'label'    => __('Email Address', 'textdomain'),
        'section'  => 'header_top_info_section',
        'type'     => 'email',
        'priority' => 20,
    ));

    // Define default images URLs
    $default_image_1 = get_template_directory_uri() . '/images/banner-1.jpg';
    $default_image_2 = get_template_directory_uri() . '/images/banner-2.jpg';

    // Add settings for up to 2 images
    for ($i = 1; $i <= 2; $i++) {
        $default = ($i === 1) ? $default_image_1 : (($i === 2) ? $default_image_2 : '');

        $wp_customize->add_setting("carousel_image_$i", array(
            'default'           => $default,
            'sanitize_callback' => 'esc_url_raw',
        ));

        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "carousel_image_$i", array(
            'label'    => __("Carousel Image $i", 'textdomain'),
            'section'  => 'carousel_section',
            'settings' => "carousel_image_$i",
            'priority' => $i,
        )));
    }

    // Homepage Banner Setting
    $wp_customize->add_setting('banner_image', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'banner_image', array(
        'label'    => __('Banner Image', 'mytheme'),
        'section'  => 'banner_section',
        'settings' => 'banner_image',
    )));

    // Banner Subheading Setting
    $wp_customize->add_setting('banner_subheading', array(
        'default' => 'New season trends!',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('banner_subheading', array(
        'label'    => __('Subheading', 'mytheme'),
        'section'  => 'banner_section',
        'type'     => 'text',
    ));

    // Banner Heading Setting
    $wp_customize->add_setting('banner_heading', array(
        'default' => 'Best Summer Collection',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('banner_heading', array(
        'label'    => __('Heading', 'mytheme'),
        'section'  => 'banner_section',
        'type'     => 'text',
    ));

    // Banner Text Setting
    $wp_customize->add_setting('banner_text', array(
        'default' => 'Sale Get up to 50% Off',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('banner_text', array(
        'label'    => __('Text', 'mytheme'),
        'section'  => 'banner_section',
        'type'     => 'text',
    ));

    // Banner Button Text Setting
    $wp_customize->add_setting('banner_button_text', array(
        'default' => 'Shop Now',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('banner_button_text', array(
        'label'    => __('Button Text', 'mytheme'),
        'section'  => 'banner_section',
        'type'     => 'text',
    ));

    // Banner Button URL Setting
    $wp_customize->add_setting('banner_button_url', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('banner_button_url', array(
        'label'    => __('Button URL', 'mytheme'),
        'section'  => 'banner_section',
        'type'     => 'url',
    ));

    // Footer Text Setting
    $wp_customize->add_setting('footer_text', array(
        'default'           => '© 2024 Gazi Shop. All rights reserved.',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('footer_text', array(
        'label'    => __('Footer Text', 'textdomain'),
        'section'  => 'footer_section',
        'type'     => 'text',
        'priority' => 10,
    ));
}
add_action('customize_register', 'gazi_shop_theme_customizer_settings');

/**
 * Add Theme Customizer Sections
 */
function gazi_shop_theme_customizer_sections($wp_customize) {
    // Header Top Section
    $wp_customize->add_section('header_top_info_section', array(
        'title'    => __('Header Top Section', 'textdomain'),
        'priority' => 155,
    ));

    // Add Carousel Section
    $wp_customize->add_section('carousel_section', array(
        'title'    => __('Carousel Settings', 'textdomain'),
        'priority' => 156,
    ));

    $wp_customize->add_section('banner_section', array(
        'title'       => __('Homepage Banner Settings', 'mytheme'),
        'description' => __('Customize the single banner.', 'mytheme'),
        'priority'    => 157,
    ));

    // Footer Copyright Text
    $wp_customize->add_section('footer_section', array(
        'title'    => __('Footer Copyright Text', 'textdomain'),
        'priority' => 158,
    ));
}

add_action('customize_register', 'gazi_shop_theme_customizer_sections');
