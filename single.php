<?php
/**
 * The template for displaying single posts
 *
 * @link https://github.com/ValentinGrazillier
 *
 * @package WordPress
 * @subpackage motaphoto
 * @since 1.0
 */

get_header();

while (have_posts()) :
    the_post();

    // Contenu de l'article
    ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
            <h1 class="entry-title"><?php the_title(); ?></h1>
            <div class="entry-meta">
                <span class="posted-on">
                    <?php
                    printf(
                        esc_html__('Publié le %s', 'your-theme-text-domain'),
                        get_the_date()
                    );
                    ?>
                </span>
            </div>
        </header>

        <div class="entry-content">
            <?php the_content(); ?>
        </div>

        <footer class="entry-footer">
            <?php
            // Afficher les catégories et les balises
            the_category(', ');
            the_tags('Tags: ', ', ', '');

            // Naviagtion entre les posts
            the_post_navigation(
                array(
                    'prev_text' => '<span class="nav-previous">Article précédent : %title</span>',
                    'next_text' => '<span class="nav-next">Article suivant : %title</span>',
                )
            );
            ?>
        </footer>
    </article>

    <?php
    // A utiliser pour afficher les commentaires
    // comments_template();

endwhile; // End of the loop.

get_footer();
?>