<?php
/**
 * alex-sg functions and definitions
 *
 * @package alex-sg
 */

/* Constant */
define( 'THEME_URI', get_template_directory_uri()  );
define( 'THEME_NAME', 'alex-sg'  );



if ( ! function_exists( 'setup_theme' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function setup_theme() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on alex-sg, use a find and replace
		 * to change 'alex-sg' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'alex-sg', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );


	}
endif;
add_action( 'after_setup_theme', 'setup_theme' );



/*
 * Emojii
 */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
add_filter( 'tiny_mce_plugins', 'disable_wp_emojis_in_tinymce' );
function disable_wp_emojis_in_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
        return array();
    }
}



/*
 * Feed
 */
remove_action( 'wp_head', 'feed_links', 2 ); 
remove_action( 'wp_head', 'feed_links_extra', 3 ); 
remove_action( 'wp_head', 'rsd_link' ); 
remove_action( 'wp_head', 'wlwmanifest_link' ); 
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0); 
remove_action( 'wp_head', 'wp_generator' ); 
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );



/**
 * Enqueue scripts and styles.
 */
function my_scripts_and_css(){

	wp_enqueue_style( 'alex-sg-style', get_stylesheet_uri() );

	// scripts
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', THEME_URI . '/js/jquery.min.js');
	wp_enqueue_script( 'jquery' );

	wp_deregister_script( 'jquery-migrate' );
	wp_register_script( 'jquery-migrate', THEME_URI . '/js/jquery-migrate.min.js', array( 'jquery' ), '', true );


	wp_register_script( 'owl.carousel', THEME_URI . '/js/owl.carousel.js', array( 'jquery', 'jquery-migrate' ), '', true );	
	wp_register_script( 'customizer', THEME_URI . '/js/customizer.js', array( 'jquery' ), '', true );


	wp_enqueue_script( 'jquery-migrate' );
	wp_enqueue_script( 'owl.carousel' );
	wp_enqueue_script( 'customizer' );	
	
	
	// style
	wp_register_style( 'bootstrap',  THEME_URI . '/css/bootstrap.min.css');
	wp_register_style( 'immovable-page',  THEME_URI . '/css/immovable-page.css');
	wp_register_style( 'archive-page',  THEME_URI . '/css/archive-page.css');
	wp_register_style( 'front-page',  THEME_URI . '/css/front-page.css');
	
	wp_register_style( 'owl.carousel',  THEME_URI . '/css/owl.carousel.min.css');
	wp_register_style( 'owl.theme.default',  THEME_URI . '/css/owl.theme.default.min.css');


	//wp_enqueue_style( 'dashicons' );
	wp_enqueue_style( 'bootstrap' );


	if(is_single()){
		wp_enqueue_style( 'immovable-page' );
		wp_enqueue_style( 'owl.carousel' );
		wp_enqueue_style( 'owl.theme.default' );
	}

	if(is_archive()){
		wp_enqueue_style( 'archive-page' );
	}	
	
	if(is_front_page()){
		wp_enqueue_style( 'front-page' );
		wp_enqueue_style( 'owl.carousel' );
		wp_enqueue_style( 'owl.theme.default' );		
	}

}
add_action( 'wp_enqueue_scripts', 'my_scripts_and_css', 99 );



/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';



/* Immovables */
require( 'immovables/immovables-list.php' );



// Remove "Category:", "Tag:", "Author:" from title. 
add_filter('get_the_archive_title', function ($title) {
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_author()) {
        $title = '<span class="author">' . get_the_author() . '</span>';
    } elseif (is_tax()) {
        $title = sprintf(__('%1$s'), single_term_title('', false));
    } elseif (is_post_type_archive()) {
        $title = post_type_archive_title('', false);
    }
    return $title;
});




