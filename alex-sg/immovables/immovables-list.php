<?php
/**
	Struct initialization
	
		CPT
			immovables-buy-list
			immovables-rent-list

		Taxonomy 
			buy-type-immovables
			rent-type-immovables
			
		global
			$IMMOVABLES_ARRAY
			$TYPE_IMMOVABLES;
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

global $IMMOVABLES_ARRAY;
global $TYPE_IMMOVABLES;

/* Files */

/* init */
require( 'classes/init.php' );
/* CPT */
require( 'classes/immovables-list.php' );



/* Run */
\Immovables_List\Init_Immovables::get(  __FILE__ );





