<?php
/**
 * The header for our theme
 *
 * @package alex-sg
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>


	<div id="page" class="site">
	
		
		<main id="content" class="container site-content">
			<div class="">
				<div class="site-header">
					<?php

						if ( is_archive() ) {
							?>

							<header class="archive-header has-text-align-center header-footer-group">
								<div class="archive-header-inner section-inner medium">
										<h1 class="archive-title"><?php _e(get_the_archive_title(), THEME_NAME); ?></h1>
								</div>
							</header>

							<?php
						}
						
						
						if ( is_front_page() ) {
							?>
							<header class="archive-header has-text-align-center header-footer-group">
								<div class="archive-header-inner section-inner medium">
										<h1 class="archive-title"><?php _e(get_the_title(), THEME_NAME); ?></h1>
								</div>
							</header>
							<?php
						}			
						
						
					?>
					
				</div>
			</div>

