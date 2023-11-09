<?php
    // Récupération des informations de la photo
    $titre_post = get_the_title();
    $titre_nettoye = sanitize_title($titre_post);
    $lien_post = get_template_directory_uri() . '/photographies/'. $titre_nettoye;
    $photo_post = get_the_content();
    $date_post = get_the_date('Y');
    $reference_photo = get_field('reference');

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
    <div class="lien-photo">
        <?= $lien_post; ?>
    </div>
    <?= $photo_post; ?>
    <div class="survol-photo">
        <div class="structuration-survol-photo">
            <div class="haut-survol">
                <i class="fa-solid fa-expand full-screen" style="color: #ffffff;"></i>
            </div>
            <div class="milieu-survol">
                <i class="fa-regular fa-eye oeil" style="color: #ffffff;"></i>
            </div>
            <div class="bas-survol">
                <div class="survol-reference">
                    <?= $reference_photo ?>
                </div>
                <div class="survol-categorie">
                    <?= $liste_categories; ?>
                </div>
            </div>
        </div>
    </div>
</div>
