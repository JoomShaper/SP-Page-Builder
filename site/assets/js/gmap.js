jQuery(function($){
  google.maps.event.addDomListener(window, 'load', function(){

    $('.sppb-addon-gmap-canvas').each(function(index){
      var mapId = 'sppb-addon-gmap' + (index + 1);
      var self = this;

      $(this).attr('id', mapId);

      var zoom = $(self).data('mapzoom');
      var mousescroll = $(self).data('mousescroll');

      var latlng = new google.maps.LatLng($(self).data('lat'), $(self).data('lng'));
      var mapOptions = {
        zoom: zoom,
        center: latlng,
        scrollwheel: mousescroll
      };
      var map = new google.maps.Map(document.getElementById(mapId), mapOptions);
      var marker = new google.maps.Marker({position: latlng, map: map});
      map.setMapTypeId(google.maps.MapTypeId[$(self).data('maptype')]);

    });

  });

});