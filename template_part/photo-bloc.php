<?php
    // Création d'une globale afin de mémoriser les ID des photos afin d'éviter les doublons
    global $exclusion_posts;
    $exclusion_posts = array();

    // Récupération de la catégorie du post actuel
    $categories = wp_get_post_terms(get_the_ID(), 'categorie');

    if (!empty($categories)) {
        // Création d'un tableau stockant les différents slugs de la taxonomie categorie
        $categorie_slugs = array();
        foreach ($categories as $categorie) {
            $categorie_slugs[] = $categorie->slug;
        }

        // Création d'un tableau pour stocker les ID de posts déjà inclus
        $exclusion_posts = array(get_the_ID());

        // Exclusion des ID posts déjà présents sur la page
        if (isset($exclusion_posts_inclus)) {
            $exclusion_posts = array_merge($exclusion_posts, $exclusion_posts_inclus);
        }

        $args = array(
            'post_type' => 'photographies',
            'posts_per_page' => 1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'categorie',
                    'field' => 'slug',
                    'terms' => $categorie_slugs,
                ),
            ),
            // Exclusion des ID des posts déjà présents
            'post__not_in' => $exclusion_posts,
            'orderby' => 'rand',
        );

        $my_query = new WP_Query($args);

        if ($my_query->have_posts()) {
            $my_query->the_post();
            // Ajout de l'ID du post à la liste pour permettre son exclusion future et éviter les doublons
            $exclusion_posts_inclus[] = get_the_ID();
            // Affichage de la photo du post
            echo '<div class="autres-photos">' . get_the_content() . '</div>';
            wp_reset_postdata();
        } else {
            // Affichage d'un message en cas de catégorie ne contenant qu'un seul élément
            echo "Aucune photo semblable pour le moment - N'hésitez pas à me contacter si vous avez des propositions.";
        }
    }
?>