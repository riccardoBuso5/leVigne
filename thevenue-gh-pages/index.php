<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 *
 * @package The_Venue
 * @since 1.0.0
 */

get_header(); ?>

<main id="primary" class="site-main">

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero_content">
            <h1 class="hero_title"><?php echo get_theme_mod('hero_title', 'The Venue'); ?></h1>
            <p class="hero_subtitle"><?php echo get_theme_mod('hero_subtitle', 'Fine Dining Experience'); ?></p>
            <p class="hero_description">
                <?php echo get_theme_mod('hero_description', 'Benvenuti nel nostro ristorante dove tradizione e innovazione si incontrano per creare un\'esperienza culinaria indimenticabile.'); ?>
            </p>
            <a href="#menu" class="btn btn-outline btn-lg">Scopri il Menu</a>
        </div>
    </section>

    <!-- Introduction Section -->
    <section class="intro" id="about">
        <div class="container">
            <div class="intro_container">
                <div class="intro_content fade-in-left">
                    <h2 class="intro_title"><?php echo get_theme_mod('intro_title', 'La Nostra Storia'); ?></h2>
                    <div class="intro_text">
                        <?php echo get_theme_mod('intro_text', 
                            '<p>Da oltre tre generazioni, la famiglia Rossi porta avanti la tradizione culinaria italiana con passione e dedizione. Il nostro ristorante è nato dal sogno di condividere i sapori autentici della nostra terra.</p>
                            <p>Ogni piatto racconta una storia, ogni ingrediente è selezionato con cura per offrire un\'esperienza gastronomica che unisce tradizione e modernità.</p>'
                        ); ?>
                    </div>
                    <a href="#reservations" class="btn btn-primary">Prenota un Tavolo</a>
                </div>
                <div class="intro_image fade-in-right">
                    <?php 
                    $intro_image = get_theme_mod('intro_image', get_template_directory_uri() . '/images/about_intro.jpg');
                    ?>
                    <img src="<?php echo esc_url($intro_image); ?>" alt="La nostra storia">
                </div>
            </div>
        </div>
    </section>

    <!-- Video Section -->
    <section class="video_section" id="video">
        <div class="video_play_button" onclick="openVideoModal()">
            <i class="fa fa-play" aria-hidden="true"></i>
        </div>
    </section>

    <!-- Signature Dishes Section -->
    <section class="signature_dishes" id="signature">
        <div class="container">
            <div class="section_title">
                <h2><?php echo get_theme_mod('signature_title', 'I Nostri Piatti Signature'); ?></h2>
                <p><?php echo get_theme_mod('signature_description', 'Scopri le nostre creazioni più amate, preparate con ingredienti freschi e tecniche raffinate.'); ?></p>
            </div>
            
            <div class="dishes_grid">
                <?php
                // Get signature dishes from customizer or use defaults
                $signature_dishes = get_theme_mod('signature_dishes', array(
                    array(
                        'name' => 'Risotto ai Porcini',
                        'description' => 'Risotto cremoso con porcini freschi, parmigiano reggiano e tartufo nero.',
                        'price' => '€28',
                        'image' => get_template_directory_uri() . '/images/sig_1.jpg'
                    ),
                    array(
                        'name' => 'Branzino in Crosta',
                        'description' => 'Branzino fresco cotto in crosta di sale alle erbe mediterranee.',
                        'price' => '€32',
                        'image' => get_template_directory_uri() . '/images/sig_2.jpg'
                    ),
                    array(
                        'name' => 'Tiramisù della Casa',
                        'description' => 'Il nostro tiramisù preparato secondo la ricetta tradizionale della nonna.',
                        'price' => '€12',
                        'image' => get_template_directory_uri() . '/images/sig_3.jpg'
                    )
                ));

                foreach ($signature_dishes as $dish) : ?>
                    <div class="dish_card animate-on-scroll">
                        <div class="dish_image" style="background-image: url('<?php echo esc_url($dish['image']); ?>');"></div>
                        <div class="dish_content">
                            <h3 class="dish_name"><?php echo esc_html($dish['name']); ?></h3>
                            <p class="dish_description"><?php echo esc_html($dish['description']); ?></p>
                            <span class="dish_price"><?php echo esc_html($dish['price']); ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Menu Section -->
    <section class="menu_section" id="menu">
        <div class="container">
            <div class="section_title">
                <h2><?php echo get_theme_mod('menu_title', 'Il Nostro Menu'); ?></h2>
                <p><?php echo get_theme_mod('menu_description', 'Una selezione di piatti che celebrano la tradizione culinaria italiana con un tocco contemporaneo.'); ?></p>
            </div>

            <div class="menu_tabs">
                <button class="menu_tab active" data-tab="antipasti">Antipasti</button>
                <button class="menu_tab" data-tab="primi">Primi Piatti</button>
                <button class="menu_tab" data-tab="secondi">Secondi Piatti</button>
                <button class="menu_tab" data-tab="dessert">Dessert</button>
            </div>

            <div class="menu_content" id="menu-content">
                <!-- Menu items will be loaded here via JavaScript -->
            </div>
        </div>
    </section>

    <!-- Reservations Section -->
    <section class="reservations" id="reservations">
        <div class="container">
            <div class="reservations_content">
                <h2 class="reservations_title"><?php echo get_theme_mod('reservations_title', 'Prenota il Tuo Tavolo'); ?></h2>
                <p class="reservations_text">
                    <?php echo get_theme_mod('reservations_text', 'Contattaci per prenotare il tuo tavolo e vivere un\'esperienza culinaria indimenticabile nel cuore della tradizione italiana.'); ?>
                </p>

                <form class="reservation_form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
                    <input type="hidden" name="action" value="handle_reservation">
                    <?php wp_nonce_field('reservation_nonce', 'reservation_nonce_field'); ?>
                    
                    <div class="form_group">
                        <input type="text" name="name" class="form_input" placeholder="Nome completo" required>
                    </div>
                    <div class="form_group">
                        <input type="email" name="email" class="form_input" placeholder="Email" required>
                    </div>
                    <div class="form_group">
                        <input type="tel" name="phone" class="form_input" placeholder="Telefono" required>
                    </div>
                    <div class="form_group">
                        <input type="date" name="date" class="form_input" required>
                    </div>
                    <div class="form_group">
                        <select name="time" class="form_select" required>
                            <option value="">Seleziona orario</option>
                            <option value="19:00">19:00</option>
                            <option value="19:30">19:30</option>
                            <option value="20:00">20:00</option>
                            <option value="20:30">20:30</option>
                            <option value="21:00">21:00</option>
                            <option value="21:30">21:30</option>
                        </select>
                    </div>
                    <div class="form_group">
                        <select name="guests" class="form_select" required>
                            <option value="">Numero ospiti</option>
                            <option value="1">1 persona</option>
                            <option value="2">2 persone</option>
                            <option value="3">3 persone</option>
                            <option value="4">4 persone</option>
                            <option value="5">5 persone</option>
                            <option value="6+">6+ persone</option>
                        </select>
                    </div>
                </form>

                <button type="submit" form="reservation_form" class="btn btn-outline btn-lg">Prenota Ora</button>

                <div class="reservations_contact">
                    <p>Oppure chiamaci direttamente:</p>
                    <p><strong><?php echo get_theme_mod('restaurant_phone', '+39 02 1234 5678'); ?></strong></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Section (if posts exist) -->
    <?php if (have_posts()) : ?>
        <section class="blog_section" id="blog">
            <div class="container">
                <div class="section_title">
                    <h2>Le Nostre Novità</h2>
                    <p>Rimani aggiornato su eventi speciali, nuovi piatti e tutto quello che succede nel nostro ristorante.</p>
                </div>

                <div class="blog_grid">
                    <?php
                    $blog_query = new WP_Query(array(
                        'posts_per_page' => 3,
                        'post_status' => 'publish'
                    ));

                    while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                        <article class="blog_card animate-on-scroll">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="blog_image">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('medium'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <div class="blog_content">
                                <h3 class="blog_title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                <p class="blog_excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                                <div class="blog_meta">
                                    <span class="blog_date"><?php echo get_the_date(); ?></span>
                                    <a href="<?php the_permalink(); ?>" class="blog_link">Leggi di più</a>
                                </div>
                            </div>
                        </article>
                    <?php endwhile;
                    wp_reset_postdata(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

</main>

<?php get_footer(); ?>
