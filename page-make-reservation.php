<?php
/**
 * Template Name: PAGE MAKE RESERVATION
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage lkba_theme
 * @since 1.0
 * * @version 1.0
 */

    get_header(); 

    $SHOW_TITLE = get_field('show_title');
      
    $IS_PADDED = get_field('is_padded');

    $TOP_MARGIN = get_field('has_top_margin');

	$CLS = $IS_PADDED ? 'padded-content' : '';

	$SECTION_CLS = "full-bleed section ";	

	if($TOP_MARGIN):
		$SECTION_CLS .= "section-mar-T ";
	endif;
?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		 <div class="<?php echo $SECTION_CLS; ?> ">
	<?php
	      if ( $SHOW_TITLE ) :
	?>
			<h1 class="page-title <?php echo $CLS; ?>"><?php echo the_title(); ?></h1>
	<?php
	      endif;
	?>
			<?php the_content(); ?>
		</div><!-- END SECTION -->
		
	<?php endwhile; endif; ?>


	<?php get_footer(); ?>

	<?php #include('template-parts/page-bookings-custom-scripts.php'); ?>
