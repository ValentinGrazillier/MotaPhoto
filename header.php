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
            <div class="logo-site">
                <?php the_custom_logo() ?>
            </div>
            <nav>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'menu_principal',
                    'container' => false,
                    'menu_class' => 'menu',
                ));
                ?>
            </nav>
            <div class="menu-burger">
                    <span class="ligne"></span>
                    <span class="ligne"></span>
                    <span class="ligne"></span>
            </div>
        </header>
        <div class="navigation-burger">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'menu_principal',
                'container' => false,
                'menu_class' => 'menu',
            ));
            ?>
        </div>

        <main>