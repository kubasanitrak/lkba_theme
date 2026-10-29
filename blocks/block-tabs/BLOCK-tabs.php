<?php
/**
 * Block Name: BLOCK-tabs
 *
 * This is the template that displays tabs block.
 * @param   array $block The block settings and attributes.
 */
?>
<?php
    $CLS_W = 'nabidka-tabs ';

    $LABEL_1 = get_field("tab1_label");
    $LABEL_2 = get_field("tab2_label");
        
    // Create class attribute allowing for custom "className" values.
    $classes = ( ! empty( $block['className'] ) ) ? sprintf( $CLS_W . ' %s', $block['className'] ) : $CLS_W;

    // Support custom id values.
    $block_id = '';
    if ( ! empty( $block['anchor'] ) ) :
        $block_id = esc_attr( $block['anchor'] );
    endif;
?>

<div
    <?php
    echo wp_kses_data(
        get_block_wrapper_attributes(
            array(
                'id'    => $block_id,
                'class' => esc_attr( $classes ),
            )
        )
    );
    ?>
>

    <input type="radio" name="nabidka" class="nabidka-tabs--radio nabidka-tabs--radio_1" id="tab1_ID" checked="">
    <input type="radio" name="nabidka" class="nabidka-tabs--radio nabidka-tabs--radio_2" id="tab2_ID">
    <nav>
        <label for="tab1_ID" class="nabidka-tabs--switch nabidka-tabs--switch_1"><?php echo $LABEL_1; ?></label>
        <label for="tab2_ID" class="nabidka-tabs--switch nabidka-tabs--switch_2"><?php echo $LABEL_2; ?></label>
        <div class="slider"></div>
    </nav>
    
        <?php $allowed_blocks = [ 'acf/tabs-item' ]; ?>
        <InnerBlocks
            allowedBlocks="<?php echo esc_attr( wp_json_encode( $allowed_blocks ) ); ?>"
        />
</div><!-- END TABS CONTAINER -->