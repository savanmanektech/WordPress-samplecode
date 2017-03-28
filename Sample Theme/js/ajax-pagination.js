	(function($) {

	function find_page_number( element ) {
		
		element.find('span').remove();
		return parseInt( element.html() );
	}


	
	
	
	
	$(document).on( 'click', '.page-numbers a', function( event ) {
		event.preventDefault();

		var page = $(this).attr('href');
		 var page = page.substr(0, page.lastIndexOf('/'));
		page = page.substr(page.lastIndexOf('/')+1);

		$.ajax({
			url: ajaxpagination.ajaxurl,
			type: 'post',
			dataType: 'json',
			data: {
				action: 'ajax_pagination',
				query_vars: ajaxpagination.query_vars,
				
				page: page
			},
			 beforeSend: function() {
				// setting a timeout
				jQuery('.loader').show();
			
			},
			success: function( html ) { 
				jQuery('.loader').hide();
				$('#main').html('');
				//$('#main nav').remove();
				$('#main').append( html.content );
			}
		})
	})
	
	$(document).on( 'click', '.ajax_nav a', function( event ) {
		event.preventDefault();
		var th = $(this);
		page = find_page_number( $(this).clone() );

		$.ajax({
			url: ajaxpagination.ajaxurl,
			type: 'post',
			dataType: 'json',
			data: {
				action: 'sidebar_click',
				query_vars: ajaxpagination.query_vars,
				data_type:jQuery(this).attr('data-type'),
				data_val:jQuery(this).attr('data-val'),
				data_load:jQuery(this).attr('data-load'),
				data_term:jQuery(this).attr('data-term'),
				
				
			},
			 beforeSend: function() {
				// setting a timeout
				jQuery('.loader').show();
			
			},
			success: function( html ) {
				jQuery('.loader').hide();
			//	alert(th.attr('data-load'));
				//$('#main').find( '.row' ).remove();
				//$('#main nav').remove();
				
				if(th.attr('data-load') == 'true'){
					$('#main').html( html.content );
				}
				//$('#main').append( html.sidebar );
				th.parent().parent().parent().nextAll('div.col-xs-4').remove();
				//th.parent().parent().parent().nextAll('span').remove();
				if(html.sidebar){
					$('.side_menu').append(html.sidebar);
				}
				
				 jQuery('html, body').animate({
					scrollTop: jQuery("#second_section").offset().top - 54 
				}, 800);
	
				th.parent().parent().find('a').removeClass('active');
				th.addClass('active');
				if(html.query_vars){
				ajaxpagination.query_vars = html.query_vars;
				}
			}
		})
	})
	$(document).on( 'keyup', '.searchbox', function( event ) {
		$(this).parent().find('a').attr('data-val',$(this).val());
		})
})(jQuery);