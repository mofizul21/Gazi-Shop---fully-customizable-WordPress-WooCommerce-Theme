<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package gazishop
 */

get_header();
?>

<main id="primary" class="site-main">
    <section class="container py-4">
        <div id="carouselExampleCaptions" class="carousel slide">
            <div class="carousel-indicators">
                <?php
                $total_images = 2; // Total number of images
                for ($i = 1; $i <= $total_images; $i++) {
                    $active = $i === 1 ? 'active' : ''; // Make the first slide active
                    echo '<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="' . ($i - 1) . '" class="' . $active . '" aria-current="' . ($i === 1 ? 'true' : 'false') . '" aria-label="Slide ' . $i . '"></button>';
                }
                ?>
            </div>
            <div class="carousel-inner">
                <?php
                for ($i = 1; $i <= $total_images; $i++) {
                    $image_url = get_theme_mod("carousel_image_$i", '');
                    if ($image_url) {
                        $active = $i === 1 ? 'active' : ''; // Make the first slide active
                        echo '<div class="carousel-item ' . $active . '">';
                        echo '<img src="' . esc_url($image_url) . '" class="d-block w-100" alt="...">';
                        echo '</div>';
                    }
                }
                ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

    </section>

    <!-- POPULAR PRODUCTS -->
    <section class="container py-4">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center">Popular Products</h2>
                <p class="text-center">We offer 12% OFF from our popular products</p>
            </div>
        </div>

        <div class="row pt-4">
            <?php echo do_shortcode('[products limit="4" columns="4" orderby="popularity" order="DESC"]'); ?>
        </div>

    </section>

    <!-- SINGLE BANNER -->
    <div class="section bg-dark-subtle my-3">
        <div class="container">
            <div class="row align-items-center flex-row-reverse">
                <div class="col-md-6 offset-md-1">
                    <div class="medium_divider d-none d-md-block clearfix"></div>
                    <div class="trand_banner_text text-center text-md-start">
                        <div class="heading_s1 mb-3">
                            <span class="sub_heading"><?php echo get_theme_mod('banner_subheading', 'New season trends!'); ?></span>
                            <h2><?php echo get_theme_mod('banner_heading', 'Best Summer Collection'); ?></h2>
                        </div>
                        <h5 class="mb-4"><?php echo get_theme_mod('banner_text', 'Sale Get up to 50% Off'); ?></h5>
                        <a href="<?php echo esc_url(get_theme_mod('banner_button_url', '#')); ?>" class="btn btn-warning rounded-0">
                            <?php echo esc_html(get_theme_mod('banner_button_text', 'Shop Now')); ?>
                        </a>
                    </div>
                    <div class="medium_divider clearfix"></div>
                </div>
                <div class="col-md-5">
                    <div class="text-center trading_img">
                        <img src="<?php echo esc_url(get_theme_mod('banner_image', get_template_directory_uri() . '/images/tranding_img.png')); ?>" alt="tranding_img">
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- SALE PRODUCTS -->
    <section class="container py-4">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center">SALE Products</h2>
                <p class="text-center">We offer 12% OFF from our popular products</p>
            </div>
        </div>

        <div class="row pt-4">
            <?php echo do_shortcode('[sale_products limit="4" columns="4" orderby="popularity" order="DESC"]'); ?>
        </div>

    </section>

</main><!-- #main -->

<?php

get_footer();
