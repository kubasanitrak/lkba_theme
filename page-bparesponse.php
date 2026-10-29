<?php
/**
 * Template Name: PAGE BPA RESPONSE
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

    #get_header(); 

    $SHOW_TITLE = get_field('show_title');
      
    $IS_PADDED = get_field('is_padded');

    $TOP_MARGIN = get_field('has_top_margin');

	$CLS = $IS_PADDED ? 'padded-content' : '';

	$SECTION_CLS = "full-bleed section ";	

	if($TOP_MARGIN):
		$SECTION_CLS .= "section-mar-T ";
	endif;
?>

<?php



    $booking_form_url = strtok($_SERVER['HTTP_REFERER'], '?');



#global $wpdb, $BookingPress, $bookingpress_pro_payment_gateways, $bookingpress_debug_payment_log_id;




/*
* TODO 
* CONFIRM SUBSCRIPTION FORM 
* - IN CASE BALANCE IS LESS THAN BOOKING SUM: $bookingpress_final_payable_amount
* SHOW BUTTON TO PROCEED TO FORM FOR UPGRADING SUBSCRIPTION BALANCE
* ELSE SHOW RECAP(BALANCE, TOTAL AMOUNT)
* + CONFIRMATION - "TAKE THIS TOTAL AMOUNT FROM MY SUBSCRIPTION"
* + BUTTON TO CONFIRM ACTION
*/




	 // Check that referer is local server.
    if (!isset($_SERVER['HTTP_REFERER']) || (parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) != $_SERVER['SERVER_NAME'])) {
        exit('Direct access not permitted');
    }
    
    $params = $_POST['bpaparams']; // getting our isolated array of parameters
    
    $names = array_keys($params); // extracting names from array
    $values = array_values($params); // extracting values from array

$LABEL_TAG_OPEN = '<p data-edit="mark inline" style="width: auto; text-align: left; margin: 0px 0px 0px 0px; padding: 8px 8px 0px; font-size: 14px; font-family: arial, helvetica, sans-serif; color: rgb(150, 150, 150); line-height: 100%; text-transform: uppercase; letter-spacing: 1px;">';
$LABEL_TAG_CLOSE = '</p>';
$VALUE_TAG_OPEN = '<p data-edit="mark inline" style="width: auto; text-align: left; padding: 0px 8px 8px; margin: 5px 0px 12px 0px; font-size: 18px; font-family: arial, helvetica, sans-serif; color: rgb(200, 200, 200); line-height: 125%;">';
$VALUE_TAG_CLOSE = '</p>';
$MARKUP ='';
for ($i = 0; $i < count($names); $i++) {
        $MARKUP .= $LABEL_TAG_OPEN;
        $MARKUP .= $names[$i];
        $MARKUP .= $LABEL_TAG_CLOSE;
        $MARKUP .= $VALUE_TAG_OPEN;
        $MARKUP .= $values[$i] ? $values[$i] : "-";
        $MARKUP .= $VALUE_TAG_CLOSE;
}

    $bpa_passed_service_id = $params['li_0_product_id'];
    $bpa_passed_service_name = $params['li_0_name'];
    $bpa_passed_final_payable_amount = $params['li_0_price'];
    $bpa_passed_customer_email = $params['email'];
    $bpa_passed_subscription_value = $params['credit_value'];
    $bpa_passed_user_id = $params['user_id'];
    $bpa_passed_redirect_url = $params['receipt_link_url'];
    $notify_url_param = $params['notify_url'];
    $appointment_params = $params['appoinment_params'];

    // $response_req_url = $booking_form_url;
    /*
    $response_form = '<input type="hidden" name="li_0_product_id" value="' . $bpa_passed_service_id . '" />';
    $response_form .= '<input type="hidden" name="li_0_name" value="' . $bpa_passed_service_name . '" />';
    $response_form .= '<input type="hidden" name="li_0_price" value="' . $bpa_passed_final_payable_amount . '" />';
    $response_form .= '<input type="hidden" name="email" value="' . $bpa_passed_customer_email . '" />';
    $response_form .= '<input type="hidden" name="credit_value" value="' . $bpa_passed_subscription_value . '" />';
    $response_form .= '<input type="hidden" name="user_id" value="' . $bpa_passed_user_id . '" />';
    $response_form .= '<input type="hidden" name="notify_url" value="' . $notify_url_param . '" />';
    $response_form .= '<input type="hidden" name="receipt_link_url" value="' . $bpa_passed_redirect_url . '" />';
    */
    $response_form = '<input type="hidden" name="receipt_link_url" value="' . $appointment_params . '" />';

    // $bpa_passed_final_payable_amount - (5/100 * $bpa_passed_final_payable_amount)
    // $bpa_passed_discounted_amount = ceil((int)$bpa_passed_final_payable_amount - (5/100 * (int)$bpa_passed_final_payable_amount));
    $bpa_reduced_amount = ceil((int)$bpa_passed_final_payable_amount * 0.955555555555555555555555555);
    $subscription_value_updated = (int)$bpa_passed_subscription_value - (int)$bpa_reduced_amount;




#acf_form(array($bpa_passed_user_id);
$acf_user_id = 'user_' . strval($bpa_passed_user_id);
$before_value = get_field('subscription_value', $acf_user_id);
update_field('subscription_value', $subscription_value_updated, $acf_user_id);



?>



<?php

    
global $booking_form_url, $bpa_passed_redirect_url;
//*/
    // Redirect back to contact form with status.
    header('Location: ' . $bpa_passed_redirect_url, TRUE, 302);
    exit;
/*/
    print("<br>came from url: " . $booking_form_url);
//*/

?>


	<?php #get_footer(); ?>