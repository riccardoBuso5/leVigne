<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <header id="masthead" class="header">
        <div class="container">
            <div class="header_container">
                
                <!-- Logo -->
                <div class="logo">
                    <?php
                    if (has_custom_logo()) {
                        the_custom_logo();
                    } else {
                        echo '<a href="' . esc_url(home_url('/')) . '" rel="home">' . get_bloginfo('name') . '</a>';
                    }
                    ?>
                </div>

                <!-- Navigation Menu -->
                <nav class="main_nav" id="site-navigation">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'container'      => false,
                        'fallback_cb'    => 'thevenue_default_menu',
                    ));
                    ?>
                </nav>

                <!-- Reservation Phone -->
                <div class="reservations_phone">
                    <i class="fa fa-phone" aria-hidden="true"></i>
                    <span><?php echo get_theme_mod('restaurant_phone', '+39 02 1234 5678'); ?></span>
                </div>

                <!-- Mobile Menu Toggle -->
                <button class="hamburger" id="mobile-menu-toggle" aria-label="Toggle mobile menu">
                    <div class="hamburger_line"></div>
                    <div class="hamburger_line"></div>
                    <div class="hamburger_line"></div>
                </button>

            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="mobile_menu" id="mobile-menu">
            <div class="mobile_menu_content">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'mobile-menu-list',
                    'container'      => false,
                    'fallback_cb'    => 'thevenue_default_menu',
                ));
                ?>
                
                <div class="mobile_contact">
                    <p><i class="fa fa-phone"></i> <?php echo get_theme_mod('restaurant_phone', '+39 02 1234 5678'); ?></p>
                    <p><i class="fa fa-envelope"></i> <?php echo get_theme_mod('restaurant_email', 'info@thevenue.it'); ?></p>
                </div>
                
                <div class="mobile_social">
                    <?php
                    $social_networks = array('facebook', 'instagram', 'twitter', 'youtube');
                    foreach ($social_networks as $network) {
                        $url = get_theme_mod('social_' . $network);
                        if ($url) {
                            echo '<a href="' . esc_url($url) . '" target="_blank" rel="noopener"><i class="fa fa-' . $network . '"></i></a>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </header>

    <div id="content" class="site-content">

<?php
/**
 * Default menu fallback
 */
function thevenue_default_menu() {
    echo '<ul id="primary-menu">';
    echo '<li><a href="#home">Home</a></li>';
    echo '<li><a href="#about">Chi Siamo</a></li>';
    echo '<li><a href="#menu">Menu</a></li>';
    echo '<li><a href="#reservations">Prenotazioni</a></li>';
    echo '<li><a href="#contact">Contatti</a></li>';
    echo '</ul>';
}
?>
