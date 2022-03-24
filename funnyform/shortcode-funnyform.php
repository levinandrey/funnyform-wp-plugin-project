<?php

/**
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Funnyform
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}




/**
 *  Shortcode definition
 **/
add_shortcode('funnyform', 'ff_shortcode');
function ff_shortcode($ff_atts) {
    // attributes
    $ff_atts = shortcode_atts(array(
        'class' => 'ff-container',
        'email_to' => '',
        'prefix_subject' => '',
        'subject' => '',
        'label_lastname' => '',
        'label_firstname' => '',
        'label_email' => '',
        'label_phone' => '',
        'label_date' => '',
        'label_newsletters' => '',
        'label_privacy' => '',
        'label_submit' => '',
        'error_name' => '',
        'error_email' => '',
        'error_subject' => '',
        'error_captcha' => '',
        'error_captcha_sum' => '',
        'error_message' => '',
        'message_success' => '',
        'message_error' => '',
        'auto_reply_message' => ''
    ), $ff_atts);

    return shortcode_main();
}


function shortcode_main(){

    /**
     *  Load Bootstrap css and Date picker css
     *
     * https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css
     *
     * https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css
     *
     * https://unpkg.com/date-of-birth-js@^2/dist/css/date-of-birth-js.min.css
     *
     **/
    add_action( 'wp_enqueue_scripts', 'load_css_and_js_add_to_head' );
    function load_css_and_js_add_to_head(){
        wp_enqueue_style( 'bootstrap_css', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css');
        wp_enqueue_style( 'bootstrap_icons_css', plugin_dir_url( __FILE__ ) . 'css/bootstrap-icons/bootstrap-icons.css');

        wp_enqueue_style( 'date_picker_css', plugin_dir_url( __FILE__ ) . 'css/date-of-birth-js.min.css');
    }


    /**
     *  Date picker lib js and custom js script (Added before </body>)
     *
     * https://unpkg.com/date-of-birth-js@^2/dist/js/date-of-birth-js.min.js
     *
     */
    add_action( 'wp_enqueue_scripts', 'load_scripts_to_footer');
    function load_scripts_to_footer(){
        wp_enqueue_script( 'date_of_birth_js_min', plugin_dir_url( __FILE__ ) . 'js/date-of-birth-js.min.js', '', '', true);
        wp_enqueue_script( 'date_picker_custom_funnyform', plugin_dir_url( __FILE__ ) . 'js/date-picker-custom-funnyform.js', '', '', true);
    }

    if (isset($_POST['ff_privacy'])) {
        $data = array(
            'firstname' => sanitize_text_field($_POST['ff_lastname']),
            'lastname' => sanitize_text_field($_POST['ff_firstname']),
            'date' => sanitize_text_field($_POST['ff_date']),
            'email' => sanitize_email($_POST['ff_email']),
            'phone' => sanitize_text_field($_POST['ff_phone']),
            'newsletters' => $_POST['ff_newsletters'] == 'true' ? 1 : 0,
            'privacy' => $_POST['ff_privacy'] == 'true' ? 1 : 0
        );

        $post_information = array(
            'post_title' => wp_strip_all_tags($data['email']),
            'post_content' => $data['lastname'] . "\r\n\r\n" . $data['firstname'] . "\r\n\r\n" . $data['date'] . "\r\n\r\n" . $data['email']. "\r\n\r\n" . $data['phone'] . "\r\n\r\n" . $data['newsletters']. "\r\n\r\n" . $data['privacy'],
            'post_type' => 'funny_form_record',
            'post_status' => 'publish',
            'meta_input' => array(
                "lastname" => $data['lastname'],
                "firstname" => $data['firstname'],
                "date" => $data['date'],
                "email" => $data['email'],
                "phone" => $data['phone'],
                "newsletters" => $data['newsletters'],
                "privacy" => $data['privacy'],
            )
        );
        $post_id = wp_insert_post($post_information);


        if (wp_verify_nonce( $_POST['ff_file_nonce'], 'ff_file' )) {
            require_once( ABSPATH . 'wp-admin/includes/image.php' );
            require_once( ABSPATH . 'wp-admin/includes/file.php' );
            require_once( ABSPATH . 'wp-admin/includes/media.php' );

            $attachment_id = media_handle_upload( 'ff_file', $post_id );
        }

        require_once 'shortcode-form-thanks-funnyform.php';
        return form_contact_thanks_html();
    }

    /**
     *  Contact Form HTML
     **/
    require_once 'shortcode-form-funnyform.php';
    return form_contact_html();
}