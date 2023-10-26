<?php
    // Ajout d'un logo personnalisable au panel d'administration du thème en no-code
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    /////////////////////////////////////////////////////////////////////////// 

    // Chargement du style
    function theme_enqueue_styles()
    {
      wp_enqueue_style('theme', get_template_directory_uri() . '/css/theme.css');
      wp_enqueue_style('style', get_template_directory_uri() . '/style.css');
    }
    add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

    /////////////////////////////////////////////////////////////////////////// 
    
    // Ajout de la gestion des menus au panel d'administration du thème en no-code
    function register_custom_menus() {
        register_nav_menus(array(
            'menu_principal' => __('Menu principal', 'MotaPhoto'),
            'menu_secondaire' => __('Menu secondaire', 'MotaPhoto'),
        ));
     }
     
     add_action('init', 'register_custom_menus');

    /////////////////////////////////////////////////////////////////////////// 

    //  Chargement du script JS
    function theme_enqueue_script() {
        // Chargement du script jQuery
        wp_enqueue_script('jquery');
        wp_enqueue_script('script', get_template_directory_uri() . '/js/script.js');
        wp_enqueue_script('script-filtres', get_template_directory_uri() . '/js/filtres.js');
        wp_enqueue_script('script-pagination', get_template_directory_uri() . '/js/charger-plus.js');
        // Localisation du script pour AJAX
        wp_localize_script('script-pagination', 'myAjax', array('ajaxurl' => admin_url('admin-ajax.php')));
    }
    
    add_action('wp_enqueue_scripts', 'theme_enqueue_script');

    /////////////////////////////////////////////////////////////////////////// 
    
    // Ouverture du type de contenu personnalisé "photographies" avec single-photo.php 
    function custom_single_template($single) {
        global $post;
        if ($post->post_type === 'photographies') {
            return get_template_directory() . '/single-photo.php';
        }
        return $single;
    }
    add_filter('single_template', 'custom_single_template');

    /////////////////////////////////////////////////////////////////////////// 

    // Fonction AJAX pour le charger plus
    function charger_plus() {
        $page = $_POST['page'];
        $args = array(
            'post_type' => 'photographies',
            'posts_per_page' => 12,
            'orderby' => 'date',
            'order' => 'DESC',
            'paged' => $page,
        );
    
        $photo_query = new WP_Query($args);
    
        if ($photo_query->have_posts()) {
            while ($photo_query->have_posts()) {
                $photo_query->the_post();
                get_template_part('template_part/photo-bloc');
            }
            wp_reset_postdata();
        }
    
        die();
    }
    
    add_action('wp_ajax_charger_plus', 'charger_plus');
    add_action('wp_ajax_nopriv_charger_plus', 'charger_plus');
    
?>
