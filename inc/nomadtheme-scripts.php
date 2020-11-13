<?php

/** scropts.
 */
function yaro_ssripts() {
 
	wp_style_add_data( 'yaro-style', 'rtl', 'replace' );
	 wp_enqueue_script('jquery');
	// wp_enqueue_script( 'yaro-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'yaro-js', get_template_directory_uri() . '/assets/js/scripts.min.js', array(), _S_VERSION, true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'yaro_ssripts' );



