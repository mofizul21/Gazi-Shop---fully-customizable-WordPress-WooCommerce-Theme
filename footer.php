<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package gazishop
 */

?>

<!-- Footer -->
<footer class="bg-dark text-white py-5">
    <div class="container">
        <div class="row">
            <!-- About Us Section -->
            <div class="col-md-3 mb-4">
                <?php if (is_active_sidebar('footer-widget-1st-column')) : ?>
                    <div class="footer-widget-1st-column">
                        <?php dynamic_sidebar('footer-widget-1st-column'); ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Quick Links Section -->
            <div class="col-md-3 mb-4">
                <?php if (is_active_sidebar('footer-widget-2nd-column')) : ?>
                    <div class="footer-widget-2nd-column">
                        <?php dynamic_sidebar('footer-widget-2nd-column'); ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Category Links Section -->
            <div class="col-md-3 mb-4">
                <?php if (is_active_sidebar('footer-widget-3rd-column')) : ?>
                    <div class="footer-widget-3rd-column">
                        <?php dynamic_sidebar('footer-widget-3rd-column'); ?>
                    </div>
                <?php endif; ?>
                </ul>
            </div>

            <!-- Contact Info Section -->
            <div class="col-md-3 mb-4">
                <?php if (is_active_sidebar('footer-widget-4th-column')) : ?>
                    <div class="footer-widget-4th-column">
                        <?php dynamic_sidebar('footer-widget-4th-column'); ?>
                    </div>
                <?php endif; ?>
                </ul>
            </div>
        </div>

        <div class="row">
            <!-- Newsletter Signup -->
            <div class="col-md-6">
                <h5>Subscribe to Our Newsletter</h5>
                <form action="#" method="post" class="d-flex">
                    <input type="email" class="form-control me-2" placeholder="Your email" required>
                    <button class="btn btn-primary" type="submit">Subscribe</button>
                </form>
            </div>

            <!-- Social Media Icons -->
            <div class="col-md-6 text-md-end">
                <h5>Follow Us</h5>
                <a href="#" class="text-white me-3"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-white me-3"><i class="bi bi-twitter"></i></a>
                <a href="#" class="text-white me-3"><i class="bi bi-instagram"></i></a>
                <a href="#" class="text-white"><i class="bi bi-youtube"></i></a>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col text-center">
                <?php if (get_theme_mod('footer_text')) : ?>
                    <div class="mb-0">
                        <?php echo esc_html(get_theme_mod('footer_text')); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>