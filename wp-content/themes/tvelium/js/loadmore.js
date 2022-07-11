jQuery(function($){
	/* Пагинация: ленивая загрузка */
	var button = $( '#loadmore a' ), // 
	    paged = button.data( 'paged' ),
	    maxPages = button.data( 'max-pages' );
	    postType = button.data( 'post-type' );
		
	button.click( function( event ) {
		event.preventDefault(); 
		
		$.ajax({
			type : 'POST',
			url : mainajax.ajax_url, 
			data : {
				paged : paged, 
				maxPages: maxPages,
				postType: postType,
				action : 'loadmore' 
			},
			dataType: 'json',
			beforeSend : function( xhr ) {
				button.text( 'Загружаем...' );
			},
			success : function( data ){
 
				paged++; 
				button.parent().before( data.posts );
				$('#content__pagination').html( data.pagination );
				button.text( 'Загрузить ещё' );

				if( paged == maxPages ) {
					button.remove();
				}
			}
		});
	} );

	/* Пагинация: стандартная пагинация */
	let pageLinkBtn = document.querySelectorAll('.content-pagination_link');
	let pageContent = document.querySelector('.content-news__inner');
	
	function getPagination(pageLinkBtn, pageContent) {
		if ( pageLinkBtn ) {
			pageLinkBtn.forEach( function(item) {
				item.addEventListener('click', function(e) {
					e.preventDefault();
					//console.log('+++');
					$.ajax({
						type : 'POST',
						url : mainajax.ajax_url, 
						data : {
							pagedP : $(this).attr( 'data-paged' ), 
							maxPages: $(this).attr( 'data-max-pages' ),
							postType: $(this).attr( 'data-post-type' ),
							author: $(this).attr( 'data-post-author' ),
							action : 'loadPagination' 
						},
						dataType: 'json',
						Accept: 'application/json',
						success : function( data ){
							//console.log( data );
							//pageContent.innerHTML += data.posts; // добавление
							pageContent.innerHTML = data.posts;
							$('#content__pagination').html( data.pagination );

							pageLinkBtn = document.querySelectorAll('.content-pagination_link');
							pageContent = document.querySelector('.content-news__inner');
							getPagination(pageLinkBtn, pageContent);
						}
					});
				});
			} );
		}
	}

	getPagination(pageLinkBtn, pageContent);

	

});