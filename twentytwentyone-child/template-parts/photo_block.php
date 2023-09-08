<?php
if (is_single()) {
    // Code spécifique à single.php
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
                // Récupérer l'URL de la miniature
        $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
         // Récupérer le titre de l'image
        $thumbnail_title = get_the_title(get_the_ID());


                // Affichage des images
        ?>
        <div class="overlay-image">
            <?php if (has_post_thumbnail()) : ?>
                <a href="<?php echo esc_url($thumbnail_url); ?>" data-image="<?php echo esc_url($thumbnail_url); ?>" data-post-title="<?php echo esc_attr($thumbnail_title); ?>">
                    <?php the_post_thumbnail('large', array('class' => 'thumbnail')); ?>
                </a>
            <?php endif; ?>
            <div class="hover">
                <a href="#" class="full_screen" data-image="<?php echo esc_url($thumbnail_url); ?>" data-post-title="<?php echo esc_attr($thumbnail_title); ?>">
                    <img class="full_screen_icon" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/fullscreen.png" alt="full_screen">
                </a>
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
} elseif (is_home() || is_front_page()) {
    $args = array(
        'post_type' => 'photo', 
        'posts_per_page' => 12, 
    );
    
    $query = new WP_Query($args);
    
    if ($query->have_posts()) :
        while ($query->have_posts()) :
            $query->the_post();
            // Affichage des images
            $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
            $thumbnail_title = get_the_title(get_the_ID());
            ?>
            <div class="overlay-image" data-image="<?php echo esc_url($thumbnail_url); ?>" data-post-title="<?php echo esc_attr($thumbnail_title); ?>">
                <?php if (has_post_thumbnail()) : ?>
                    <a href="<?php echo get_the_permalink(get_the_ID()); ?>">
                        <?php the_post_thumbnail('large', array('class' => 'thumbnail')); ?>
                    </a>
                <?php endif; ?>
            
                <div class="hover">
                    <a href="#" class="full_screen" data-image="<?php echo esc_url($thumbnail_url); ?>" data-post-title="<?php echo esc_attr($thumbnail_title); ?>">
                        <img class="full_screen_icon" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/fullscreen.png" alt="full_screen">
                    </a>
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

    wp_reset_query(); // Réinitialiser la requête WP_Query
    
    // Ce code affiche les images et le bouton "Charger plus" initial
    ?>
    <div id="load-more-container"?>
    </div>
    <button id="load-more-photos" data-ajaxurl="<?php echo admin_url('admin-ajax.php'); ?>" data-page="2">Charger plus</button>

    <?php
}
 else {
    // Code générique pour toutes les autres pages
    // ...
}
?>

