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

<!-- PART 1 -->

<div class="Single-photo">

   <section class="Card-photo ">
    <div class="Card-description ">
        <h1><?php the_title(); ?></h1>
        <p>Référence : <?php  echo get_field('reference'); ?></p>
        <p>Catégorie : <?php
            $categories = get_the_term_list($post->ID, 'categorie');
            if (!is_wp_error($categories)) {
                echo strip_tags($categories);
            }
        ?></p>
        <p>Format : <?php
            $formats = get_the_term_list($post->ID, 'format');
            if (!is_wp_error($formats)) {
                echo strip_tags($formats);
            }
        ?></p>
        <p>Type : <?php echo get_field('type'); ?></p>
        <p>Année : <?php echo get_the_date('Y'); ?></p>
    </div>
    <img class="Card-image " src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); ?>">
</section>

<!-- PART 2-->

<section class="Photo-contact">
    <div class="interest-part">
        <p class="texte">Cette photo vous intéresse ?</p>
        <input class="btn-contact" type="button" value="Contact">
    </div>
    <div class="photo-thumbnail">
        <?php
        $prevPost = get_previous_post();
        $nextPost = get_next_post();

        // Vérifier s'il y a une image précédente ou suivante
        if (!empty($prevPost) || !empty($nextPost)) {
        ?>
        <div class="fleches">
            <?php if (!empty($prevPost)) {
                $prevThumbnail = get_the_post_thumbnail_url($prevPost->ID);
                $prevLink = get_permalink($prevPost); ?>
                <a href="<?php echo $prevLink; ?>">
                    <img class="fleche fleche-gauche" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/left-arrow.png" alt="Flèche pointant vers la gauche" />
                </a>
            <?php } else { ?>
                <img style="opacity:0; cursor: auto;" class="fleche " src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/left-arrow.png" />
            <?php }
            
            if (!empty($nextPost)) {
                $nextThumbnail = get_the_post_thumbnail_url($nextPost->ID);
                $nextLink = get_permalink($nextPost); ?>
                <a href="<?php echo $nextLink; ?>">
                    <img class="fleche fleche-droite" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/right-arrow.png" alt="Flèche pointant vers la droite" />
                </a>
            <?php } ?>
        </div>
        <div class="preview">
            <?php if (!empty($prevThumbnail)) : ?>
                <img class="previous-image" src="<?php echo $prevThumbnail; ?>" alt="Prévisualisation image précédente">
            <?php endif; ?>
        </div>
        <div class="preview">
            <?php if (!empty($nextThumbnail)) : ?>
                <img class="next-image" src="<?php echo $nextThumbnail; ?>" alt="Prévisualisation image suivante">
            <?php endif; ?>
        </div>
        <?php } ?>
    </div>
</section>

</div>

<!-- PART 3-->

<div class="photoblock">
  		<h3>VOUS AIMEREZ AUSSI</h3>
				<div  id="photosapp">
                <?php get_template_part( 'template-parts/photo_block', get_post_format() ); ?>
				</div>
				<a href="<?php echo home_url()?>"><button id="btn-acc">Toutes les photos </button></a>
	</div>

<?php

get_footer();
?>