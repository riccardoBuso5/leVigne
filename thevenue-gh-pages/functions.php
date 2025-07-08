<?php
/**
 * The Venue functions and definitions
 *
 * @package The_Venue
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme setup
 */
function thevenue_setup() {
    // Add theme support for post thumbnails
    add_theme_support('post-thumbnails');
    
    // Add theme support for title tag
    add_theme_support('title-tag');
    
    // Add theme support for automatic feed links
    add_theme_support('automatic-feed-links');
    
    // Add theme support for HTML5 markup
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption'
    ));
    
    // Add theme support for custom logo
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    
    // Add theme support for custom background
    add_theme_support('custom-background', array(
        'default-color' => 'ffffff',
    ));
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'thevenue'),
        'footer'  => __('Footer Menu', 'thevenue'),
    ));
    
    // Set content width
    if (!isset($content_width)) {
        $content_width = 1200;
    }
}
add_action('after_setup_theme', 'thevenue_setup');

/**
 * Enqueue scripts and styles
 */
function thevenue_scripts() {
    // Main theme stylesheet
    wp_enqueue_style('thevenue-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // Font Awesome
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/plugins/font-awesome-4.7.0/css/font-awesome.min.css', array(), '4.7.0');
    
    // Bootstrap CSS
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/bootstrap-4.1.2/bootstrap.min.css', array(), '4.1.2');
    
    // Owl Carousel CSS
    wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/plugins/OwlCarousel2-2.2.1/owl.carousel.css', array(), '2.2.1');
    wp_enqueue_style('owl-theme', get_template_directory_uri() . '/plugins/OwlCarousel2-2.2.1/owl.theme.default.css', array(), '2.2.1');
    
    // Colorbox CSS
    wp_enqueue_style('colorbox', get_template_directory_uri() . '/plugins/colorbox/colorbox.css', array(), '1.0.0');
    
    // jQuery (WordPress includes this by default)
    wp_enqueue_script('jquery');
    
    // Bootstrap JS
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/bootstrap-4.1.2/bootstrap.min.js', array('jquery'), '4.1.2', true);
    
    // Popper.js for Bootstrap
    wp_enqueue_script('popper', get_template_directory_uri() . '/bootstrap-4.1.2/popper.js', array('jquery'), '1.14.3', true);
    
    // GSAP Animation Library
    wp_enqueue_script('gsap', get_template_directory_uri() . '/plugins/greensock/TweenMax.min.js', array(), '2.0.0', true);
    wp_enqueue_script('gsap-scrollto', get_template_directory_uri() . '/plugins/greensock/ScrollToPlugin.min.js', array('gsap'), '2.0.0', true);
    
    // Owl Carousel JS
    wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/plugins/OwlCarousel2-2.2.1/owl.carousel.js', array('jquery'), '2.2.1', true);
    
    // Parallax JS
    wp_enqueue_script('parallax', get_template_directory_uri() . '/plugins/parallax-js-master/parallax.min.js', array('jquery'), '1.0.0', true);
    
    // Easing JS
    wp_enqueue_script('easing', get_template_directory_uri() . '/plugins/easing/easing.js', array('jquery'), '1.0.0', true);
    
    // Colorbox JS
    wp_enqueue_script('colorbox', get_template_directory_uri() . '/plugins/colorbox/jquery.colorbox-min.js', array('jquery'), '1.0.0', true);
    
    // Custom theme JS
    wp_enqueue_script('thevenue-custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), '1.0.0', true);
    
    // Localize script for AJAX
    wp_localize_script('thevenue-custom', 'thevenue_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('thevenue_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'thevenue_scripts');

/**
 * Register widget areas
 */
function thevenue_widgets_init() {
    register_sidebar(array(
        'name'          => __('Footer Area 1', 'thevenue'),
        'id'            => 'footer-1',
        'description'   => __('Add widgets here to appear in your footer.', 'thevenue'),
        'before_widget' => '<div class="footer_section">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer Area 2', 'thevenue'),
        'id'            => 'footer-2',
        'description'   => __('Add widgets here to appear in your footer.', 'thevenue'),
        'before_widget' => '<div class="footer_section">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer Area 3', 'thevenue'),
        'id'            => 'footer-3',
        'description'   => __('Add widgets here to appear in your footer.', 'thevenue'),
        'before_widget' => '<div class="footer_section">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'thevenue_widgets_init');

/**
 * Customize API
 */
function thevenue_customize_register($wp_customize) {
    // Hero Section
    $wp_customize->add_section('hero_section', array(
        'title'    => __('Hero Section', 'thevenue'),
        'priority' => 30,
    ));
    
    $wp_customize->add_setting('hero_title', array(
        'default'           => 'The Venue',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('hero_title', array(
        'label'   => __('Hero Title', 'thevenue'),
        'section' => 'hero_section',
        'type'    => 'text',
    ));
    
    $wp_customize->add_setting('hero_subtitle', array(
        'default'           => 'Fine Dining Experience',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('hero_subtitle', array(
        'label'   => __('Hero Subtitle', 'thevenue'),
        'section' => 'hero_section',
        'type'    => 'text',
    ));
    
    $wp_customize->add_setting('hero_description', array(
        'default'           => 'Benvenuti nel nostro ristorante dove tradizione e innovazione si incontrano per creare un\'esperienza culinaria indimenticabile.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    
    $wp_customize->add_control('hero_description', array(
        'label'   => __('Hero Description', 'thevenue'),
        'section' => 'hero_section',
        'type'    => 'textarea',
    ));
    
    // Contact Information
    $wp_customize->add_section('contact_info', array(
        'title'    => __('Contact Information', 'thevenue'),
        'priority' => 40,
    ));
    
    $wp_customize->add_setting('restaurant_phone', array(
        'default'           => '+39 02 1234 5678',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('restaurant_phone', array(
        'label'   => __('Restaurant Phone', 'thevenue'),
        'section' => 'contact_info',
        'type'    => 'text',
    ));
    
    $wp_customize->add_setting('restaurant_email', array(
        'default'           => 'info@thevenue.it',
        'sanitize_callback' => 'sanitize_email',
    ));
    
    $wp_customize->add_control('restaurant_email', array(
        'label'   => __('Restaurant Email', 'thevenue'),
        'section' => 'contact_info',
        'type'    => 'email',
    ));
    
    $wp_customize->add_setting('restaurant_address', array(
        'default'           => 'Via Roma 123, 20121 Milano, Italia',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    
    $wp_customize->add_control('restaurant_address', array(
        'label'   => __('Restaurant Address', 'thevenue'),
        'section' => 'contact_info',
        'type'    => 'textarea',
    ));
    
    // Social Media
    $wp_customize->add_section('social_media', array(
        'title'    => __('Social Media', 'thevenue'),
        'priority' => 50,
    ));
    
    $social_networks = array(
        'facebook' => 'Facebook',
        'instagram' => 'Instagram',
        'twitter' => 'Twitter',
        'youtube' => 'YouTube'
    );
    
    foreach ($social_networks as $network => $label) {
        $wp_customize->add_setting('social_' . $network, array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        
        $wp_customize->add_control('social_' . $network, array(
            'label'   => $label . ' URL',
            'section' => 'social_media',
            'type'    => 'url',
        ));
    }
}
add_action('customize_register', 'thevenue_customize_register');

/**
 * Handle reservation form submission
 */
function handle_reservation_submission() {
    if (!isset($_POST['reservation_nonce_field']) || !wp_verify_nonce($_POST['reservation_nonce_field'], 'reservation_nonce')) {
        wp_die('Security check failed');
    }
    
    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $phone = sanitize_text_field($_POST['phone']);
    $date = sanitize_text_field($_POST['date']);
    $time = sanitize_text_field($_POST['time']);
    $guests = sanitize_text_field($_POST['guests']);
    
    // Send email to restaurant
    $to = get_theme_mod('restaurant_email', get_option('admin_email'));
    $subject = 'Nuova Prenotazione - ' . get_bloginfo('name');
    $message = sprintf(
        "Nuova prenotazione ricevuta:\n\n" .
        "Nome: %s\n" .
        "Email: %s\n" .
        "Telefono: %s\n" .
        "Data: %s\n" .
        "Ora: %s\n" .
        "Ospiti: %s\n",
        $name, $email, $phone, $date, $time, $guests
    );
    
    $headers = array('Content-Type: text/plain; charset=UTF-8');
    
    if (wp_mail($to, $subject, $message, $headers)) {
        wp_redirect(home_url('/?reservation=success'));
    } else {
        wp_redirect(home_url('/?reservation=error'));
    }
    exit;
}
add_action('admin_post_handle_reservation', 'handle_reservation_submission');
add_action('admin_post_nopriv_handle_reservation', 'handle_reservation_submission');

/**
 * AJAX handler for menu items
 */
function get_menu_items() {
    check_ajax_referer('thevenue_nonce', 'nonce');
    
    $category = sanitize_text_field($_POST['category']);
    
    // Define menu items (in a real implementation, these would come from a database or custom fields)
    $menu_items = array(
        'antipasti' => array(
            array(
                'name' => 'Antipasto della Casa',
                'description' => 'Selezione di salumi e formaggi locali con mostarda di fichi',
                'price' => '€18',
                'image' => get_template_directory_uri() . '/images/menu_1.jpg'
            ),
            array(
                'name' => 'Bruschette al Pomodoro',
                'description' => 'Pane tostato con pomodori freschi, basilico e olio EVO',
                'price' => '€12',
                'image' => get_template_directory_uri() . '/images/menu_2.jpg'
            ),
        ),
        'primi' => array(
            array(
                'name' => 'Spaghetti alla Carbonara',
                'description' => 'Pasta fresca con guanciale, pecorino e uova',
                'price' => '€16',
                'image' => get_template_directory_uri() . '/images/menu_3.jpg'
            ),
            array(
                'name' => 'Risotto ai Funghi Porcini',
                'description' => 'Risotto cremoso con porcini freschi e parmigiano',
                'price' => '€22',
                'image' => get_template_directory_uri() . '/images/menu_4.jpg'
            ),
        ),
        'secondi' => array(
            array(
                'name' => 'Bistecca alla Fiorentina',
                'description' => 'Bistecca di manzo chianina cotta alla griglia',
                'price' => '€45',
                'image' => get_template_directory_uri() . '/images/menu_5.jpg'
            ),
            array(
                'name' => 'Branzino in Crosta di Sale',
                'description' => 'Branzino fresco cotto in crosta di sale alle erbe',
                'price' => '€28',
                'image' => get_template_directory_uri() . '/images/menu_6.jpg'
            ),
        ),
        'dessert' => array(
            array(
                'name' => 'Tiramisù della Casa',
                'description' => 'Il nostro tiramisù preparato secondo la ricetta tradizionale',
                'price' => '€8',
                'image' => get_template_directory_uri() . '/images/dessert_1.jpg'
            ),
            array(
                'name' => 'Panna Cotta ai Frutti di Bosco',
                'description' => 'Panna cotta con coulis di frutti di bosco freschi',
                'price' => '€7',
                'image' => get_template_directory_uri() . '/images/dessert_2.jpg'
            ),
        ),
    );
    
    $items = isset($menu_items[$category]) ? $menu_items[$category] : array();
    
    ob_start();
    foreach ($items as $item) :
    ?>
        <div class="menu_item animate-on-scroll">
            <div class="menu_item_image" style="background-image: url('<?php echo esc_url($item['image']); ?>');"></div>
            <div class="menu_item_content">
                <div class="menu_item_header">
                    <h4 class="menu_item_name"><?php echo esc_html($item['name']); ?></h4>
                    <span class="menu_item_price"><?php echo esc_html($item['price']); ?></span>
                </div>
                <p class="menu_item_description"><?php echo esc_html($item['description']); ?></p>
            </div>
        </div>
    <?php
    endforeach;
    $output = ob_get_clean();
    
    wp_send_json_success($output);
}
add_action('wp_ajax_get_menu_items', 'get_menu_items');
add_action('wp_ajax_nopriv_get_menu_items', 'get_menu_items');

/**
 * Add custom post type for Menu Items (optional)
 */
function thevenue_custom_post_types() {
    register_post_type('menu_item', array(
        'labels' => array(
            'name' => 'Menu Items',
            'singular_name' => 'Menu Item',
        ),
        'public' => true,
        'has_archive' => false,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-food',
    ));
}
add_action('init', 'thevenue_custom_post_types');

/**
 * Remove WordPress version from head
 */
remove_action('wp_head', 'wp_generator');

/**
 * Clean up WordPress head
 */
function thevenue_clean_head() {
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
}
add_action('init', 'thevenue_clean_head');

/**
 * Image sizes
 */
function thevenue_image_sizes() {
    add_image_size('dish-thumbnail', 400, 300, true);
    add_image_size('hero-image', 1920, 1080, true);
    add_image_size('blog-thumbnail', 600, 400, true);
}
add_action('after_setup_theme', 'thevenue_image_sizes');
