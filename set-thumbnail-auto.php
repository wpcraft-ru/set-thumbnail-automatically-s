<?php
/**
 * Plugin Name: Set post thumbnail automatically
 * Plugin URI:  http://wpengineer.com/2460/set-wordpress-featured-image-automatically/
 * Description: Set thumbnail post automatically on save post
 * Version:     20150103
 * Author:      CasePress
 * Author URI:  http://casepress.org
 * License:     MIT
 */

function set_post_thumbnail_automatically() {
			
        if ( ! isset( $GLOBALS['post']->ID ) )
            return NULL;

        if ( has_post_thumbnail( get_the_ID() ) )
            return NULL;

        $args = array(
            'numberposts'    => 1,
            'order'          => 'ASC', // DESC for the last image
            'post_mime_type' => 'image',
            'post_parent'    => get_the_ID(),
            'post_status'    => NULL,
            'post_type'      => 'attachment'
        );

        $attached_image = get_children( $args );
        if ( $attached_image ) {
            foreach ( $attached_image as $attachment_id => $attachment )
                set_post_thumbnail( get_the_ID(), $attachment_id );
        }
}
add_action( 'save_post', 'set_post_thumbnail_automatically' );