<?php
get_header();
?>

<div class="hero">
    <h1>Photographe Event</h1>
    <div class="hero-background">
        <?php
        // Affichage aléatoire d'une photo
        $args = array(
            'post_type' => 'photographies',
            'posts_per_page' => 1,
            'orderby' => 'rand',
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
<div class="bloc-les-photos">
    <div class="filtres">
        <div class="filtres-gauche">
            <!-- Création du menu déroulant Catégories -->
            <div class="filtre-categories">
                <select id="tri-categories">
                    <option class="filtre-nom" value="" disabled selected>Catégories</option>
                    <?php
                        $possibilites = get_terms('categorie');

                        if (!empty($possibilites) && !is_wp_error($possibilites)) {
                            foreach ($possibilites as $possibilite) {
                                echo '<option value="' . esc_attr($possibilite->slug) . '">' . esc_html($possibilite->name) . '</option>';
                            }
                        }
                    ?>
                </select>
            </div>
            <!-- Création du menu déroulant Formats -->
            <div class="filtre-formats">
                <select id="tri-format">
                    <option class="filtre-nom" value="" disabled selected>Formats</option>
                    <?php
                        $termes = get_terms('formats');

                        if (!empty($termes) && !is_wp_error($termes)) {
                            foreach ($termes as $terme) {
                                echo '<option value="' . esc_attr($terme->slug) . '">' . esc_html($terme->name) . '</option>';
                            }
                        }
                    ?>
                </select>
            </div>
        </div>
        <div class="filtres-droite">
            <!-- Création du menu déroulant Trier par -->
                <select id="tri-date">
                    <option class="filtre-nom" value="" disabled selected>Trier par</option>
                    <option value="anciennes-recentes">Des plus anciennes aux plus récentes</option>
                    <option value="recentes-anciennes">Des plus récentes aux plus anciennes</option>
                </select>
        </div>
    </div>
    <div class="zone-les-photos">
        <!-- Création d'une loop pour afficher toutes les photos -->
        <?php
            $args = array(
                'post_type' => 'photographies',
                'posts_per_page' => 12,
                'orderby' => 'date',
                'order' => 'DESC',
                'paged' => 1,
            );

            $photo_query = new WP_Query($args);

            if ($photo_query->have_posts()) {
                while ($photo_query->have_posts()) {
                    $photo_query->the_post();
                    get_template_part('template_part/photo-bloc');
                }
                wp_reset_postdata();
            } else {
                echo 'Aucune photo trouvée.';
            }
        ?>
    </div>
    <div class="bouton-accueil">
        <button id="charger-plus" class="voir-plus">Charger plus</button>
    </div>
</div>

<?php
get_footer();
?>