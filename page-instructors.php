<?php
/**
 * Template Name: PAGE LEKTORKY
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
?>
	<!-- BODY OVERLAY -->
	<div class="body-blackout" id="body-blackout_ID"></div>

	<!-- MODAL POPUP -->
	<div class="popup-modal popup-modal--certificate" id="popupmodal_ID">
		<button class="btn popup-close-btn fas fa-2x fa-times text-white bg-primary p-3 popup-modal__close">close</button>
		<div class="popup-modal-content" id="popup_content_ID"></div>
	</div>


	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<div class="section section-instructor-header full-bleed">
			<?php the_content(); ?>
		</div><!-- END SECTION CONTENT -->
		
	<?php endwhile; endif; ?>

      <?php
	      $news_query = new WP_Query( array(
	          'post_type' => 'instructor',
	          'post_status' => 'publish',
	          'posts_per_page' => -1,
	          'orderby' => 'menu_order',
	          // 'orderby'=>'title',
	          // 'order' => 'ASC',
	          'order' => 'DESC',
	      )); 
	?>
      <div class="section section-instructor-list full-bleed">
		<?php while ( $news_query->have_posts() ) : $news_query->the_post(); ?>

			<?php include('template-parts/content-instructor-item.php'); ?>

		<?php endwhile; ?>
      </div> <!-- END INSTRUCTOR-LIST -->

<script>

(function () {
		/* POP UP MODAL */
		const popupContent = document.getElementById("popup_content_ID");
		const modalTriggers = document.querySelectorAll('.popup-trigger');
		const modalCloseTrigger = document.querySelector('.popup-modal__close');
		const bodyBlackout = document.getElementById("body-blackout_ID");

		function addClickListeners() {
			if(modalTriggers) {
				console.log("click");
				for (var i = 0; i < modalTriggers.length; ++i) {
					modalTriggers[i].addEventListener("click", function (event) {
						let _image = new Image();
						_image.src = this.href;
						popupContent.appendChild( _image );
						clickPopUpModalBTN(event.target);
					});
				}
			}
		}

        addClickListeners();

        function clickPopUpModalBTN (elem) {

          const popupModal = document.getElementById('popupmodal_ID');

          popupModal.classList.add('is--visible')
          bodyBlackout.classList.add('is-blacked-out')

          popupModal.querySelector('.popup-modal__close').addEventListener('click', function() {
            popupModal.classList.remove('is--visible')
            bodyBlackout.classList.remove('is-blacked-out')
            popupContent.replaceChildren();
          })

          bodyBlackout.addEventListener('click', function () {
            const popupModal = document.getElementById('popupmodal_ID');
            popupModal.classList.remove('is--visible');
            bodyBlackout.classList.remove('is-blacked-out');
            popupContent.replaceChildren();
          })
        }
})();

</script>

	<?php get_footer(); ?>