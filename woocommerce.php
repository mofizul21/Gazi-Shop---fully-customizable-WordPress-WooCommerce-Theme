<?php

/**
 * The template for displaying WooCommerce content
 *
 * This is the template that displays WooCommerce content by default.
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

<main class="container pt-4">

    <?php woocommerce_content(); ?>

</main><!-- #main -->

<?php
get_footer();
