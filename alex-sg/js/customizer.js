/* global wp, jQuery */
/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	


	// Carousel
	var owl = $('.owl-carousel');
	if(owl && owl.owlCarousel){
		owl.owlCarousel({
			//loop: true,
			nav: true,
			navText: ['<svg xmlns="http://www.w3.org/2000/svg" width="8" height="12" viewBox="0 0 8 12" fill="none"><path d="M7 11L2 5.99999L7 1" stroke="#222222" stroke-width="1.5" stroke-linecap="round"/></svg>', 
			'<svg xmlns="http://www.w3.org/2000/svg" width="8" height="12" viewBox="0 0 8 12" fill="none"><path d="M1 11L6 5.99999L1 1" stroke="#222222" stroke-width="1.5" stroke-linecap="round"/></svg>'],	
			dots: false,
			margin: 20,
			responsive: {
				1200: {
					items: 3
				},
				768: {
					items: 2
				},
				567: {
					items: 2
				},
				0: {
					items: 1
				}
			}
		});	
	}
	
	
	
	// Modal
	function modal_b(){
		$( ".modal-b" ).click(function( event ) {
			var modal_id = ( $(this).data( "modal-id" ) );
			if(modal_id){
				e = $( "#" + modal_id );
				PopupDisplay( e, 'open' );
			}
		});
		$( ".modal-close-btn" ).click(function( event ) {
			e = $( this ).closest(".modal");		
			if ( e ){
				PopupDisplay( e, 'close' );
			}
		});
		$( ".modal").click(function( event ) {
			if( $( event.target ).hasClass('modal')){
				e = $( this ).closest(".modal");	
				PopupDisplay( $( event.target ), 'close' );
			}
		});
		$( ".modal-overflow" ).click(function( event ) {
			e = $( this ).closest(".modal");	
			PopupDisplay( e, 'close' );
		});
	}
	
	// Modal event
	function PopupDisplay(e,action){
		const html = document.getElementsByTagName('html')[0];
		

		if( $('#modal-basket') ){
			$('#modal-basket .wpcf7-submit').prop('disabled', false);			
		}
		
		if( $('#modal-basket').hasClass('active-email') ){
			location.reload()
		}
		
		if(action == 'open'){
			html.style.overflow = "hidden";
			html.style.marginRight = "17px";
			e.show();
		}
		if(action == 'close'){
			html.style.overflow = "inherit";
			html.style.marginRight = "0px";	
			e.hide();
		}
		
		
	}
	// Modal 
	modal_b();


}( jQuery ) );
