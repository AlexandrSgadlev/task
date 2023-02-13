<?php
/**
 * Immovables Buy List
 * Class Immovables_Buy_CPT
 */
namespace Immovables_List;

class Immovables_Type_CPT
{

	/**
	 * Constructor
	 */
	public function __construct()
	{
		add_action('init', array( $this, 'init') );
	}
	
	/**
	 * Init
	 */
	public function init()
	{
		// Register CPT
		$this->registerCPT();
	}	
	
	/**
	 * Register CPT
	 */
	private function registerCPT()
	
	{
		
		global $IMMOVABLES_ARRAY;
		global $TYPE_IMMOVABLES;

		$IMMOVABLES_ARRAY['immovables-buy-list']['hidden']['name'] = 'buy-type-immovables';
		$IMMOVABLES_ARRAY['immovables-rent-list']['hidden']['name'] = 'rent-type-immovables';
		$IMMOVABLES_ARRAY['immovables-buy-list']['hidden']['slug'] = 'buy-i';
		$IMMOVABLES_ARRAY['immovables-rent-list']['hidden']['slug'] = 'rent-i';
		$IMMOVABLES_ARRAY['immovables-buy-list']['slug'] = 'buy';
		$IMMOVABLES_ARRAY['immovables-rent-list']['slug'] = 'rent';

		$TYPE_IMMOVABLES[] = 'rent-type-immovables';
		$TYPE_IMMOVABLES[] = 'buy-type-immovables';



		/* Tag */
		$labels = array(
			'name'                       => _x( 'Типы недвижимости', 'Taxonomy General Name', THEME_NAME ),
			'singular_name'              => _x( 'Типы недвижимостии', 'Taxonomy Singular Name', THEME_NAME ),
			'menu_name'                  => __( 'Типы недвижимости', THEME_NAME ),
			'all_items'                  => __( 'Все типы недвижимости', THEME_NAME ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'new_item_name'              => __( 'Название новой метки', THEME_NAME ),
			'add_new_item'               => __( 'Добавить метку', THEME_NAME ),
			'edit_item'                  => __( 'Редактировать', THEME_NAME ),
			'update_item'                => __( 'Обновить', THEME_NAME ),
			'view_item'                  => __( 'Просмотр', THEME_NAME ),
			'separate_items_with_commas' => __( 'Разделите метки', THEME_NAME ),
			'add_or_remove_items'        => __( 'Добавить или удалить метку', THEME_NAME ),
			'choose_from_most_used'      => __( 'Выберите из списка часто используемые метки', THEME_NAME ),
			'popular_items'              => __( 'Метки', THEME_NAME ),
			'search_items'               => __( 'Поиск меток', THEME_NAME ),
			'not_found'                  => __( 'Не найдено', THEME_NAME ),
			'no_terms'                   => __( 'Нет меток', THEME_NAME ),
			'items_list'                 => __( 'Список меток', THEME_NAME ),
			'items_list_navigation'      => __( 'Навигация по меткам', THEME_NAME ),
		);
		$rewrite = array(
			'slug'                       => 'buy-i',
			'with_front'                 => true,
			'hierarchical'               => true,
		);

		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'rewrite'                    => $rewrite,		
			'show_in_rest'               => true,
		);
		register_taxonomy( 'buy-type-immovables', array( 'immovables-buy-list' ), $args );	
		/* Tag */
		$labels = array(
			'name'                       => _x( 'Типы недвижимости', 'Taxonomy General Name', THEME_NAME ),
			'singular_name'              => _x( 'Типы недвижимости', 'Taxonomy Singular Name', THEME_NAME ),
			'menu_name'                  => __( 'Типы недвижимости', THEME_NAME ),
			'all_items'                  => __( 'Все типы недвижимости', THEME_NAME ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'new_item_name'              => __( 'Название новой метки', THEME_NAME ),
			'add_new_item'               => __( 'Добавить метку', THEME_NAME ),
			'edit_item'                  => __( 'Редактировать', THEME_NAME ),
			'update_item'                => __( 'Обновить', THEME_NAME ),
			'view_item'                  => __( 'Просмотр', THEME_NAME ),
			'separate_items_with_commas' => __( 'Разделите метки', THEME_NAME ),
			'add_or_remove_items'        => __( 'Добавить или удалить метку', THEME_NAME ),
			'choose_from_most_used'      => __( 'Выберите из списка часто используемые метки', THEME_NAME ),
			'popular_items'              => __( 'Метки', THEME_NAME ),
			'search_items'               => __( 'Поиск меток', THEME_NAME ),
			'not_found'                  => __( 'Не найдено', THEME_NAME ),
			'no_terms'                   => __( 'Нет меток', THEME_NAME ),
			'items_list'                 => __( 'Список меток', THEME_NAME ),
			'items_list_navigation'      => __( 'Навигация по меткам', THEME_NAME ),
		);
		$rewrite = array(
			'slug'                       => 'rent-i',
			'with_front'                 => true,
			'hierarchical'               => true,
		);

		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'rewrite'                    => $rewrite,		
			'show_in_rest'               => true,
		);
		register_taxonomy( 'rent-type-immovables', array( 'immovables-rent-list' ), $args );




		$labels = array(
			'name'                       => _x( 'Метки', 'Taxonomy General Name', THEME_NAME ),
			'singular_name'              => _x( 'Метки', 'Taxonomy Singular Name', THEME_NAME ),
			'menu_name'                  => __( 'Метки', THEME_NAME ),
			'all_items'                  => __( 'Все Метки', THEME_NAME ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'new_item_name'              => __( 'Название новой метки', THEME_NAME ),
			'add_new_item'               => __( 'Добавить метку', THEME_NAME ),
			'edit_item'                  => __( 'Редактировать', THEME_NAME ),
			'update_item'                => __( 'Обновить', THEME_NAME ),
			'view_item'                  => __( 'Просмотр', THEME_NAME ),
			'separate_items_with_commas' => __( 'Разделите метки', THEME_NAME ),
			'add_or_remove_items'        => __( 'Добавить или удалить метку', THEME_NAME ),
			'choose_from_most_used'      => __( 'Выберите из списка часто используемые метки', THEME_NAME ),
			'popular_items'              => __( 'Метки', THEME_NAME ),
			'search_items'               => __( 'Поиск меток', THEME_NAME ),
			'not_found'                  => __( 'Не найдено', THEME_NAME ),
			'no_terms'                   => __( 'Нет меток', THEME_NAME ),
			'items_list'                 => __( 'Список меток', THEME_NAME ),
			'items_list_navigation'      => __( 'Навигация по меткам', THEME_NAME ),
		);
		$rewrite = array(
			'slug'                       => 'tag-immovables',
			'with_front'                 => true,
			'hierarchical'               => false,
		);

		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			//'rewrite'                    => $rewrite,		
			'show_in_rest'               => true,
			//'default_term'				 => array(
							//'name' =>	'Hot',
							//'slug' =>	'hot'
				//),
		);
		register_taxonomy( 'tag-immovables', array( 'immovables-buy-list', 'immovables-rent-list' ), $args );
	

		


		foreach( $IMMOVABLES_ARRAY as $k => $v){
			
			$terms = get_terms([
				'taxonomy' => $IMMOVABLES_ARRAY[$k]["hidden"]['name'],
				'hide_empty' => false,
			]);			
			

			foreach( $terms as $term ){


				$sl = sanitize_text_field( ( $IMMOVABLES_ARRAY[$k]["slug"] . '/' . $term->slug ) );
				$a = sanitize_text_field( ( $IMMOVABLES_ARRAY[$k]["slug"] . '-list-' . $term->slug ) );
				$l = sanitize_text_field( ucfirst($term->slug) );


			$labels = array(
				'name'                       => _x( $l, 'Taxonomy General Name', THEME_NAME ),
				'singular_name'              => _x( $l, 'Taxonomy Singular Name', THEME_NAME ),
				'menu_name'                  => __( $l, THEME_NAME ),
				'all_items'                  => __( 'Все ' .$l , THEME_NAME ),
				'parent_item'                => __( 'Родительский тип', THEME_NAME ),
				'parent_item_colon'          => __( 'Родительский тип:', THEME_NAME ),
				'new_item_name'              => __( 'Название нового типа сделки', THEME_NAME ),
				'add_new_item'               => __( 'Добавить новый тип сделки', THEME_NAME ),
				'edit_item'                  => __( 'Редактировать', THEME_NAME ),
				'update_item'                => __( 'Обновить', THEME_NAME ),
				'view_item'                  => __( 'Просмотр', THEME_NAME ),
				'separate_items_with_commas' => __( 'Разделите типы сделки', THEME_NAME ),
				'add_or_remove_items'        => __( 'Добавить или удалить тип сделки', THEME_NAME ),
				'choose_from_most_used'      => __( 'Выберите из списка часто используемых типов сделки', THEME_NAME ),
				'popular_items'              => __( 'Типы сделки', THEME_NAME ),
				'search_items'               => __( 'Поиск типов сделок', THEME_NAME ),
				'not_found'                  => __( 'Не найдено', THEME_NAME ),
				'no_terms'                   => __( 'Нет типов сделок', THEME_NAME ),
				'items_list'                 => __( 'Список типов сделок', THEME_NAME ),
				'items_list_navigation'      => __( 'Навигация по типам сделок', THEME_NAME ),
			);
			
			$rewrite = array(
				'slug'                       => $sl,
				'with_front'                 => false,
				'hierarchical'               => true,
			);
			
			$args = array(
				'labels'                     => $labels,
				'hierarchical'               => true,
				'public'                     => true,
				'show_ui'                    => true,
				'show_admin_column'          => true,
				'show_in_nav_menus'          => true,
				'show_tagcloud'              => true,
				'rewrite'                    => $rewrite,
				'query_var'					 => $a,			
				'show_in_rest'               => true,
			);
			
			register_taxonomy( $a, array( $k ), $args );				
				

				
			}
			
		}

		

		
		/* CPT */
		$labels = array(
			'name'                  => _x( 'Buying Property in Dubai', 'Post Type General Name', THEME_NAME ),
			'singular_name'         => _x( 'Купить недвижимость', 'Post Type Singular Name', THEME_NAME ),
			'menu_name'             => __( 'Купить недвижимость', THEME_NAME ),
			'name_admin_bar'        => __( 'Купить недвижимость', THEME_NAME ),
			'archives'              => __( 'Список недвижимости', THEME_NAME ),
			'attributes'            => __( 'Свойства Купить недвижимость', THEME_NAME ),
			'parent_item_colon'     => __( 'Головная Купить недвижимость', THEME_NAME ),
			'all_items'             => __( 'Список Купить недвижимость', THEME_NAME ),
			'add_new_item'          => __( 'Добавить новую Недвижимость', THEME_NAME ),
			'add_new'               => __( 'Добавить', THEME_NAME ),
			'new_item'              => __( 'Новая Недвижимость', THEME_NAME ),
			'edit_item'             => __( 'Редактировать Недвижимость', THEME_NAME ),
			'update_item'           => __( 'Обновить Недвижимость', THEME_NAME ),
			'view_item'             => __( 'Просмотр', THEME_NAME ),
			'view_items'            => __( 'Просмотр Недвижимости', THEME_NAME ),
			'search_items'          => __( 'Поиск Недвижимости', THEME_NAME ),
			'not_found'             => __( 'Не найдено', THEME_NAME ),
			'not_found_in_trash'    => __( 'Не найдено в корзине', THEME_NAME ),
			'featured_image'        => __( 'Фото Недвижимости', THEME_NAME ),
			'set_featured_image'    => __( 'Установить фото Недвижимости', THEME_NAME ),
			'remove_featured_image' => __( 'Удалить фото', THEME_NAME ),
			'use_featured_image'    => __( 'Использовать как фото', THEME_NAME ),
			'insert_into_item'      => __( 'Вставить в элемент Купить недвижимость', THEME_NAME ),
			'uploaded_to_this_item' => __( 'Загружено для Купить недвижимость', THEME_NAME ),
			'items_list'            => __( 'Список недвижимости', THEME_NAME ),
			'items_list_navigation' => __( 'Навигация по списку Купить недвижимость', THEME_NAME ),
			'filter_items_list'     => __( 'Фильтр Купить недвижимость', THEME_NAME ),
		);
		$rewrite = array(
			'slug'                  => 'buy',
			'with_front'            => true,
			'pages'                 => true,
			'feeds'                 => true,
		);
		$args = array(
			'label'                 => __( 'Купить недвижимость', THEME_NAME ),
			'description'           => __( 'Список Купить недвижимость', THEME_NAME ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'thumbnail', 'comments', 'revisions' ),
			'hierarchical'          => true,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 7,
			'menu_icon'             => 'dashicons-admin-multisite',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'rewrite'               => $rewrite,
			'capability_type'       => 'page',
			'show_in_rest'          => true,
			'rest_base'             => '',
		);
		register_post_type( 'immovables-buy-list', $args );



		$labels = array(
			'name'                  => _x( 'Renting Property in Dubai', 'Post Type General Name', THEME_NAME ),
			'singular_name'         => _x( 'Аренда недвижимость', 'Post Type Singular Name', THEME_NAME ),
			'menu_name'             => __( 'Аренда недвижимость', THEME_NAME ),
			'name_admin_bar'        => __( 'Аренда недвижимость', THEME_NAME ),
			'archives'              => __( 'Список недвижимости', THEME_NAME ),
			'attributes'            => __( 'Свойства Аренда недвижимость', THEME_NAME ),
			'parent_item_colon'     => __( 'Головная Аренда недвижимость', THEME_NAME ),
			'all_items'             => __( 'Список Аренда недвижимость', THEME_NAME ),
			'add_new_item'          => __( 'Добавить новую Недвижимость', THEME_NAME ),
			'add_new'               => __( 'Добавить', THEME_NAME ),
			'new_item'              => __( 'Новая Недвижимость', THEME_NAME ),
			'edit_item'             => __( 'Редактировать Недвижимость', THEME_NAME ),
			'update_item'           => __( 'Обновить Недвижимость', THEME_NAME ),
			'view_item'             => __( 'Просмотр', THEME_NAME ),
			'view_items'            => __( 'Просмотр Недвижимости', THEME_NAME ),
			'search_items'          => __( 'Поиск Недвижимости', THEME_NAME ),
			'not_found'             => __( 'Не найдено', THEME_NAME ),
			'not_found_in_trash'    => __( 'Не найдено в корзине', THEME_NAME ),
			'featured_image'        => __( 'Фото Недвижимости', THEME_NAME ),
			'set_featured_image'    => __( 'Установить фото Недвижимости', THEME_NAME ),
			'remove_featured_image' => __( 'Удалить фото', THEME_NAME ),
			'use_featured_image'    => __( 'Использовать как фото', THEME_NAME ),
			'insert_into_item'      => __( 'Вставить в элемент Аренда недвижимость', THEME_NAME ),
			'uploaded_to_this_item' => __( 'Загружено для Аренда недвижимость', THEME_NAME ),
			'items_list'            => __( 'Список недвижимости', THEME_NAME ),
			'items_list_navigation' => __( 'Навигация по списку Аренда недвижимость', THEME_NAME ),
			'filter_items_list'     => __( 'Фильтр Аренда недвижимость', THEME_NAME ),
		);
		$rewrite = array(
			'slug'                  => 'rent',
			'with_front'            => true,
			'pages'                 => true,
			'feeds'                 => true,
		);
		$args = array(
			'label'                 => __( 'Аренда недвижимость', THEME_NAME ),
			'description'           => __( 'Список Аренды недвижимость', THEME_NAME ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'thumbnail', 'comments', 'revisions' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 7,
			'menu_icon'             => 'dashicons-admin-multisite',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'rewrite'               => $rewrite,
			'capability_type'       => 'page',
			'show_in_rest'          => true,
			'rest_base'             => '',
		);
		register_post_type( 'immovables-rent-list', $args );




	}

}

