<?php  


function astra_child_scripts() {
    wp_enqueue_style( 'google-font', '//fonts.googleapis.com/css2?family=K2D:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap' );
    wp_enqueue_style( 'slick',  get_stylesheet_directory_uri()."/assets/css/slick.css");
    wp_enqueue_style( 'fontawesome',  get_stylesheet_directory_uri()."/assets/css/all.min.css");
    wp_enqueue_style( 'boostrap',  get_stylesheet_directory_uri()."/assets/css/bootstrap.min.css");
    if(is_page_template('templates/template-cp-elementor.php')) {
        wp_enqueue_style( 'tempate-cp-elementor',  get_stylesheet_directory_uri()."/assets/css/template-cp.css", null, time());
        wp_enqueue_style( 'responsive-elementor',  get_stylesheet_directory_uri()."/assets/css/responsive.css", null, time());
    }
    wp_enqueue_style( 'astra-child-css',  get_stylesheet_directory_uri()."/style.css", null, time() );
    
    wp_enqueue_script( 'popper', get_stylesheet_directory_uri()."/assets/js/popper.1.2.js", array('jquery'), time(), true );
    wp_enqueue_script( 'bootstrap', get_stylesheet_directory_uri()."/assets/js/bootstrap.min.js", array('jquery'), time(), true );
    wp_enqueue_script( 'slick', get_stylesheet_directory_uri()."/assets/js/slick.js", array('jquery'), '1.0', true );
    wp_enqueue_script( 'astra-child', get_stylesheet_directory_uri()."/assets/js/child.js", array('jquery'), time(), true );
}

add_action('wp_enqueue_scripts','astra_child_scripts');


