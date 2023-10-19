<div id="modale-contact">
    <button class="fermeture">X</button>
    <div class="contenu-modale">
        <img class="image-contact" src="<?php echo get_stylesheet_directory_uri() . '/assets/contact-header.png' ?>" alt="Le mot contact apparaît plusieurs fois afin de former la bannière du formulaire"/>
        <div class="shortcode-formulaire">
        <?php
            // Insertion du formulaire de contact à la modale
            echo do_shortcode('[contact-form-7 id="3362dcf" title="Formulaire de contact MotaPhoto"]');
        ?>
        </div>
    </div>
</div>