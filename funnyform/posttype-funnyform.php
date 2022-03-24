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


add_action( 'init', 'ff_custom_postype' );
function ff_custom_postype() {
    $ff_args = array(
        'labels' => array('name' => esc_attr__( 'Funny Form', 'funnyform' )),
        'menu_icon' => 'dashicons-email-alt2',
        'public' => false,
        'can_export' => true,
        'show_in_nav_menus' => false,
        'show_ui' => true,
        'show_in_rest' => true,
        'capability_type' => 'post',
        'capabilities' => array( 'create_posts' => 'do_not_allow' ),
        'map_meta_cap' => true,
        'supports' => array( 'title', 'editor' )
    );
    register_post_type( 'funny_form_record', $ff_args );
}



add_filter( 'manage_funny_form_record_posts_columns', 'ff_custom_columns', 10 );
function ff_custom_columns( $columns ) {
    $columns['firstname_column'] = esc_attr__( 'First Name', 'funnyform' );
    $columns['lastname_column'] = esc_attr__( 'Last Name', 'funnyform' );
    $columns['date_column'] = esc_attr__( 'Date', 'funnyform' );
    $columns['email_column'] = esc_attr__( 'Email', 'funnyform' );
    $columns['phone_column'] = esc_attr__( 'Phone', 'funnyform' );
    $columns['newsletters_column'] = esc_attr__( 'Newsletters', 'funnyform' );
    $columns['privacy_column'] = esc_attr__( 'Privacy', 'funnyform' );
    $columns['file_column'] = esc_attr__( 'Attachment', 'funnyform' );


    $custom_order = array('cb', 'title', 'lastname_column',  'firstname_column', 'date_column', 'email_column', 'phone_column', 'file_column', 'newsletters_column', 'privacy_column', );
    foreach ($custom_order as $colname) {
        $new[$colname] = $columns[$colname];}

    return $new;
}


add_action( 'manage_funny_form_record_posts_custom_column', 'funny_form_record_columns_content', 10, 2 );
function funny_form_record_columns_content( $column_name, $post_id ) {
    switch ( $column_name ) {
        case 'lastname_column' :
            echo get_post_meta($post_id, 'lastname', true);
            break;

        case 'firstname_column' :
            echo get_post_meta($post_id, 'firstname', true);
            break;

        case 'date_column' :
            echo get_post_meta($post_id, 'date', true);
            break;

        case 'email_column' :
            echo get_post_meta($post_id, 'email', true);
            break;

        case 'phone_column' :
            echo get_post_meta($post_id, 'phone', true);
            break;

        case 'newsletters_column' :
            echo get_post_meta($post_id, 'newsletters', true);
            break;

        case 'privacy_column' :
            echo get_post_meta($post_id, 'privacy', true);
            break;

        case 'file_column' :
            echo attachment_output_admin_column($post_id);
            break;
    }
}

function attachment_output_admin_column($post_id){
    $html = '';

    $attachments = get_posts( array(
        'post_type' => 'attachment',
        'post_parent' => $post_id
    ));

    if(empty($attachments)){
        return '-';
    }

    $attachment = array_shift( $attachments );


    $html .= '<style>.ff-attachment img{width: 100%;height: auto;}</style>';

    $html .= '<a class="ff-attachment" href="'. $attachment->guid .'" >';
        if( $attachment->post_mime_type == 'image/jpeg' || $attachment->post_mime_type== 'image/png'){
            $html .= wp_get_attachment_image( $attachment->ID, 'thumbnail');
        }

        $html .= $attachment->post_name;
        $html .= '</br>';
        $html .= '(' . $attachment->post_mime_type . ')';

    $html .= '</a>';
    return $html;
}


/**
 *
 */

add_filter( 'manage_edit-funny_form_record_sortable_columns', 'ff_column_register_sortable');
function ff_column_register_sortable( $columns ) {
    $columns['firstname_column'] = 'firstname';
    $columns['lastname_column'] = 'lastname';
    $columns['date_column'] = 'date';
    $columns['email_column'] = 'email';
    $columns['phone_column'] = 'phone';
    $columns['newsletters_column'] = 'newsletters';
    $columns['privacy_column'] = 'privacy';
    $columns['file_column'] = 'file';

    return $columns;
}



