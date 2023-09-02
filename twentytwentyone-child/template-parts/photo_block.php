<?php
// Récupérer les termes de la catégorie de la photo courante
$terms = get_the_terms(get_the_ID(), 'categorie'); 

if ($terms && !is_wp_error($terms)) {
    $term_ids = wp_list_pluck($terms, 'term_id');

    // Requête pour obtenir les images associées aux mêmes termes de catégorie
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 2,
        'post__not_in' => array(get_the_ID()), 
        'tax_query' => array(
            array(
                'taxonomy' => 'categorie', 
                'field' => 'term_id',
                'terms' => $term_ids,
            ),
        ),
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) :
            $query->the_post();
            // Affichage des images
            ?>
            <div class="overlay-image">
                <?php if (has_post_thumbnail()) : ?>
                    <a href="<?php echo get_the_permalink(get_the_ID()); ?>">
                        <?php the_post_thumbnail('large', array('class' => 'thumbnail')); ?>
                    </a>
                <?php endif; ?>
                <div class="hover">
                    <img class="full_screen" data-image="<?php echo get_stylesheet_directory_uri(); ?>" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/fullscreen.png" alt="full_screen">
                    <a href="<?php echo get_the_permalink(get_the_ID()); ?>">
                        <img class="eye" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/eye.png" alt="eye">
                    </a>
                    <div class="texte">
                        <div><?php the_title(); ?></div>
                        <div class="categphoto"><?php echo strip_tags(get_the_term_list($post->ID, 'categorie')); ?></div>
                    </div>
                </div>
            </div>
            <?php
        endwhile;
    endif;

    wp_reset_query();
}
?>
