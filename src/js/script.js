var $grid;
var $grid2;
jQuery(document).ready(function($) {
    MaintainGrid($(".childs-overview .child"), 1, 3);
      $(".item-container").imagesLoaded().always( function( instance ) {     
          $(".item-container").removeClass("pre-data");
          $(".pre-data-message").remove();
            $grid = $(".item-container:not(.noload)").masonry({
                columnWidth:  '.tile',
                itemSelector: '.tile',
                gutter: 20
            });      
              $grid2 = $(".item-container.noload").masonry({
                    columnWidth:  '.tile',
                    itemSelector: '.tile',
                    gutter: 20
                });   
         });



        function masonryLayoutComplete() {
            $(".item-container").show();
        }

        function MaintainGrid(items, minNrOfTopItems, itemsInRow) {
        var count = items.length;
        var itemsInGrid = count-minNrOfTopItems;    
        var itemsToPushOut = items.splice(0, minNrOfTopItems + itemsInGrid % itemsInRow );
        $(itemsToPushOut).each(function(index, item) {
            $(item).addClass("push");
        });

        return itemsToPushOut; 

    }
    
    
    $(function() {
      var a = function() {
        var b = $(window).scrollTop();
        var d = $("#scroller-anchor").offset().top;
          
        var c=$("#scroller");
        if (b>d) {
            if (b > $(".site-main").height() - 154 + $(window).height()){
              c.removeClass("fixed-sharing relative-sharing").addClass("absolute-bottom-sharing");
            } else{
                c.addClass("fixed-sharing").removeClass("relative-sharing absolute-bottom-sharing");
            }
            
        } else {
          if (b<=d) {
              c.addClass("relative-sharing").removeClass("fixed-sharing absolute-bottom-sharing");
          }
        }
      };
        if ($("#scroller-anchor").length > 0) {
        $(window).scroll(a);a()
        }
    });
    
    
    
});

function initMap() {
    // show map with markers if any
    var $map = jQuery(".map");
    var $markers = jQuery(".item-container .tile[data-lng!=''][data-lat!='']");
    console.log($markers);
    if ($markers.length == 0)
        return;
    
    var $centerMarker = jQuery($markers[0]);
    var centerLat = parseFloat($centerMarker.attr("data-lat"));
    var centerLng = parseFloat($centerMarker.attr("data-lng"));
    $map.css("width", "100%").css("height", "400px");
    
     var firstmarker = {lat: centerLat, lng: centerLng};
        var map = new google.maps.Map($map[0], {
          zoom: 7,
          center: firstmarker
        });
    for(var i = 0; i<$markers.length; i ++) {
        var $data = jQuery($markers[i]);
        var lat = parseFloat($data.attr("data-lat"));
        var lng = parseFloat($data.attr("data-lng"));
        addMarker(map, lat, lng);
    }
    // end map
}

function addMarker(map, lat, lng) {
    var markerCors = {lat: lat, lng: lng};
    var marker = new google.maps.Marker({
          position: markerCors,
          map: map
        });
}

