<?php
add_action( 'after_setup_theme', 'lkba_theme_setup' );
function lkba_theme_setup() {
load_theme_textdomain( 'lkba_theme', get_template_directory() . '/languages' );
add_theme_support( 'title-tag' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
global $content_width;
if ( ! isset( $content_width ) ) $content_width = 640;


register_nav_menus( array(
		'main-menu'    => __( 'Hlavni Menu', 'lkba_theme' ),
		'fcbk-insta' => __( 'Social links', 'lkba_theme' ),
		'lang-menu' => __( 'Languages', 'lkba_theme' ),
		// 'selekce-menu'    => __( 'Selection Menu', 'lkba_theme' ),
		// 'index-menu'    => __( 'Index Menu', 'lkba_theme' ),
		'footer-menu'    => __( 'Footer Menu', 'lkba_theme' ),
		// 'support' => __( 'Podpora', 'lkba_theme' ),
	) );
}

add_action( 'comment_form_before', 'lkba_theme_enqueue_comment_reply_script' );
function lkba_theme_enqueue_comment_reply_script() {
	if ( get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
}
add_filter( 'the_title', 'lkba_theme_title' );
function lkba_theme_title( $title ) {
	if ( $title == '' ) {
		return '&rarr;';
	} else {
		return $title;
	}
}

function wp_example_excerpt_length( $length ) {
    return 12;
}
add_filter( 'excerpt_length', 'wp_example_excerpt_length');

// REMOVE HARDCODED WIDTH & HEIGHT INLINE IN THUMBNAIL
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10, 3 );

function remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}
// END REMOVE WIDTH & HEIGHT

add_filter( 'wp_title', 'lkba_theme_filter_wp_title' );
function lkba_theme_filter_wp_title( $title ) {
	return $title . esc_attr( get_bloginfo( 'name' ) );
}
add_action( 'widgets_init', 'lkba_theme_widgets_init' );
function lkba_theme_widgets_init() {
	// Arguments used in all register_sidebar() calls.
	$shared_args = array(
		'before_title'  => '<!-- ',
		'after_title'   => ' -->',
		// 'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
		'before_widget' => ' ',
		// 'after_widget'  => '</div></div>',
		'after_widget'  => ' ',
	);

	register_sidebar( 
		array_merge(
			$shared_args,
			array (
				'name' => __( 'Footer', 'lkba_theme' ),
				'id' => 'footer-widget-area',
				// 'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
				// 'after_widget' => "</li>",
				// 'before_title' => '<h3 class="widget-title">',
				// 'after_title' => '</h3>',
			)
		)
	);

	register_sidebar( 
		array_merge(
			$shared_args,
			array (
				'name' => __( 'Social links', 'lkba_theme' ),
				'id' => 'sociallinks-widget-area'
			)
		)
	);
}
function lkba_theme_custom_pings( $comment ) {
	$GLOBALS['comment'] = $comment;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
	<?php 
}
add_filter( 'get_comments_number', 'lkba_theme_comments_number' );

function lkba_theme_comments_number( $count ) {
	if ( !is_admin() ) {
		global $id;
		$temp_comments = get_comments( 'status=approve&post_id=' . $id );
		$comments_by_type = separate_comments( $temp_comments );
		return count( $comments_by_type['comment'] );
	} else {
		return $count;
	}
}
/* / — / — / — / — / — / — / — / — / — */
/* / — / — / — / — / — / — / — / — / — */
/* WRAP THE POST CONTENT IN CUSTOM DIV */
/* / — / — / — / — / — / — / — / — / — */
/* / — / — / — / — / — / — / — / — / — */
function wrap_content_in_div($content) {
    global $post;
    return '<div class="flow">'.$content.'</div>';
}
add_filter('the_content', 'wrap_content_in_div');
/* / — / — / — / — / — / — / — / — / — */
/* / — / — / — / — / — / — / — / — / — */
/* / — / — / — / — / — / — / — / — / — */
/* / — / — / — / — / — / — / — / — / — */


/*	 — — —  — — — — — — — — — — — — */
/*	 — — —  — — — — — — — — — — — — */
/*	 — — —  — — — — — — — — — — — — */
/*	 — — —  — — — — — — — — — — — — */
/* ACF CUSTOM BLOCKS
/*	 — — —  — — — — — — — — — — — — */


