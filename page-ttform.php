<?php
/**
 * Template Name: PAGE TT FORM
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
	$CLS = $IS_PADDED ? 'padded-content' : '';

	// $WORKSHOP_NAME = 'Teacher Training';
	$WORKSHOP_PARAM = null;

	// ?workshop=TT
	// ?workshop=Ch

	if(isset($_GET['workshop'])) {
		$WORKSHOP_PARAM = strtolower($_GET['workshop']);
	}

	switch ($WORKSHOP_PARAM) {
		case 'tt':
			// code...
			$WORKSHOP_NAME = 'Teacher Training';
			break;
		case 'ch':
			// code...
			$WORKSHOP_NAME = 'Inspo Choreography';
			break;
		
		default:
			// code...
			$WORKSHOP_NAME = 'Teacher Training';
			break;
	}
?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

     <div class="section section-mar-T full-bleed">
		
	<?php
	      if ( $SHOW_TITLE ) :
	?>
			<h1 class="page-title <?php echo $CLS; ?>"><?php echo the_title(); ?> <?php echo $WORKSHOP_NAME; ?></h1>
	<?php
	      endif;
	?>
			<?php 

$LABEL_DATE = "Termín";
$LABEL_NAME = "Celé jméno";
$LABEL_EMAIL = "Emailová adresa";
$LABEL_PHONE = "Telefonní číslo (Whatsapp)";
$LABEL_FOI = "Aktuálně se věnuji (tanec, yoga, pilates, atp.)";

			?>

			<!-- <h1 class="page-title padded-content">Přihláška na Teacher Training</h1> -->
            <div class="flow">
                <div class="wp-block-group padded-content">
                    <div class="wp-block-group__inner-container is-layout-constrained wp-block-group-is-layout-constrained">
                        <p class="plain ">Děkujeme za váš zájem o&nbsp;workshop. Přihlaste&nbsp;se prostřednictvím následujícího formuláře a&nbsp;přidejte se k&nbsp;nám na den plný pohybu a&nbsp;inspirace! Po&nbsp;vyplnění přihlášky se vám do 5ti dnů&nbsp;ozvu. <br>Těším se, na setkání na workshopu právě s&nbsp;vámi.</p>
                        <p class="plain ">Lenka Krejčová</p>
                    </div>
                </div>
            <!-- </div> -->
            <!-- <div class="flow"> -->
				<div class="wp-block-group padded-content signup-form--wrapper mar-T pad-B">
	            <!-- MESSAGE ON FORM SUBMIT ERROR OR SUCCESS -->
		            <div class="signup-form--submit_message hidden" id="submit_messageID">
		            	<!-- <h2 class="">Hotovo, odesláno, děkujeme!</h2> -->
		            	<!-- <p class="">Podrobné info o dalším postupu najdete v mailu.</p> -->
		            	<h2 class="">Hotovo, odesláno, děkujeme!<br>Potvrzení a další info najdete v&nbsp;mailu.</h2>
		            </div>
		            <!-- SIGNUP FORM HIDDEN BY DEFAULT -->
		            <div class="signup-form-container " id="">
		            	<form action="" id="signup-formID" class="signup-form">
				            <div class="signup-form--inner" id="">
								<div class="signup-form--inner_row mar-B-0">
									<label ><?php echo $LABEL_DATE; ?> <span style="color: red;">*</span></label>
								</div>
								<div class="signup-form--inner_row flex-row workshop-terms full-W">
									<div class="workshop-terms--item">
										<label class="nice-input radio-input workshop-terms--item_label">
											<!-- <input type="radio" name="LKBAparams[event]" value="p_08_04" checked> -->
											<input type="radio" name="LKBAparams[event]" value="p_08_04" >
											<span class="checkmark"></span>
											<div class="workshop-terms--item_caption" >
												<h2 class="workshop-terms--item_date">8. 4. 2025</h2>
												<p class="workshop-terms--item_hour">9:00 — 17:00 hod.</p>
												<p class="workshop-terms--item_place">Praha</p>
											</div>
										</label>
									</div>
									<div class="workshop-terms--item">
										<!-- <label class="nice-input radio-input workshop-terms--item_label"><?php #echo $EVENT_DATE; ?> -->
										<label class="nice-input radio-input workshop-terms--item_label">
											<input type="radio" name="LKBAparams[event]" value="b_24_04" >
											<span class="checkmark"></span>
											<div class="workshop-terms--item_caption" >
												<h2 class="workshop-terms--item_date">24. 4. 2025</h2>
												<p class="workshop-terms--item_hour">9:00 — 17:00 hod.</p>
												<p class="workshop-terms--item_place">Bratislava</p>
											</div>
										</label>
									</div>
								</div>
								<div class="signup-form--inner_row flex-col">
									<label for="name"><?php echo $LABEL_NAME; ?> <span style="color: red;">*</span></label>
									<input type="text" name="LKBAparams[name]" class="required email" id="name" placeholder="Jméno Příjmení" required>
								</div>
								<div class="signup-form--inner_row flex-col">
									<label for="name"><?php echo $LABEL_EMAIL; ?> <span style="color: red;">*</span></label>
									<input type="email" name="LKBAparams[email]" class="required email" id="name" placeholder="email@email.cz" required>
								</div>
								<div class="signup-form--inner_row flex-col">
									<label for="name"><?php echo $LABEL_PHONE; ?> <span style="color: red;">*</span></label>
									<input type="phone" name="LKBAparams[phone]" class="required email" id="name" placeholder="+420…" required>
								</div>
								<div class="signup-form--inner_row flex-col">
									<label for="name"><?php echo $LABEL_FOI; ?> <span style="color: red;">*</span></label>
									<input type="text" name="LKBAparams[foi]" class="required email" id="name" placeholder="" required>
								</div>
								<div class="signup-form--inner_row flex-col">
									<button type="submit" name="submit" class="btn submit-btn form-submit btn-major" disabled >Odeslat</button>
								</div>
				            </div>
			            </form>
		            </div>
	            </div>
            </div>

		</div><!-- END SECTION -->
		
	<?php endwhile; endif; ?>


	<?php get_footer(); ?>