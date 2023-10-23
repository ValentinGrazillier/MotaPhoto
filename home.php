<?php
get_header();
?>

<div class="hero">
    <h1>Photographe Event</h1>
    <div class="hero-background">
        <?php
        // Affichage aléatoire d'une photo en format paysage
        $args = array(
            'post_type' => 'photographies',
            'posts_per_page' => 1,
            'orderby' => 'rand',
            'tax_query' => array(
                array(
                    'taxonomy' => 'formats', 
                    'field' => 'slug',
                    'terms' => 'paysage',
                ),
            ),
        );

        $photo_aleatoire_hero = new WP_Query($args);

        if ($photo_aleatoire_hero->have_posts()) :
            while ($photo_aleatoire_hero->have_posts()) : $photo_aleatoire_hero->the_post();
                the_content();
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </div>
</div>

<?php
get_footer();
?>