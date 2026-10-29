<?php
/**
 * Block Name: BLOCK-tabs-item
 *
 * This is the template that displays tabs content block.
 * @param   array $block The block settings and attributes.
 */
?>
<?php
    $CLS_W = 'nabidka-tabs--content ';

    $TAB_COUNT = get_field("tab_item_counter");
        
    // Create class attribute allowing for custom "className" values.

    if($TAB_COUNT) :
        $CLS_W .= ' ';
        $CLS_W .= 'nabidka-tabs--content_';
        $CLS_W .= strval($TAB_COUNT);
    endif;
        // $CLS_W .= $TAB_COUNT ? 'nabidka-tabs--content_X' : '';
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
        <InnerBlocks/>
</div><!-- END CAROUSEL CONTAINER -->