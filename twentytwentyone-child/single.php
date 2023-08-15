<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();
?>

<div class="">
   <p>Bonjour loic </p>

   <section class="">
    <div class="">
        <h1><?php the_title(); ?></h1>
        <p>Référence : <?php echo get_field('reference'); ?></p>
        <p>Catégorie : <?php
            $categories = get_the_term_list($post->ID, 'categories');
            if (!is_wp_error($categories)) {
                echo strip_tags($categories);
            }
        ?></p>
        <p>Format : <?php
            $formats = get_the_term_list($post->ID, 'formats');
            if (!is_wp_error($formats)) {
                echo strip_tags($formats);
            }
        ?></p>
        <p>Type : <?php echo get_field('type'); ?></p>
        <p>Année : <?php echo get_the_date('Y'); ?></p>
    </div>
    <img class="" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); ?>">
</section>



<?php
get_footer();
?>