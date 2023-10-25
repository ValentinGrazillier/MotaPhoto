<?php
    // Ajout d'un logo personnalisable au panel d'administration du thème en no-code
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // Chargement du style
    function theme_enqueue_styles()
    {
      wp_enqueue_style('theme', get_template_directory_uri() . '/css/theme.css');
      wp_enqueue_style('style', get_template_directory_uri() . '/style.css');
    }
    add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
    
    // Ajout de la gestion des menus au panel d'administration du thème en no-code
    function register_custom_menus() {
        register_nav_menus(array(
            'menu_principal' => __('Menu principal', 'MotaPhoto'),
            'menu_secondaire' => __('Menu secondaire', 'MotaPhoto'),
        ));
     }
     
     add_action('init', 'register_custom_menus');

    //  Chargement du script JS
    function theme_enqueue_script() {
        wp_enqueue_script('script', get_template_directory_uri() . '/js/script.js');
        wp_enqueue_script('script-filtres', get_template_directory_uri() . '/js/filtres.js');
    }
    
    add_action('wp_enqueue_scripts', 'theme_enqueue_script');
    
    // Ouverture du type de contenu personnalisé "photographies" avec single-photo.php 
    function custom_single_template($single) {
        global $post;
        if ($post->post_type === 'photographies') {
            return get_template_directory() . '/single-photo.php';
        }
        return $single;
    }
    add_filter('single_template', 'custom_single_template');
?>
