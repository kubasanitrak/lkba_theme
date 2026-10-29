<?php
/**
 * @package WordPress
 * @subpackage lkba_theme
 * @since 1.0
 */
?>

<?php
    
    $INSTRUCTOR_CERTIFICATE = get_field('certifikace_parent');
    $INSTRUCTOR_NAME = get_the_title();
    
?>

<div id="post-<?php the_ID(); ?>" class="instructor-list--item ">

    <div class="instructor-list--item_col instructor-list--item_col-img">
           <?php the_post_thumbnail('full', array('title' => $INSTRUCTOR_NAME, 'alt' => $INSTRUCTOR_NAME, 'class' => 'instructor-list--item_img')); ?>
    </div>
    <div class="instructor-list--item_col instructor-list--item_col-txt">
        <div class="instructor-list--item_header">
            <h2 class=""><?php echo $INSTRUCTOR_NAME; ?></h2>
        </div>
        <div class="instructor-list--item_caption">
            <?php the_content(); ?>
        </div>
    
    <?php
        if( have_rows('certifikace_parent') ):
        $TEMP_MARKUP = "";
    ?>

        <div class="instructor-list--item_footer">
            <h5 class="certification-headline"><?php echo _e('certifikace', 'lkba_theme'); ?></h5>
        <?php
            $TEMP_MARKUP .= '<dl class="h5">';
            // Loop through rows.
            while( have_rows('certifikace_parent') ) : 
                the_row();

                $CERTIFICATE_ITEM_LABEL = get_sub_field('certificate_label');
                $TEMP_MARKUP .= '<dt class="h5">';
                $CERTIFICATE_ITEM_OBJ = get_sub_field('certificate_img');
                if($CERTIFICATE_ITEM_OBJ) :
                    $imgID = $CERTIFICATE_ITEM_OBJ['ID'];
                endif;

                if($imgID) :
                $TEMP_MARKUP .= '<a class="certificate-popup-link popup-trigger prevent-default"';
                $TEMP_MARKUP .= 'href="';
                $TEMP_MARKUP .= wp_get_attachment_image_url($imgID, 'full', array('title' => $INSTRUCTOR_NAME, 'alt' => $INSTRUCTOR_NAME, 'class' => 'certificate-popup-img'));
                $TEMP_MARKUP .= '" >';
                endif;
                $TEMP_MARKUP .= $CERTIFICATE_ITEM_LABEL;
                if($imgID) :
                $TEMP_MARKUP .= '</a>';
                endif;
                $TEMP_MARKUP .= '</dt>';

            // End loop.
            endwhile;
            $TEMP_MARKUP .= '</dl>';
            print $TEMP_MARKUP;
        ?>
        </div> <!-- FOOTER -->
    <?php
        endif;
    ?>
    </div> <!-- END TXT -->
</div> <!-- END INSTRUCTOR-LIST--ITEM -->