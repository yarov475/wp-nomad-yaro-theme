<?php
/** styles.
 */
function yaro_style() {
	wp_enqueue_style( 'yaro-bootstrap-rebot', get_template_directory_uri() . '/assets/libs/bootstrap-reboot/bootstrap-reboot.min.css' );
	wp_enqueue_style( 'yaro-font-awesome', get_template_directory_uri() . '/assets/libs/fontawesome/css/fontawesome.min.css' );
    wp_enqueue_style( 'yaro-hamburgers', get_template_directory_uri() . '/assets/libs/hamburgers/hamburgers.min.css' );
    wp_enqueue_style( 'yaro-style', get_stylesheet_uri(), array(), _S_VERSION );
    wp_enqueue_style( 'yaro-page', get_template_directory_uri() . '/assets/css/page.css' );
    wp_enqueue_style( 'yaro-trip', get_template_directory_uri() . '/assets/css/trip.css' );
    wp_enqueue_style( 'yaro-blog', get_template_directory_uri() . '/assets/css/blog.css' );
}
add_action( 'wp_enqueue_scripts', 'yaro_style' );



