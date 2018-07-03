<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<section id="about">
			<div class="homepage about">
				<h2>About</h2>
				<div class="about-grid">
					<?php
						$id = 56;
						$page = get_page($id);
						echo apply_filters('the_content', $page->post_content);
					?>
				</div>
			</div>
		</section>

		<section id="services">
			<div class="homepage services">
				<?php
					$services_page = 57;
					$service_name_1 = get_field('service_name_1', $services_page);
					$service_icon_1 = get_field('service_icon_1', $services_page);
					$service_description_1 = get_field('service_description_1', $services_page);
					$service_name_2 = get_field('service_name_2', $services_page);
					$service_icon_2 = get_field('service_icon_2', $services_page);
					$service_description_2 = get_field('service_description_2', $services_page);
					$service_name_3 = get_field('service_name_3', $services_page);
					$service_icon_3 = get_field('service_icon_3', $services_page);
					$service_description_3 = get_field('service_description_3', $services_page);
					$service_name_4 = get_field('service_name_4', $services_page);
					$service_icon_4 = get_field('service_icon_4', $services_page);
					$service_description_4 = get_field('service_description_4', $services_page);
				?>
				<h2>Services</h2>
					<div class="services-grid">
						<div class="icon-1">
							<h1><?php echo $service_icon_1; ?></h1>
						</div>
						<div class="service-1">
							<h3><?php echo $service_name_1; ?></h3>
						</div>
						<div class="description-1">
							<p><?php echo $service_description_1; ?></p>
						</div>
						<div class="icon-2">
							<h1><?php echo $service_icon_2; ?></h1>
						</div>
						<div class="service-2">
							<h3><?php echo $service_name_2; ?></h3>
						</div>
						<div class="description-2">
							<p><?php echo $service_description_2; ?></p>
						</div>
						<div class="icon-3">
							<h1><?php echo $service_icon_3; ?></h1>
						</div>
						<div class="service-3">
							<h3><?php echo $service_name_3; ?></h3>
						</div>
						<div class="description-3">
							<p><?php echo $service_description_3; ?></p>
						</div>
						<div class="icon-4">
							<h1><?php echo $service_icon_4; ?></h1>
						</div>
						<div class="service-4">
							<h3><?php echo $service_name_4; ?></h3>
						</div>
						<div class="description-4">
							<p><?php echo $service_description_4; ?></p>
						</div>
					</div>
			</div>
		</section>

		<section id="we-tribe">
			<div class="homepage we-tribe">
				<h2>We Tribe</h2>
				<div class="we-tribe-grid">
					<?php
						$id = 58;
						$page = get_page($id);
						echo apply_filters('the_content', $page->post_content);
					?>
				</div>
				<h2 class="we-tribe-join">Join the Tribe!</h2>
			</div>
		</section>

		<section id="recent-posts">
			<div class="homepage recent-posts">
				<h3>Recent Posts from We Tribe</h3>
				<?php query_posts('posts_per_page=4') ?>
					<?php while (have_posts() ): the_post(); ?>
						<?php the_post_thumbnail(); ?>
					<?php endwhile; ?>
				<?php wp_reset_query(); ?>
			</div>
		</section>

		<section id="connect">
			<div class="homepage connect">
				<h2>Connect with Me!</h2>
				<div class="contact-form">
					<?php if ( is_active_sidebar( 'contact-form-sidebar' ) ) : ?>
						<div id="secondary" class="widget-area" role="complementary">
							<?php dynamic_sidebar( 'contact-form-sidebar'); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</section>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