add_action( 'init', 'register_acf_blocks', 5 );
function register_acf_blocks() {
    register_block_type( __DIR__ . '/blocks/block-gmap' );
    register_block_type( __DIR__ . '/blocks/block-cenik-table' );
    register_block_type( __DIR__ . '/blocks/block-rozvrh-table' );
    register_block_type( __DIR__ . '/blocks/block-custom-columns' );
    register_block_type( __DIR__ . '/blocks/block-custom-column-item' );
    register_block_type( __DIR__ . '/blocks/block-tabs' );
    register_block_type( __DIR__ . '/blocks/block-tabs-item' );
    // register_block_type( __DIR__ . '/blocks/block-hp-grid-item');
    // register_block_type( __DIR__ . '/blocks/block-grid-row' );
}




function sevenYearSelect($field) {
    $currentYear = date('Y');
    // Create choices array
    $field['choices'] = array();
    // Add blank first selection; remove if unnecessary
    // $field['choices'][''] = ' ';
    // Loop through a range of years and add to field 'choices'. Change range as needed.
    foreach(range($currentYear+3, $currentYear-8) as $year) {
            
        $field['choices'][$year] = $year;
            
    }
    // Return the field
    return $field;
}

// add_filter('acf/load_field/key=field_0000000000000', 'sevenYearSelect');
// Apply to fields named "proj_year".
add_filter('acf/load_field/name=proj_year', 'sevenYearSelect');

add_filter( 'acf/blocks/wrap_frontend_innerblocks', 'acf_should_wrap_innerblocks', 10, 2 );
function acf_should_wrap_innerblocks( $wrap, $name ) {
    // if ( $name == 'acf/test-block' ) {
        // return true;
    // }
    return false;
}

add_filter( 'acf/blocks/default_block_version', function() {
    return 3;
});

// Gutenberg custom stylesheet
#add_theme_support('editor-styles');
#add_editor_style( 'editor-style.css' ); // make sure path reflects where the file is located

/* / — / — / — / — / — / – */
/* / — / — / — / — / — / – */
/* CUSTOMIZE WP LOGIN PAGE */
/* / — / — / — / — / — / – */

function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 300 150'%3E%3Cpath fill='%2312120D' d='m117.879 64.878 1.679-13.17h-1.049c-2.781 8.973-5.352 11.281-14.796 11.281h-1.626c-1.627 0-2.151-.42-2.151-2.151v-26.39c0-5.457.157-6.034 5.194-6.716v-.945H87.554v.945c5.036.682 5.194 1.259 5.194 6.715v22.718c0 5.352-.158 6.139-5.195 6.716v.944h19.623c2.046 0 8.237.053 10.703.053Zm2.256 52.326-13.851-15.897 8.395-7.765c5.823-5.404 7.187-6.558 10.598-6.978v-.944h-12.959v.944c5.561.42 4.669 2.256-.578 7.083l-11.7 10.86h-.052l12.33 14.376c1.836 2.151 1.783 3.568-1.732 3.83v.945h16.894v-.945c-3.148-.42-4.197-1.784-7.345-5.509Zm-20.2-1.154V93.332c0-5.456.158-6.034 5.195-6.716v-.944H87.554v.944c5.036.682 5.194 1.26 5.194 6.716v22.718c0 5.351-.158 6.138-5.195 6.716v.944h17.577v-.944c-5.037-.578-5.194-1.365-5.194-6.716ZM208.89 53.405c0-5.124-2.623-7.625-5.823-9.077 2.291-1.434 4.319-4.634 4.319-8.272 0-7.94-6.925-9.863-13.921-9.863h-14.568V64.86h15.53c7.888 0 14.463-3.148 14.463-11.472v.017Zm-23.207-21.773h8.429c3.848 0 6.401 1.766 6.401 5.176 0 3.848-2.396 5.544-6.401 5.544h-8.429v-10.72Zm0 15.897h8.639c5.177 0 7.573 1.871 7.573 5.876 0 4.005-2.344 6.034-7.205 6.034h-9.007v-11.91Zm10.878 37.443h-7.153l-14.411 38.668h6.926l2.99-8.587h15.688l3.043 8.587h7.415l-14.516-38.668h.018Zm-9.654 24.432 5.824-16.597 5.876 16.597H186.907Zm-37.408 33.579h3.497V6.85h-3.497V143v-.017Z'/%3E%3C/svg%3E");
			height:150px;
			width:320px;
			background-size: contain;
			background-repeat: no-repeat;
			padding-bottom: 30px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return esc_attr( get_bloginfo( 'name' ) );
    // return $title . esc_attr( get_bloginfo( 'name' ) );
}
add_filter( 'login_headertext', 'my_login_logo_url_title' );

