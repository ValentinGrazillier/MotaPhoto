<?php
	get_header();

// Récupération de l'identifiant de la photo (nom) dans l'URL
$slug = get_query_var('photographies');

$args = array(
    'post_type' => 'photographies',
	// Utilisation du $slug récupéré précédemment pour afficher la photo associée à l'ID de l'URL
    'name' => $slug,
    'posts_per_page' => 1
);

$custom_query = new WP_Query($args);

if ($custom_query->have_posts()) :
    while ($custom_query->have_posts()) : $custom_query->the_post();

	$reference = get_field('reference');
	$type = get_field('type');
	$categories = wp_get_post_terms(get_the_ID(), 'categorie');
	$formats = wp_get_post_terms(get_the_ID(), 'formats');
?>

	<div class="bloc-photo">
		<!-- Zone gauche - Informations photos -->
		<div class="zone-gauche">
			<div class="infos-photo">
				<h2><?= the_title();?></h2>
				<p>RÉFÉRENCE : <span id="reference"><?= $reference;?></span></p>
				<p>CATÉGORIE : 
					<?php foreach ($categories as $categorie) {echo esc_html($categorie->name);} ?>
				</p>
				<p>FORMAT : 
					<?php foreach ($formats as $format) {echo esc_html($format->name);} ?>
				</p>
				<p>TYPE : <?= $type;?></p>
				<p>ANNÉE : <?= the_date('Y');?></p>
			</div>
		</div>
		<!-- Zone droite - La photo -->
		<div class="zone-droite">
			<div class="la-photo">
				<?= the_content();?>
			</div>
		</div>
	</div>
	<!-- Ajout du bandeau d'interactions inférieur -->
	<div class="bandeau-interactions">
		<div class="bandeau-gauche">
			<p>Cette photo vous intéresse ?</p>
			<button class="bouton-photo-unique">Contact</button>
		</div>
		<div class="bandeau-droit">
			<!-- Définition des bornes du tableau pour créer une boucle -->
			<?php 
				// Requête pour obtenir le dernier post
				$args_dernier = array(
					'post_type' => 'photographies', 
					'posts_per_page' => 1,
					'orderby' => 'date',
					'order' => 'DESC',
				);

				$dernier_post = new WP_Query($args_dernier);

				// Requête pour obtenir le premier post
				$args_premier = array(
					'post_type' => 'photographies', 
					'posts_per_page' => 1,
					'orderby' => 'date',
					'order' => 'ASC',
				);

				$premier_post = new WP_Query($args_premier);
			?>
			<div class="div-fleches">
				<div class="precedent">
					<!-- Récupération du post précédent par date de publication ASC (comportement naturel) -->
					<?php
					$previous_post = get_previous_post();
					// Si post précédent existant, affichage du post précédent
					if (!empty($previous_post)) :
					?>
						<a href="<?php echo get_permalink($previous_post); ?>">
							<img class="fleches fleche-gauche" src="<?php echo get_stylesheet_directory_uri() . '/assets/fleche-navigation-gauche.png' ?>" alt="Flèche de gauche" />
						</a>
					<!-- Si post précédent non-existant, affichage du dernier post publié -->
					<?php else :
						$dernier_post = $dernier_post->posts[0];
					?>
						<a href="<?php echo get_permalink($dernier_post); ?>">
							<img class="fleches fleche-gauche" src="<?php echo get_stylesheet_directory_uri() . '/assets/fleche-navigation-gauche.png' ?>" alt="Flèche de gauche" />
						</a>
					<?php endif; ?>
				</div>
				<div class="suivant">
					<!-- Récupération du post suivant par date de publication ASC (comportement naturel) -->
					<?php
					$next_post = get_next_post();
					// Si post suivant existant, affichage du post suivant
					if (!empty($next_post)) :
					?>
						<a href="<?php echo get_permalink($next_post); ?>">
							<img class="fleches fleche-droite" src="<?php echo get_stylesheet_directory_uri() . '/assets/fleche-navigation-droite.png' ?>" alt="Flèche de droite" />
						</a>
					<!-- Si post suivant non-existant, affichage du premier post publié -->
					<?php else :
						$premier_post = $premier_post->posts[0]; 
					?>
						<a href="<?php echo get_permalink($premier_post); ?>">
							<img class="fleches fleche-droite" src="<?php echo get_stylesheet_directory_uri() . '/assets/fleche-navigation-droite.png' ?>" alt="Flèche de droite"/>
						</a>
					<?php endif; ?>
				</div>
			</div>
			<div class="div-vignettes">
				<div class="conteneur-vignette-precedent">
					<?php
						// Récupération de la photo du post précédent
						if (!empty($previous_post)) {
							$miniature = get_post_field('post_content', $previous_post->ID);
						} else {
							$miniature = get_post_field('post_content', $dernier_post);
						}
						// Affichage du contenu
						echo $miniature;
					?>
				</div>
				<div class="conteneur-vignette-suivant">
					<?php
						// Récupération de la photo du post suivant
						if (!empty($next_post)) {
							$vignette = get_post_field('post_content', $next_post->ID);
						} else {
							$vignette = get_post_field('post_content', $premier_post);
						}
						// Affichage du contenu
						echo $vignette;
					?>
				</div>
			</div>
		</div>
	</div>

<?php
    endwhile;
    wp_reset_postdata();
endif;
?>

<!-- Deuxième partie de page - Photos apparentées -->
<div class="photos-apparentees">
	<h3>Vous aimerez aussi</h3>
	<div class="bloc-photos-apparentees">
		<div class="zone-photos">
			<?php
				// Récupération de la catégorie de la photo actuelle
				$categories = wp_get_post_terms(get_the_ID(), 'categorie');

				if ($categories && !is_wp_error($categories)) {
					$ID_categories = wp_list_pluck($categories, 'term_id');

					// Récupération de 2 photos de la même catégorie aléatoirement, en excluant le post actif
					$photos_similaires = new WP_Query(array(
						'post_type' => 'photographies',
						'posts_per_page' => 2,
						'post__not_in' => array(get_the_ID()),
						'orderby' => 'rand',
						'tax_query' => array(
							array(
								'taxonomy' => 'categorie',
								'field' => 'id',
								'terms' => $ID_categories,
							),
						),
					));

					if ($photos_similaires->have_posts()) {
						while ($photos_similaires->have_posts()) {
							$photos_similaires->the_post();
							get_template_part('template_part/photo-bloc');
						}
						wp_reset_postdata();
					} else {
						// Message en cas d'absence de photos de la même catégorie
						echo "Aucune photo similaire pour le moment - N'hésitez pas à me contacter si vous avez des propositions ou des idées.";
					}
				}
			?>
		</div>
		<a href="<?php echo esc_url(home_url('/')); ?>"><button class="voir-plus">Toutes les photos</button></a>
	</div>
</div>

<?php
	get_footer();
?>