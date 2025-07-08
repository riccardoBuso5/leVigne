    </div><!-- #content -->

    <footer id="colophon" class="footer">
        <div class="container">
            <div class="footer_content">
                
                <!-- Footer Widget Area 1 -->
                <div class="footer_section">
                    <?php if (is_active_sidebar('footer-1')) : ?>
                        <?php dynamic_sidebar('footer-1'); ?>
                    <?php else : ?>
                        <h3>The Venue</h3>
                        <p>Un'esperienza culinaria indimenticabile nel cuore della tradizione italiana. Ogni piatto racconta una storia di passione e dedizione.</p>
                        
                        <div class="social_links">
                            <?php
                            $social_networks = array(
                                'facebook' => 'fa-facebook',
                                'instagram' => 'fa-instagram',
                                'twitter' => 'fa-twitter',
                                'youtube' => 'fa-youtube'
                            );
                            
                            foreach ($social_networks as $network => $icon) {
                                $url = get_theme_mod('social_' . $network);
                                if ($url) {
                                    echo '<a href="' . esc_url($url) . '" class="social_link" target="_blank" rel="noopener" aria-label="' . ucfirst($network) . '">';
                                    echo '<i class="fa ' . $icon . '" aria-hidden="true"></i>';
                                    echo '</a>';
                                }
                            }
                            ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Footer Widget Area 2 -->
                <div class="footer_section">
                    <?php if (is_active_sidebar('footer-2')) : ?>
                        <?php dynamic_sidebar('footer-2'); ?>
                    <?php else : ?>
                        <h3>Contatti</h3>
                        <ul>
                            <li>
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <?php echo get_theme_mod('restaurant_address', 'Via Roma 123, 20121 Milano, Italia'); ?>
                            </li>
                            <li>
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                <a href="tel:<?php echo str_replace(' ', '', get_theme_mod('restaurant_phone', '+390212345678')); ?>">
                                    <?php echo get_theme_mod('restaurant_phone', '+39 02 1234 5678'); ?>
                                </a>
                            </li>
                            <li>
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                <a href="mailto:<?php echo get_theme_mod('restaurant_email', 'info@thevenue.it'); ?>">
                                    <?php echo get_theme_mod('restaurant_email', 'info@thevenue.it'); ?>
                                </a>
                            </li>
                        </ul>
                    <?php endif; ?>
                </div>

                <!-- Footer Widget Area 3 -->
                <div class="footer_section">
                    <?php if (is_active_sidebar('footer-3')) : ?>
                        <?php dynamic_sidebar('footer-3'); ?>
                    <?php else : ?>
                        <h3>Orari di Apertura</h3>
                        <ul>
                            <li><strong>Lunedì - Venerdì:</strong> 12:00 - 15:00, 19:00 - 23:00</li>
                            <li><strong>Sabato:</strong> 19:00 - 24:00</li>
                            <li><strong>Domenica:</strong> 12:00 - 15:00, 19:00 - 22:30</li>
                        </ul>
                        
                        <h3>Link Utili</h3>
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'footer',
                            'container'      => false,
                            'fallback_cb'    => 'thevenue_footer_menu_fallback',
                            'depth'          => 1,
                        ));
                        ?>
                    <?php endif; ?>
                </div>

            </div>

            <div class="footer_bottom">
                <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Tutti i diritti riservati.</p>
                <p>Tema sviluppato con ❤️ per ristoranti di eccellenza.</p>
            </div>
        </div>
    </footer>

</div><!-- #page -->

<!-- Video Modal -->
<div id="video-modal" class="video-modal" style="display: none;">
    <div class="video-modal-content">
        <span class="video-modal-close">&times;</span>
        <iframe id="video-iframe" width="560" height="315" src="" frameborder="0" allowfullscreen></iframe>
    </div>
</div>

<!-- Reservation Success/Error Messages -->
<?php if (isset($_GET['reservation'])) : ?>
    <div id="reservation-message" class="reservation-message <?php echo esc_attr($_GET['reservation']); ?>">
        <div class="message-content">
            <?php if ($_GET['reservation'] === 'success') : ?>
                <i class="fa fa-check-circle"></i>
                <h3>Prenotazione Ricevuta!</h3>
                <p>Grazie per la tua prenotazione. Ti contatteremo presto per confermare.</p>
            <?php else : ?>
                <i class="fa fa-exclamation-triangle"></i>
                <h3>Errore nella Prenotazione</h3>
                <p>Si è verificato un errore. Ti preghiamo di riprovare o contattarci direttamente.</p>
            <?php endif; ?>
            <button class="message-close">&times;</button>
        </div>
    </div>
