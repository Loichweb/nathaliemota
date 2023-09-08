<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */


get_header();
?>

<?php if ( is_home() && ! is_front_page() && ! empty( single_post_title( '', false ) ) ) : ?>
	<header class="page-header alignwide">
		<h1 class="page-title"><?php single_post_title(); ?></h1>
	</header><!-- .page-header -->
<?php endif; ?>

<!-- BANNER -->
<div class="hero">
    <?php 
    $randomImage = get_random_custom_post_type_image();
    if ($randomImage) {
        echo '<img src="' . esc_url($randomImage) . '" alt="Image aléatoire">';
    } else {
        echo '<p>Aucune image trouvée.</p>';
    }
    ?>
	<h1 id="test">PHOTOGRAPHE EVENT </h1>

</div>

<!-- FILTRES AJAX -->
<div class="post-filters">
    <div>
        <label for="cat-select"></label>

     <select name="cat" id="cat-select">
            <option selected class="selectedoption" value="all">Catégories</option>
			<?php echo ajoutCategorie();?>
     </select>
    </div>
    <div class="adjust">
        <label for="form-select"></label>

        <select name="form" id="form-select">
		  <option selected class="selectedoption" value="all">Formats</option>
         <?php echo ajoutFormat();?>
        </select>
    </div>
    <div>
     <label for="tri-select"></label>

     <select name="tri" id="tri-select" placeholder='trier par'>
         <option selected class="selectedoption" value="">Trier par</option>
		<?php echo ajoutOrderDirection();?>
     </select>
    </div>
</div>



<!-- PHOTOBLOCK 3 -->
<div class="photoblock">
    <div id="photosapp">
        <?php get_template_part('template-parts/photo_block'); ?>
    </div>
	
</div>
<?php
get_footer();
