<!doctype html>
<html lang="fr">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>MotaPhoto.com</title>
        <?php wp_head(); ?>
    </head>

    <body>
        
        <header>
            <!-- Ajout d'un custom logo modifiable en no-code -->
            <div class="logo-site">
                <?php the_custom_logo() ?>
            </div>
            <!-- Appel du menu principal généré en no-code -->
            <nav>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'menu_principal',
                    'container' => false,
                    'menu_class' => 'menu',
                ));
                ?>
            </nav>
            <!-- Création d'un menu burger pour la version mobile -->
            <div class="menu-burger">
                    <span class="ligne"></span>
                    <span class="ligne"></span>
                    <span class="ligne"></span>
            </div>
        </header>
        <!-- Appel du menu principal pour le déploiement du menu burger au clic -->
        <div class="navigation-burger">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'menu_principal',
                'container' => false,
                'menu_class' => 'menu',
            ));
            ?>
        </div>
        <!-- Ajout de la modale -->
        <div class="emplacement-modale">
            <?php include(get_stylesheet_directory() . '/template_part/modale.php'); ?>
        </div>

        <main>