/* / — / — / — / — / — / – */
/* CUSTOMIZE WP LOGIN PAGE */
/* / — / — / — / — / — / – */
/* / — / — / — / — / — / – */



// Adds support for editor color palette.

function my_theme_add_new_features() {

    // The new colors we are going to add
    $newColorPalette = [
        [
            'name'  => __( 'Krémová', 'lkba_theme' ),
			'slug'  => 'cream',
			'color'	=> '#EEE7D6',
        ],
        [
            'name'  => __( 'Rudá', 'lkba_theme' ),
			'slug'  => 'red',
			'color'	=> '#E92F3D',
        ],
        [
            'name'  => __( 'Zelená', 'lkba_theme' ),
			'slug'  => 'green',
			'color' => '#00573F',
        ],
        [
            'name'  => __( 'Dark', 'lkba_theme' ),
			'slug'  => 'black',
			'color' => '#000000',
        ],
    ];

    // Apply the color palette containing the original colors and 2 new colors:
    add_theme_support( 'editor-color-palette', $newColorPalette);
    // Disables color picker in block color palette.
    add_theme_support( 'disable-custom-colors' );
}
add_action( 'after_setup_theme', 'my_theme_add_new_features' );

/* / — / — / — / — / — / – / — / — / — / — / – */
/* / — / — / — / — / — / – / — / — / — / — / – */
/* KEEP TAGS ORDER AS INSERTED IN POST DETAILS */
/* / — / — / — / — / — / – / — / — / — / — / – */
/* / — / — / — / — / — / – / — / — / — / — / – */
require_once('includes/SlashAdmin.php');
$class = new TaxonomyOrder();

// Load Gutenberg Editor Styles
function custom_gutenberg_editor_styles() {
    wp_enqueue_style(
        'admin-styles',
        get_stylesheet_directory_uri().'/style-editor.css?v02-11-2023.01'
    );
}
add_action( 'admin_enqueue_scripts', 'custom_gutenberg_editor_styles' );

// add_post_type_support( 'post', 'page-attributes' );

/* WORK AROUND WP NASTY BUG PREPENDING AUTO TO SIZES ATTR */
add_filter(
        'wp_content_img_tag',
        static function ( $image ) {
                return str_replace( ' sizes="auto, ', ' sizes="', $image );
        }
);
add_filter(
        'wp_get_attachment_image_attributes',
        static function ( $attr ) {
                if ( isset( $attr['sizes'] ) ) {
                        $attr['sizes'] = preg_replace( '/^auto, /', '', $attr['sizes'] );
                }
                return $attr;
        }
);

/* / — / — / — / — / — / – / — / — / — / — / – */
/* / — / — / — / — / — / – / — / — / — / — / – */
/* CUSTOM ADMIN VOUCHER VALIDATION AND STATE EDITING */
/* / — / — / — / — / — / – / — / — / — / — / – */
/* / — / — / — / — / — / – / — / — / — / — / – */
/**/

function lkba_goods_admin_menu() {
    add_menu_page(
        'LKBA Dárkové poukazy', // Page title
        'Vouchery',      // Menu title
        'manage_options',     // Capability (admin only)
        'lkba-vouchery', // Menu slug
        'lkba_goods_admin_page_callback', // Callback function to render the page
        'dashicons-tickets-alt', // Icon (optional)
        99 // Position in menu
    );
}
add_action('admin_menu', 'lkba_goods_admin_menu');

