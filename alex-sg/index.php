<?php
/**
 * The main template file
 *
 * @package alex-sg
 */

get_header();



?>

	<div id="primary" class="content-area">
		<div class="container">
		<?php
		if ( have_posts() ) :
			?>
			<header>
				<h3 class="page-title screen-reader-text"><?php the_title(); ?></h3>
			</header>
			
			<?php do_action('before-loop-start'); ?>
			
			<div class="list-item">
				<div class="row">
			

			<?php

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				?>
				
				<div class="col-12 col-sm-6 col-md-6 col-lg-4 item">
					<div class="card">
				<?php
				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

				?>
					</div>
				</div>
				
				<?php
				
			endwhile;

			?>
				<div class="clearfix"></div>
				</div>
			</div>
			<?php

			wpbeginner_numeric_posts_nav();
			
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
		</div>
	</div>

<?php
get_footer();
