<?php
/**
 * Immovables List
 * Class Init_Immovables
 */
namespace Immovables_List;

class Init_Immovables
{

	/**
	 * @const TEXTDOMAIN Text domain
	 */
	const TEXTDOMAIN = 'immovables-list';
	
	/**
	 * @const LANG Translations folder
	 */
	const LANG = '/lang';
	
    /**
     * @var Init_Immovables
     */
    private static $instance;	
	
	/**
	 * Init_Immovables folder
	 * @var string
	 */
	public $dir = '';
	
	/**
	 * Init_Immovables folder URL
	 * @var string
	 */
	public $url = '';	
	
	/**
	 * Init_Immovables file
	 * @var string
	 */
	private $file = '';	


	/**
	 * CPT
	 * @var $ImmovablesBuy;
	 */
	private $ImmovablesBuy;

	/**
	 * CPT
	 * @var $ImmovablesRent;
	 */
	private $ImmovablesRent;


	/**
	 * Tags Immovables
	 * @var tag
	 */
	private $tag;

	/**
	 * Template
	 * @var template
	 */
	private $template;
	
	
    /**
     * Gets the instance via lazy initialization (created on first usage)
	 * @param string $fDir folder. Must be specified at the first call ! 
     */
    public static function get( $fDir = '' ): Init_Immovables
    {
        if (null === static::$instance) {
            static::$instance = new static( $fDir );
        }

        return static::$instance;
    }
	
	/**
	 * Constructor
	 * @param string $fDir Init_Immovables File
	 */
	private function __construct( $fDir )
	{


		$this->file = $fDir;
		$this->dir = (get_template_directory() . '/immovables/classes/');
		$this->url = (get_template_directory_uri() . '/immovables/classes/');
		
		// CPT
		$this->ImmovablesType = new Immovables_Type_CPT();	

		add_action( 'init', array( $this, 'loadTextDomain' ), 10 );
		
		add_action( 'init', array( $this, 'rewrite_rule_immovables' ) );

		add_action( 'wp_after_insert_post', array( $this, 'update_post_terms' ) );

	}
	
	/**
	 * Load textdomain
	 */
	public function loadTextDomain()
	{
		load_theme_textdomain( self::TEXTDOMAIN, false, basename( dirname( $this->file ) ) . self::LANG );
	}

	/**
	 * Rewrite rule
	 */
	public function rewrite_rule_immovables()
	{

		global $IMMOVABLES_ARRAY;
		
		foreach( $IMMOVABLES_ARRAY as $k => $v){
			
			$terms = get_terms([
				'taxonomy' => $IMMOVABLES_ARRAY[$k]["hidden"]['name'],
				'hide_empty' => false,
			]);
			
			foreach( $terms as $term ){
				add_rewrite_rule( $IMMOVABLES_ARRAY[$k]["slug"]. '/' . $term->slug . '/?$', 'index.php?taxonomy=' . $IMMOVABLES_ARRAY[$k]["hidden"]['slug'] . '&' . $IMMOVABLES_ARRAY[$k]["hidden"]['name'] . '=' . $term->slug,  'top');
				add_rewrite_rule( $IMMOVABLES_ARRAY[$k]["slug"]. '/' . $term->slug . '\/page\/([0-9]*)?$', 'index.php?taxonomy=' . $IMMOVABLES_ARRAY[$k]["hidden"]['slug'] . '&' . $IMMOVABLES_ARRAY[$k]["hidden"]['name'] . '=' . $term->slug. '&paged=$matches[1]',  'top');
			}

		}
		
		
		
		// Add redirect (immovables-type)

		return;	


	}
	
	
	/**
	 * Update_post_terms
	 */	
	public function update_post_terms( $post_id )
	{

		if ( $parent = wp_is_post_revision( $post_id ) ){
			$post_id = $parent;
		}
		$post = get_post( $post_id );
		
		
		
		
		$h = 0;
		$tr = wp_get_post_terms( $post_id, 'tag-immovables' );
		foreach($tr as $v){
			if( $v->slug == 'hot' ){
				$h = 1;
				break;
			};
		};
		if( $h ){
			update_post_meta( $post_id, '_hot', 1 );
		}else{
			update_post_meta( $post_id, '_hot', 0 );
		}
		
		update_post_meta( $post_id, '_mod', get_post_timestamp($post) );






		global $IMMOVABLES_ARRAY;
		$post_type = $post->post_type;
		
		if(!$IMMOVABLES_ARRAY[$post_type]){
			return;
		}

		$terms = get_terms([
			'taxonomy' => $IMMOVABLES_ARRAY[$post_type]["hidden"]['name'],
			'hide_empty' => false,
		]);
		
		foreach( $terms as $term ){
			
			if(wp_get_post_terms($post_id, ( $IMMOVABLES_ARRAY[$post_type]["slug"] . '-list-' . $term->slug ) )){
				if( !term_exists( $term->slug, $post_type )){
					wp_set_post_terms( $post_id, $term->slug, $IMMOVABLES_ARRAY[$post_type]["hidden"]['name'], true );
				}
			}

		}


		return;

	}
	
}