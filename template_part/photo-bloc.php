<?php
    // Récupération des informations de la photo
    $titre_post = get_the_title();
    $lien_post = get_permalink();
    $photo_post = get_the_content();
    $date_post = get_the_date('Y');

    // Récupération du format de la photo et stockage pour filtrage
    $formats = get_the_terms(get_the_ID(), 'formats');
        if ($formats && !is_wp_error($formats)) {
            $noms_formats = array();
            foreach ($formats as $format) {
                $noms_formats[] = $format->name;
            }
            $liste_formats = join(', ', $noms_formats);
        }

    // Récupération de la catégorie de la photo et stockage pour filtrage
    $categories = get_the_terms(get_the_ID(), 'categorie');
        if ($categories && !is_wp_error($categories)) {
            $noms_categories = array();
            foreach ($categories as $categorie) {
                $noms_categories[] = $categorie->name;
            }
            $liste_categories = join(', ', $noms_categories);
        }
?>

<!-- Affichage du bloc photo -->
<div class="autres-photos">
    <?= $photo_post; ?>
</div>