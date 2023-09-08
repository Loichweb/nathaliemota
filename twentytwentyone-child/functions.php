<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );
         
if ( !function_exists( 'child_theme_configurator_css' ) ):
    function child_theme_configurator_css() {
        wp_enqueue_style( 'chld_thm_cfg_child', trailingslashit( get_stylesheet_directory_uri() ) . 'style.css', array( 'twenty-twenty-one-style','twenty-twenty-one-style','twenty-twenty-one-print-style' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'child_theme_configurator_css', 10 );

// Charger le fichier script.js
function child_theme_enqueue_scripts() {
    wp_enqueue_script( 'child-theme-script', get_stylesheet_directory_uri() . '/js/script.js', array('jquery'), '1.0', true );
    wp_enqueue_script( 'child-theme-index', get_stylesheet_directory_uri() . '/js/index.js', array('jquery'), '1.0', true );
    wp_localize_script('child-theme-index', 'ajaxurl', admin_url('admin-ajax.php'));
    wp_enqueue_script('lightbox',get_stylesheet_directory_uri() . '/js/lightbox.js', array(),'1.0', true);
}

add_action( 'wp_enqueue_scripts', 'child_theme_enqueue_scripts' );

 // Récupérez une image aléatoire 
function get_random_custom_post_type_image() {
    $args = array(
        'post_type' => 'photo', 
        'posts_per_page' => -1, 
        'terms' => 'paysage',
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        $random_post = $query->posts[array_rand($query->posts)];
        $randomImage = get_the_post_thumbnail_url($random_post->ID, 'large'); 
        return $randomImage;
    }

    return false;
}


// END ENQUEUE PARENT ACTION

// add menu header and footer :
function register_my_menus() {
    register_nav_menus(
    array(
    'header-menu' => __( 'Menu Header' ),
    'footer-menu' => __( 'Menu Footer' ),
    )
    );
}
add_action( 'init', 'register_my_menus' );


// PAGINATION INFINIE

function load_more_photos() {
    $page = $_POST['page'];
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 12, // Affichez 12 photos à chaque chargement
        'paged' => $page // Utilisez la page actuelle pour récupérer les images suivantes

    );

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) :
            $query->the_post();
            // Affichez le code HTML pour chaque image, similaire à la boucle initiale
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

    die(); // Important : terminez la requête AJAX
}

add_action('wp_ajax_load_more_photos', 'load_more_photos'); // Pour les utilisateurs connectés
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos'); // Pour les utilisateurs non connectés




/** FILTRES AJAX */

?>
<?php
function filtre() {
    $filtrajax = new WP_Query([
        'post_type' => 'photo',
        'orderby' => 'date',
        'order' => $_POST['post_ordre'],
        'paged' => $_POST['paged'],
        'posts_per_page' => 12,
        'tax_query' => array(
            $_POST['category'] != "all" ?
                array(
                    'taxonomy' => 'categorie',
                    'field' => 'slug',
                    'terms' => $_POST['category'],
                )
                : '',
            $_POST['post_format'] != "all" ?
                array(
                    'taxonomy' => 'format',
                    'field' => 'slug',
                    'terms' => $_POST['post_format'],
                )
                : '',
        ),
    ]);

    if ($filtrajax->have_posts()) :
        while ($filtrajax->have_posts()) :
            $filtrajax->the_post();
            // Récupérer l'URL de la miniature
            $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
            ?>
            <div class="overlay-image">
                <?php if (has_post_thumbnail()) : ?>
                    <a href="<?php echo esc_url($thumbnail_url); ?>">
                        <?php the_post_thumbnail('large', array('class' => 'thumbnail')); ?>
                    </a>
                <?php endif; ?>

                <div class="hover">
                    <a href="#" class="full_screen" data-image="<?php echo esc_url($thumbnail_url); ?>">
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

    wp_reset_postdata();
    exit();
}

add_action('wp_ajax_filtre', 'filtre');
add_action('wp_ajax_nopriv_filtre', 'filtre');

?>

<?php
function ajoutCategorie(){
if($terms = get_terms(array(
  'taxonomy' =>'categorie' ,
  'field'    => 'slug',
 'terms'    => $_POST['category'],
)))
foreach ($terms as $term){
  echo '<option  value="'.$term->slug.'">'.$term ->name.'</option>';
}
}

function ajoutFormat(){
  if($terms = get_terms(array(
    'taxonomy' =>'format' ,
    'field'    => 'slug',
   'terms'    => $_POST['post_format'],
  )))
  foreach ($terms as $term){
    echo '<option  value="'.$term->slug.'">'.$term ->name.'</option>';
  }
  }

function ajoutOrderDirection(){
  if ($order_options = (array(
      'DESC' => 'Nouveautés',
      'ASC' => 'Les plus anciens',
    )))
    foreach( $order_options as $value => $label ) {
        echo "<option ".selected( $_POST['tri'], $value )." value='$value'>$label</option>";
    }
  }
?>