<?php endif; ?>

<?php wp_footer(); ?>

<script>
// Mobile menu toggle
document.addEventListener('DOMContentLoaded', function() {
    const mobileToggle = document.getElementById('mobile-menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    
    if (mobileToggle && mobileMenu) {
        mobileToggle.addEventListener('click', function() {
            this.classList.toggle('active');
            mobileMenu.classList.toggle('active');
        });
    }
    
    // Close mobile menu when clicking on a link
    const mobileLinks = mobileMenu.querySelectorAll('a');
    mobileLinks.forEach(link => {
        link.addEventListener('click', function() {
            mobileToggle.classList.remove('active');
            mobileMenu.classList.remove('active');
        });
    });
    
    // Smooth scrolling for anchor links
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Header scroll effect
    const header = document.querySelector('.header');
    window.addEventListener('scroll', function() {
        if (window.scrollY > 100) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });
    
    // Animate on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, observerOptions);
    
    const animatedElements = document.querySelectorAll('.animate-on-scroll');
    animatedElements.forEach(el => observer.observe(el));
    
    // Menu tabs functionality
    const menuTabs = document.querySelectorAll('.menu_tab');
    const menuContent = document.getElementById('menu-content');
    
    if (menuTabs.length > 0 && menuContent) {
        // Load initial menu category
        loadMenuItems('antipasti');
        
        menuTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                // Remove active class from all tabs
                menuTabs.forEach(t => t.classList.remove('active'));
                // Add active class to clicked tab
                this.classList.add('active');
                
                // Load menu items for selected category
                const category = this.getAttribute('data-tab');
                loadMenuItems(category);
            });
        });
    }
    
    // Video modal
    window.openVideoModal = function() {
        const modal = document.getElementById('video-modal');
        const iframe = document.getElementById('video-iframe');
        iframe.src = 'https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1'; // Replace with actual video
        modal.style.display = 'flex';
    };
    
    const videoModal = document.getElementById('video-modal');
    const videoClose = document.querySelector('.video-modal-close');
    
    if (videoClose) {
        videoClose.addEventListener('click', function() {
            videoModal.style.display = 'none';
            document.getElementById('video-iframe').src = '';
        });
    }
    
    // Close modal when clicking outside
    videoModal.addEventListener('click', function(e) {
        if (e.target === this) {
            this.style.display = 'none';
            document.getElementById('video-iframe').src = '';
        }
    });
    
    // Close reservation message
    const messageClose = document.querySelector('.message-close');
    if (messageClose) {
        messageClose.addEventListener('click', function() {
            document.getElementById('reservation-message').style.display = 'none';
        });
    }
});

// Load menu items via AJAX
function loadMenuItems(category) {
    const menuContent = document.getElementById('menu-content');
    
    // Show loading state
    menuContent.innerHTML = '<div class="loading">Caricamento...</div>';
    
    // AJAX request
    const formData = new FormData();
    formData.append('action', 'get_menu_items');
    formData.append('category', category);
    formData.append('nonce', thevenue_ajax.nonce);
    
    fetch(thevenue_ajax.ajax_url, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            menuContent.innerHTML = data.data;
            
            // Re-observe new elements for scroll animations
            const newAnimatedElements = menuContent.querySelectorAll('.animate-on-scroll');
            newAnimatedElements.forEach(el => {
                if (typeof observer !== 'undefined') {
                    observer.observe(el);
                }
            });
        } else {
            menuContent.innerHTML = '<div class="error">Errore nel caricamento del menu.</div>';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        menuContent.innerHTML = '<div class="error">Errore nel caricamento del menu.</div>';
    });
}
</script>

</body>
</html>

<?php
/**
 * Footer menu fallback
 */
function thevenue_footer_menu_fallback() {
    echo '<ul>';
    echo '<li><a href="#home">Home</a></li>';
    echo '<li><a href="#about">Chi Siamo</a></li>';
    echo '<li><a href="#menu">Menu</a></li>';
    echo '<li><a href="#reservations">Prenotazioni</a></li>';
    echo '</ul>';
}
?>
