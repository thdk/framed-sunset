jQuery(function($){
    var $container = $('.item-container .load-more').parents(".item-container");
	$container.append( '<span class="load-more"></span>' );
	var button = $container.find(".load-more");
	var page = 2;
	var loading = false;
    var finished = false;
	var scrollHandling = {
	    allow: true,
	    reallow: function() {
	        scrollHandling.allow = true; // set to true to enable infinite scroll
	    },
	    delay: 400 //(milliseconds) adjust to the highest acceptable value
	};
    
    if ($(".loadmore").length > 0) {
        $(window).scroll(function(){
            if($grid && !finished && ! loading && scrollHandling.allow ) {
                scrollHandling.allow = false;
                setTimeout(scrollHandling.reallow, scrollHandling.delay);           
                if($(window).scrollTop() + $(window).height() >= $(document).height() - 850) {
                    loadNextPage();
                }
            }
        });
    }
    
    $(".load-more-btn").not(".finished, .loading").on("click", loadNextPage);
    
    function loadNextPage() {
        loading = true;
        var $container = $(".item-container:not(.noload)");
        var postTypes = ['post', 'hike' , 'journal' ,'country', 'city'];
        if ($container.attr("data-loadmore-types")) {
            postTypes = $container.attr("data-loadmore-types").split(',');
        }
        
				var data = {
					action: 'be_ajax_load_more',
					nonce: beloadmore.nonce,
					page: page,
					query: { post_type: JSON.stringify(postTypes), term: $container.data("loadmore-term"), tax:$container.data("loadmore-tax"), paged: page},
				};
                
                $(".load-more-btn").addClass("loading");
                
                if ($(".item-container:not(.noload)").data("loadmore-cats")) {
                    data.query.category_name = $(".item-container:not(.noload)").data("loadmore-cats").replace("|", ",");
                }
				$.post(beloadmore.url, data, function(res) {
                    $(".load-more-btn").removeClass("loading");
					if( res.success) {
                        if (res.data) {
                            var newItems = $(res.data);
                            newItems.hide();
                            newItems.insertBefore($grid.find(".last"));
                            newItems.imagesLoaded().progress( function( imgLoad, image ) {
                              // get item
                              // image is imagesLoaded class, not <img>, <img> is image.img
                              var $item = $( image.img ).parents('.tile');
                              // un-hide item
                              $item.fadeIn(100);
                              // masonry does its thing
                                
                              $grid.masonry( 'appended', $item );
                            }).always(function() {
                                button.insertAfter($grid.find(".last"));
                                page = page + 1;
                                loading = false;
                            });                         
                           
                        }
                        else{
                            finished = true;
                            $(".load-more-btn").addClass("finished");
                        }
					} else {
						// console.log(res);
					}
				}).fail(function(xhr, textStatus, e) {
					// console.log(xhr.responseText);
				});
    }
});