/* Posts nav */
function wpbeginner_numeric_posts_nav(){
  
    if( is_singular() )
        return;
  
    global $wp_query;
  
    /** Stop execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 )
        return;
  
    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );
  
    /** Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;
  
    /** Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }
  
    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }
  
    echo '<div class="navigation"><ul>' . "\n";
  
    /** Previous Post Link */
    if ( true ){
		$class = 1 == $paged ? 'active' : '';
		if($paged > 1){
			$paged_link = ($paged - 1);
		}
		printf( '<li class="prev %s"><a href="%s"><svg xmlns="http://www.w3.org/2000/svg" width="7" height="13" viewBox="0 0 7 13" fill="none"><path d="M6 12L1 6.49998L6 1" stroke="#222222" stroke-linecap="round"/></svg> %s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $paged_link ) ), _( 'Previous', THEME_NAME ) );
	}
	
    /** Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';
  
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
  
        if ( ! in_array( 2, $links ) )
            echo '<li>…</li>';
    }
  
    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }
  
    /** Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li>…</li>' . "\n";
  
        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }
  
    /** Next Post Link */
    if ( true ){
		$class = $paged == $max ? 'active' : '';
		if($paged < $max){
			$paged_link = ($paged + 1);
		}		
		printf( '<li class="next %s"><a href="%s">%s <svg xmlns="http://www.w3.org/2000/svg" width="7" height="13" viewBox="0 0 7 13" fill="none">
		<path d="M1 12L6 6.49998L1 1" stroke="#222222" stroke-linecap="round"/>
		</svg></a></li>' . "\n", $class, esc_url( get_pagenum_link( $paged_link ) ), _( 'Next', THEME_NAME ) );
	}
		
	
  
    echo '</ul></div>' . "\n";
  
}



/* Immovables */
// Add Similar Property
add_action( 'before_footer_immovable', 'add_similar_property_immovable', 10 );
function add_similar_property_immovable(){
	
	global $post;
	$fields = get_fields();
	$property_name = $fields['Property_Name'];
	
	// args
	$args = array(
		'posts_per_page' => 15,
		'post_type'     => $post->post_type,
		'post__not_in' => array( $post->ID ),
		'orderby' => 'rand',
		'meta_query' => array(
				array(
					'key' => 'Property_Name',
					'value' => $property_name,
					'compare' => '='
				)                  

		), 

	);

	$the_query = new WP_Query( $args );

	?>
	
	<?php if( $the_query->have_posts() ): ?>
		<div id="similar-property" class="archive">
			<h2><?php _e( 'Similar Property', THEME_NAME ); ?></h2>
			<div class="stacked-card-list owl-carousel owl-theme owl-loaded owl-drag">
			<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
				<div class="card item">
					<?php get_template_part( 'template-parts/content', get_post_type() ); ?>
				</div>
			<?php endwhile; ?>
			</div>
		</div>
	<?php endif; ?>

	<?php wp_reset_query();  

}
// Add modal form
add_action( 'before_footer_immovable', 'modal_for_contact_form_immovable', 20 );
function modal_for_contact_form_immovable(){
	echo '<div id="modal-form" class="modal" style="display: none;">
			<div class="modal-overflow"></div>
			<div class="modal-content">
				<div class="modal-close">
					<button type="button" class="modal-close-btn" aria-label="Закрыть корзину">
						<svg role="presentation" class="t706__cartwin-close-icon" width="23px" height="23px" viewBox="0 0 23 23" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"> <g stroke="none" stroke-width="1" fill="#000000" fill-rule="evenodd"> <rect transform="translate(11.313708, 11.313708) rotate(-45.000000) translate(-11.313708, -11.313708) " x="10.3137085" y="-3.6862915" width="2" height="30"></rect> <rect transform="translate(11.313708, 11.313708) rotate(-315.000000) translate(-11.313708, -11.313708) " x="10.3137085" y="-3.6862915" width="2" height="30"></rect> </g> </svg> 
					</button>
				</div>' . do_shortcode('[contact-form-7 id="16" title=":enForm 1:ruForm 1:"]') . '
				<div class="clearfix"></div>
			</div>
	</div>';
}




/* Arhive Immovables */
// Add buttom term
add_action( 'before-loop-start', 'terms_immovable', 10 );
function terms_immovable(){
	
	global $post;
	global $TYPE_IMMOVABLES;
	global $IMMOVABLES_ARRAY;
	
	$lang = '';
	if( function_exists('wpm_get_language') ){
		$lang = wpm_get_language();
	}

		
	echo '<div class="immovables-term">';
	
	if(is_tax()){
		$term_id = get_queried_object()->term_id;
		$term = get_term( $term_id );
		$terms = get_term_children( $term_id, get_queried_object()->taxonomy );
		if($terms){
			echo '<div class="term-list">';
			foreach($terms as $v){
				$cur_term = get_term( $v );
				echo '<a class="term" href="' . get_term_link($v) . '">' . $cur_term->name . ' (' . $cur_term->count . ')</a>';
			}
			echo '</div>';
		}else{
			
			foreach( $IMMOVABLES_ARRAY as $k => $v){
				
				if($term->taxonomy != $IMMOVABLES_ARRAY[$k]["hidden"]['name']){
					continue;
				}
				
				$a = sanitize_text_field( ( $IMMOVABLES_ARRAY[$k]["slug"] . '-list-' . $term->slug ) );
				
				$terms = get_terms([
					'taxonomy' => $a,
					'parent' => '0',
					'childless' => true,
				]);			
				
				echo '<div class="term-list">';
				foreach( $terms as $term ){
					echo '<a class="term" href="' . get_term_link($term) . '">' . $term->name . ' (' . $term->count . ')</a>';
				}
				echo '</div>';				
			}

		}
	}


	if(is_archive() && !is_tax()){

		if( $post->post_type && $IMMOVABLES_ARRAY[$post->post_type] ){

			$post_type_data = get_post_type_object( $post->post_type );
						
						
			$terms = get_terms([
				'taxonomy' => $IMMOVABLES_ARRAY[$post->post_type]["hidden"]['name'],
				'hide_empty' => false,
			]);

			echo '<div class="term-list">';

			foreach( $terms as $term ){
				if( $term->count !== 0 ){
						echo '<a class="term" href="/' . $lang . '/' . $post_type_data->rewrite['slug'] . '/' . $term->slug . '/">' . $term->slug . ' (' . $term->count . ')</a>';				
				}
			}
			
			echo '</div>';	

		}

	}
	
	
	echo '</div>';
}
// Add buttom tag
add_action( 'img-immovable', 'tag_immovable', 10 );
function tag_immovable(){
		
	global $post;
	
	$lang = '';
	if( function_exists('wpm_get_language') ){
		$lang = wpm_get_language();
	}

	
	if($post){
		echo '<div class="tag-i">';
			if( $post->post_type ){
				$post_type_data = get_post_type_object( $post->post_type );
				if($post_type_data){
					echo '<a href="' . get_post_type_archive_link( $post->post_type ) . '" class="tag-post-i tag-post-deal-i">' . $post_type_data->rewrite['slug'] . '</a>';
				}
				
			}
			
			global $TYPE_IMMOVABLES;		
			if( $TYPE_IMMOVABLES ){		
				foreach($TYPE_IMMOVABLES as $type_i_name){
					$v = get_the_terms( $post->ID, $type_i_name );
					if($v){
						foreach($v as $k){
							echo '<a href="/' . $lang . '/' . $post_type_data->rewrite['slug'] . '/' . $k->slug . '/" class="tag-post-i">' . $k->slug . '</a>';
						}
					}
				}
			}
		echo '</div>';
	}	
}




// Sort
function ord_custom_query( $query ) {
        
    if( $query->is_main_query() && ! is_admin()  ) {// условие

		if(is_archive() || is_tax()){
	

			$meta_query = (array)$query->get('meta_query');

			$meta_query[] = array(
				'orderby_hot' => array(
 					'key'     => '_hot',
					'compare' => 'NOT EXISTS',
				),
				'orderby_hot' => array(
 					'key'     => '_hot',
					'compare' => 'EXISTS',
				),
				'orderby_data' => array(
 					'key' => '_mod',
					'compare' => 'EXISTS'
				),
 
			);

			$query->set('meta_query', $meta_query );


			$query->set('orderby', array( 'orderby_hot' => 'DESC', 'orderby_data' => 'DESC' ));

		}


    }

	
}
add_action( 'pre_get_posts', 'ord_custom_query' );

 

// Frone page shortcode
function show_post_frontend($attr){

	if( is_admin() ){
		return;
	}

    $ar = shortcode_atts( array(
            'coun_post' => '#',
            'type_deal' => '#',
        ), $attr );
 
 	
	if( $ar['coun_post'] ){
		$count = sanitize_text_field( $ar['coun_post'] );
	}else{
		$count = 15;
	}
	
	if( $ar['type_deal'] != 'hot' && $ar['type_deal'] != 'buy' && $ar['type_deal'] != 'rent' ){
		return;
	}

	$args['posts_per_page'] = $count;
	
	
	if( $ar['type_deal'] == 'hot' ){

		$args = array(
			'posts_per_page' => $count,
			'orderby' => 'date',
			'order' => 'DESC',
			'tax_query' => array(
				'relation' => 'OR',
				array(
					'taxonomy' => 'tag-immovables',
					'field'    => 'slug',
					'terms'    => array( 'hot' ),
				),
			),
		);
		
		$title = 'Hot';
		$class = 'tag-immovables';
		
	}else{
		
		$postType = get_post_type_object(('immovables-' . sanitize_text_field( $ar['type_deal'] ) . '-list'));
		
		if($postType){
			$title = $postType->label;
			$class = $postType->name;
			$slug = get_post_type_archive_link( $postType->name );
		}else{
			return;
		}
		
		$args = array(
			'post_type' => ('immovables-' . sanitize_text_field( $ar['type_deal'] ) . '-list'),
			'posts_per_page' => $count,
			'orderby' => 'date',
			'order' => 'DESC',
		);
		
	}
	
	$the_query = new WP_Query( $args );

	?>
	
	<?php if( $the_query->have_posts() ): ?>
		<div class="sh-bl archive <?php echo $class; ?>">
			<div class="btn-block">
			<h2><?php _e( $title, THEME_NAME ); ?></h2>
			<?php
				if( $ar['type_deal'] == 'buy' || $ar['type_deal'] == 'rent' ){
					echo '<a href="' . $slug . '" class="btn">' . _( 'Show All Properties', THEME_NAME ) . '</a>';
				}
			?>
			</div>
			<div class="stacked-card-list owl-carousel owl-theme owl-loaded owl-drag">		
			<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
				<div class="card item">
					<?php
					if( $ar['type_deal'] == 'hot' ){
							echo '<span class="tag-h"><svg xmlns="http://www.w3.org/2000/svg" width="10" height="15" viewBox="0 0 10 15" fill="none">
								<path d="M4.77044 14.375C3.83116 14.3749 2.91357 14.0927 2.13664 13.5648C1.3597 13.037 0.759258 12.2879 0.413161 11.4147C0.0670637 10.5415 -0.00872509 9.58449 0.195621 8.6677C0.399967 7.75092 0.875023 6.91667 1.55919 6.27312C2.39794 5.48375 4.45794 4.0625 4.14544 0.9375C7.89544 3.4375 9.77044 5.9375 6.02044 9.6875C6.64544 9.6875 7.58294 9.6875 9.14544 8.14375C9.31419 8.62687 9.45794 9.14625 9.45794 9.6875C9.45794 10.9307 8.96408 12.123 8.08501 13.0021C7.20593 13.8811 6.01365 14.375 4.77044 14.375Z" fill="white"/>
								</svg> ' . _( $title, THEME_NAME ) . '</span>';
					}
					?>
					<?php get_template_part( 'template-parts/content', get_post_type() ); ?>
				</div>
			<?php endwhile; ?>
			</div>
		</div>
	<?php endif; ?>

	<?php wp_reset_query();
 
}
add_shortcode( 'show_post' , 'show_post_frontend' );