function lkba_goods_admin_page_callback() {
    global $wpdb;
    $table_name = 'lkba_goods';

    // Search
    $search = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';

    // Sorting
    $sort_column = isset($_GET['sort']) ? sanitize_text_field($_GET['sort']) : 'id';
    $sort_order  = isset($_GET['order']) && strtoupper($_GET['order']) === 'DESC' ? 'DESC' : 'ASC';

    // Valid sortable columns
    $allowed_columns = [
        'id', 'type', 'name', 'email', 'invoice_number',
        'class_value', 'entries', 'sum_total', 'state'
    ];

    if (!in_array($sort_column, $allowed_columns, true)) {
        $sort_column = 'id';
        $sort_order  = 'ASC';
    }

    $where = '';
    if ($search !== '') {
        $where = $wpdb->prepare(
            " WHERE name LIKE %s OR id = %d",
            '%' . $wpdb->esc_like($search) . '%',
            intval($search)
        );
    }

    $query = $wpdb->prepare(
        "SELECT id, type, name, email, invoice_number, class_value, entries, sum_total, state 
         FROM $table_name $where 
         ORDER BY %i $order",
        $sort_column,
        $sort_order
    );

    $items = $wpdb->get_results($query);

    $nonce = wp_create_nonce('lkba_goods_update_state');

    // Build current query string for sorting links
    $current_url = add_query_arg([
        'page' => 'lkba-vouchery',
        's'    => $search,
    ], admin_url('admin.php'));
    ?>
    <div class="wrap">
        <h1>LKBA Dárkové poukazy</h1>

        <!-- Search Form -->
        <form method="get" class="lkba-search-form">
            <input type="hidden" name="page" value="lkba-vouchery" />
            <input
                type="search"
                name="s"
                placeholder="Search by Name or ID..."
                value="<?php echo esc_attr($search); ?>"
                style="width: 320px; height: 36px;"
            />
            <button type="submit" class="button button-primary">Search</button>
            <?php if ($search): ?>
                <a href="?page=lkba-vouchery" class="button">Clear</a>
            <?php endif; ?>
        </form>

        <table id="lkba-goods-table" class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <?php
                    $columns = [
                        'id'              => 'ID',
                        'type'            => 'Typ',
                        'name'            => 'Jméno',
                        'email'           => 'E-mail',
                        'invoice_number'  => 'Faktura #',
                        'class_value'     => 'Lekce',
                        'entries'         => 'Vstupů',
                        'sum_total'       => 'Celkem',
                        'state'           => 'Stav',
                        'action'          => 'Edit',
                    ];

                    foreach ($columns as $key => $label) {
                        if ($key === 'action') {
                            echo '<th style="width:120px;">Edit</th>';
                            continue;
                        }

                        $is_current = ($sort_column === $key);
                        $next_order = ($is_current && $sort_order === 'ASC') ? 'DESC' : 'ASC';
                        $arrow      = $is_current ? ($sort_order === 'ASC' ? ' ↑' : ' ↓') : '';

                        $sort_link = add_query_arg([
                            'sort'  => $key,
                            'order' => $next_order,
                        ], $current_url);

                        if($key === 'id') :
                            echo '<th style="width:40px;">';
                        else :
                            echo '<th>';
                        endif;
                        echo '<a href="' . esc_url($sort_link) . '" style="text-decoration:none;">';
                        echo esc_html($label) . $arrow;
                        echo '</a>';
                        echo '</th>';
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php if ($items): ?>
                    <?php foreach ($items as $item): ?>
                        <tr data-id="<?php echo esc_attr($item->id); ?>">
                            <td data-label="ID"><strong><?php echo esc_html($item->id); ?></strong></td>
                            <td data-label="Typ"><?php echo esc_html($item->type ?: '—'); ?></td>
                            <td data-label="Jméno"><?php echo esc_html($item->name ?: '—'); ?></td>
                            <td data-label="E-mail"><?php echo esc_html($item->email ?: '—'); ?></td>
                            <td data-label="Faktura"><?php echo esc_html($item->invoice_number ?: '—'); ?></td>
                            <td data-label="Lekce"><?php echo esc_html($item->class_value ?: '—'); ?></td>
                            <td data-label="Vstupy"><?php echo esc_html($item->entries ?: '0'); ?></td>
                            <td data-label="Celkem" style="text-align:right;">
                                <?php echo esc_html($item->sum_total ? number_format($item->sum_total, 2) : '0.00'); ?>
                            </td>
                            <td data-label="Stav" class="state-column">
                                <span class="state-badge state-<?php echo esc_attr(strtolower($item->state ?: 'pending')); ?>">
                                    <?php echo esc_html(ucfirst($item->state ?: 'pending')); ?>
                                </span>
                            </td>
                            <td>
                                <button type="button" class="edit-state-btn button button-small">
                                    Upravit
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="10" style="text-align:center; padding:40px;">No items found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <?php if ($items): ?>
            <p style="margin-top:15px; color:#666;">
                <?php echo number_format(count($items)); ?> item<?php echo count($items) !== 1 ? 's' : ''; ?> found
            </p>
        <?php endif; ?>
    </div>

    <script type="text/javascript">
        var lkbaNonce = '<?php echo esc_js($nonce); ?>';
        var ajaxUrl   = '<?php echo admin_url('admin-ajax.php'); ?>';
    </script>
    <?php
}

function lkba_goods_enqueue_admin_assets($hook) {
    // Only load on our custom page
    if ($hook !== 'toplevel_page_lkba-vouchery') {
        return;
    }

    // Enqueue CSS
    wp_enqueue_style('lkba-admin-css', get_template_directory_uri() . '/assets/css/lkba-admin.css', array(), '2.1');

    // Enqueue JS (depends on jQuery, which is included in WP admin)
    wp_enqueue_script('lkba-admin-js', get_template_directory_uri() . '/assets/js/lkba-admin.js', array('jquery'), '2.1', true);
}
add_action('admin_enqueue_scripts', 'lkba_goods_enqueue_admin_assets');

function lkba_update_goods_state() {
    check_ajax_referer('lkba_goods_update_state', 'nonce');

    if (!current_user_can('manage_options')) {
        wp_send_json_error('Permission denied.');
    }

    $allowed = ['pending', 'paid', 'used', 'canceled'];
    $state   = sanitize_text_field($_POST['state'] ?? '');

    if (!in_array($state, $allowed, true)) {
        wp_send_json_error('Invalid state.');
    }

    global $wpdb;
    $id = intval($_POST['id'] ?? 0);

    $updated = $wpdb->update(
        'lkba_goods',
        ['state' => $state],
        ['id' => $id],
        ['%s'],
        ['%d']
    );

    if ($updated !== false) {
        wp_send_json_success();
    } else {
        wp_send_json_error('No changes or DB error.');
    }
}
add_action('wp_ajax_lkba_update_goods_state', 'lkba_update_goods_state');

/* — | — | — */
/* — | — | — */
/* — | — | — */


// Add custom admin menu page
function add_invoices_admin_page() {
    add_menu_page(
        'Invoices',          // Page title
        'Invoices',          // Menu title
        'manage_options',    // Capability (admin level)
        'invoices',          // Menu slug
        'render_invoices_page', // Callback function
        'dashicons-pdf',     // Icon (optional)
        100                   // Position
    );
}
add_action('admin_menu', 'add_invoices_admin_page');


// Updated callback with nonce security
function render_invoices_page() {
    // Verify capability
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }
    $invoices_dir = dirname(ABSPATH) . '/barreacademy.cz/invoices/';
    $action = isset($_GET['action']) ? $_GET['action'] : '';
    $downloads_url = dirname(ABSPATH) . '/barreacademy.cz/downloads/';

    // Handle ZIP download with nonce verification
    if (isset($_POST['download_zip']) && isset($_POST['selected_files']) && is_array($_POST['selected_files'])) {
        // Verify nonce
        if (!isset($_POST['invoices_nonce']) || !wp_verify_nonce($_POST['invoices_nonce'], 'download_invoices_zip')) {
            wp_die('Security check failed. Please refresh the page and try again.');
        }

        if (!class_exists('ZipArchive')) {
            echo '<div class="notice notice-error"><p>ZipArchive extension is not enabled on this server.</p></div>';
        } else {

            // $file_to_remove = dirname(ABSPATH) . '/barreacademy.cz/downloads/*.zip';
            $file_to_remove = glob("{$downloads_url}*.zip");
            foreach ($file_to_remove as $file) {
                unlink($file);
            }

            $themes = $_POST['selected_files'];            

            $characters = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz";
            $string_length = 4;

            $random_characters = substr(str_shuffle($characters), 0, $string_length);
            $zip_name = "LKBA_Invoices_{$random_characters}.zip";
            // $zip_name = "LKBA_Invoices_{$random_characters}.zip";
            $zip_url = get_site_url() . '/downloads/' . $zip_name;

        
            $zip = new ZipArchive();
            $tmp_file = $downloads_url . $zip_name;
            $zip->open($tmp_file, ZipArchive::CREATE);
            foreach ($themes as $file) {
                $file_name = basename($file);
                $file_path = $invoices_dir . $file_name;
                // $zip->addFile($file, basename($file));
                $zip->addFile($file_path, $file_name);
            }
            $zip->close();

            header('Content-disposition: attachment; filename="' . $zip_name . '"');
            header('Content-type: application/zip');
            // header("Content-Type: application/octet-stream");
            header("Content-Length:" . filesize($zip_url));
            ?>
            <div class="wrap">
                <h1>Download</h1>
                <table class="wp-list-table widefat fixed striped">
                    <thead>
                        <tr>
                            <th>Soubor</th>
                            <th>Odkaz</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td><?php echo $zip_name ?></td>
                                <td> <a href="<?php echo $zip_url; ?>" target="_blank">Stáhnout ZIP</a> </td>
                            </tr>
                    </tbody>
                </table>
            </div>
            <?php

            exit;
          
        }
    }

    // Get PDF files
    $files = glob($invoices_dir . '*.pdf');

    ?>
    <div class="wrap">
        <h1>Invoices</h1>

        <?php if (empty($files)): ?>
            <p>No PDF invoices found in the folder.</p>
        <?php else: ?>
            <form method="post" id="invoices-form">
                <?php wp_nonce_field('download_invoices_zip', 'invoices_nonce'); ?>

                <table class="wp-list-table widefat fixed striped">
                    <thead>
                        <tr>
                            <th style="width:40px;"><input type="checkbox" id="select-all" style="margin: 0;"></th>
                            <th>Faktura</th>
                            <th>Velikost souboru (kB)</th>
                            <th>Odkaz</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($files as $file_path): ?>
                            <?php 
                            $file_name = basename($file_path);
                            $file_size = size_format(filesize($file_path));
                            ?>
                            <tr>
                                <td><input type="checkbox" name="selected_files[]" value="<?php echo esc_attr($file_name); ?>"></td>
                                <td><?php echo esc_html($file_name); ?></td>
                                <td><?php echo esc_html($file_size); ?></td>
                                <td>
                                    <a href="<?php echo get_site_url(); ?>/invoices/<?php echo esc_html($file_name); ?>" target="_blank"> Zobrazit PDF </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <p class="submit">
                    <button type="submit" name="download_zip" class="button button-primary" id="download-zip-btn">
                        Download Selected as ZIP
                    </button>
                </p>
            </form>
        <?php endif; ?>
    </div>

    <script>
        // Vanilla JS: Select all checkboxes
        document.addEventListener('DOMContentLoaded', function() {
            const selectAll = document.getElementById('select-all');
            const checkboxes = document.querySelectorAll('input[name="selected_files[]"]');
            const downloadBtn = document.getElementById('download-zip-btn');

            if (selectAll) {
                selectAll.addEventListener('change', function() {
                    checkboxes.forEach(cb => cb.checked = this.checked);
                    downloadBtn.disabled = !this.checked;
                });
            }

            // Optional: Disable button if nothing selected
            if (downloadBtn) {
                downloadBtn.disabled = true;
                document.querySelectorAll('input[name="selected_files[]"]').forEach(cb => {
                    cb.addEventListener('change', function() {
                        const anyChecked = Array.from(checkboxes).some(cb => cb.checked);
                        downloadBtn.disabled = !anyChecked;
                    });
                });
            }
        });
    </script>
    <?php
}