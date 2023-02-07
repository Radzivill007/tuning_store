<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package tuning_store
 */

get_header();
?>

	<section class="error404">
		<div class="container">
			<img src="<?= get_template_directory_uri(); ?>/assets/img/404.png" alt="">
			<div class="text">
				<h3>Страница не найдена</h3>
				<p>Страница, на которую вы пытаетесь попасть, не существует или была удалена. Перейдите на <a href="/">Главную страницу</a>. </p>
			</div>
		</div>
	</section>

<?php
get_footer();
