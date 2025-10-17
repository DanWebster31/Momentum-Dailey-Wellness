console.log('loaded');

jQuery(function($){
	$('#btn_loadmore').click(function(){

		console.log('clicked');

		//goToByScroll('btn_loadmore');

		$('html,body').animate ({scrollTop: $ ('#btn_loadmore').offset ().top - 110}, 1000);

		var button = $(this),
		    data = {
			'action': 'loadmore',
			'query': misha_loadmore_params.posts, // that's how we get params from wp_localize_script() function
			'page' : misha_loadmore_params.current_page
		};

		$.ajax({
			url : misha_loadmore_params.ajaxurl, // AJAX handler
			data : data,
			type : 'POST',
			beforeSend : function ( xhr ) {
				button.text('Loading...'); // change the button text, you can also add a preloader image
			},
			success : function( data ){
				if( data ) {
					button.html( '<i class="far fa-repeat-alt"></i>&nbsp; Load More' ).before(data); // insert new posts
					misha_loadmore_params.current_page++;

					if ( misha_loadmore_params.current_page == misha_loadmore_params.max_page )
						button.remove(); // if last page, remove the button

						// Call SrcSet for images //
						callSrcset('.news-post-holder');

					// you can also fire the "post-load" event here if you use a plugin that requires it
					// $( document.body ).trigger( 'post-load' );
				} else {
					button.remove(); // if no data, remove the button as well
				}
			}
		});
	});
});
