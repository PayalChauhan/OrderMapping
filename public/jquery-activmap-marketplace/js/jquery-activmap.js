/* Activ'Map Plugin 1.6.6
 * Copyright (c) 2015 Pandao
 * Documentation : /doc/index.html
 */
(function($){
    var markers = [];
    $.activmap = {
        defaults: {/*
            places: [],    //list of places objects {title, address, phone, tags, lat, lng, img},
            lat: '',       //latitude of the center
            lng: '',       //longitude of the center
            zoom: 2,              //default zoom level between 0 and 21
            cluster: true,         //enables / disables clustering for large amounts of markers
            mapType: 'roadmap',    //map type : "roadmap", "satellite", "perspective"
            posPanel: 'left',      //position of the removable panel : "left" or "right"
            showPanel: !0,       //shows / hides the removable panel
            radius: 0,             //max radius in kilometers
			unit: "km",
            country: null,         //country limit for location input (ex. "ca": Canada, "us": United States, "fr": France...)
            autogeolocate: !1,  //auto geolocation to set the center of the map
			allowMultiSelect: !0,
            icon: '',
			center_icon: "",
            styles: [{"featureType":"landscape.man_made","elementType":"geometry","stylers":[{"color":"#f7f1df"}]},{"featureType":"landscape.natural","elementType":"geometry","stylers":[{"color":"#f3f1ed"}]},{"featureType":"landscape.natural.terrain","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"on"}]},{"featureType":"poi.business","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.medical","elementType":"geometry","stylers":[{"color":"#fbd3da"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#cadfaa"}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"on"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffe15f"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#efd151"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"color":"black"}]},{"featureType":"transit.station.airport","elementType":"geometry.fill","stylers":[{"color":"#cfb2db"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#a0c3ff"}]}],
            request: 'large',       //type of request "large" or "strict"
			locationTypes: ["geocode", "establishment"]
        */}
    };

    $.arrayIntersect = function(a, b)
    {
        return $.grep(a, function(i)
        {
            return $.inArray(i, b) > -1;
        });
    };
    
    $.fn.extend({
        
        activmap : function(settings){
            
            var s = $.extend({}, $.activmap.defaults, settings);

            //Map init
            var latlng = new google.maps.LatLng(s.lat,s.lng);
            var opendInfoWindow = null;
            //var markers = [];
            var infoWindow = [];
            var ids = [];
            var markerCluster;
            var centerMarker;
            var bounds = new google.maps.LatLngBounds;
            var num_places = 0;
            var old_results = 0;
            var mapTypeId = google.maps.MapTypeId.ROADMAP;
            if(s.mapType == 'satellite' || s.mapType == 'perspective') mapTypeId = google.maps.MapTypeId.HYBRID;
            var map = new google.maps.Map(document.getElementById('activmap-canvas'), {
                zoom: s.zoom,
                center: latlng,
                mapTypeId: mapTypeId,
                styles: s.styles
            });
            bounds.extend(latlng);
            var init_latlngBounds = map.getBounds();
            
            if(s.mapType == 'perspective') map.setTilt(45);
            var activmap_canvas = $('#activmap-canvas');
            var activmap_places = $('#activmap-places');
            var map_w = activmap_canvas.width();
            var cont_w = activmap_places.outerWidth();
            
            if(!s.showPanel) activmap_places.show();
            else{
                if(s.posPanel == 'left'){
                    activmap_places.css({
                        left: -cont_w,
                        right: 'auto'
                    });
                    activmap_canvas.css({
                        float: 'right'
                    });
                }
                if(s.posPanel == 'right'){
                    activmap_places.css({
                        right: -cont_w,
                        left: 'auto'
                    });
                    activmap_canvas.css({
                        float: 'left'
                    });
                }
            }
            
            //if($('input[name="marker_type[]"]').length) $('input[name="marker_type[]"]').prop('checked',true);
            
            if($('input[name="activmap_radius"]').length){
                $('input[name="activmap_radius"]').prop('checked', false).each(function(){
                    if(s.radius == $(this).val()) $(this).prop('checked', true);
                });
            }
            
            _sort_by_dist = function(a, b){
                return ((a.dist < b.dist) ? -1 : ((a.dist > b.dist) ? 1 : 0));
            }
            _order = function(){
                $.each(s.places, function(i, place){
                    place.dist = _get_distance(place.marker.position, latlng);
                });
                s.places.sort(_sort_by_dist);
                $('.activmap-place').remove();
                $.each(s.places, function(i, place){
                    activmap_places.append(place.html);
                    if(place.isVisible) $('#activmap-place_'+place.id).show();
                });
            }
            
            /* _update_center_marker() modifies the position of the center marker
             * 
             */
            _update_center_marker = function(){
                centerMarker.setPosition(latlng);
                _update_places_bounds();
            }

            _init = function(){

                $.each(s.places, function(i, place){
                    
                    place.num_tags = 0;
                    place.id = i;
					var companyName = '';
					
                    //Marker init
                    var myLatlng = new google.maps.LatLng(place.lat, place.lng);
                    var myIcon = (place.icon != '' && place.icon != undefined) ? place.icon : s.icon;
                    var marker = new google.maps.Marker({
                        map: map,
                        position: myLatlng,
                        icon: myIcon,
                        title: place.title,
                        customId:place.customId
                    });
                    //Info window content building
                    var mycontent;
					//console.log(place.cryptoAcception);
					if(place.img != undefined && place.img != '') 
						mycontent = '<div><div class="merge"><div class="activmap-brand"><img  src="'+place.img+'"></div><div class=""><h4 class="activmap-title">'+place.title+'</h4></div></div>';
					else 
						mycontent = '<div><div class="merge"><h4 class="activmap-title">'+place.title+'</h4></div>';
					if(place.address != undefined && place.address != '') 
					mycontent += '<div class="maddress">'+place.address+'</div>';
					
					
					if(place.url != undefined && place.url != '') 
						mycontent += '<div class="mgloble"><a href="'+place.url+'" target="_blank" class="moreinfo_show">Website</a></div></div>';
                   
					
					
					
					//Info window init
                    infoWindow[i] = new google.maps.InfoWindow({
                        content  : mycontent,
                        position : myLatlng
                    });
                    
                    //Marker click event
                    google.maps.event.addListener(marker, 'click', function(){
                        //console.log(this.customId);

                        $("#orderDisplay tbody").find("tr").removeClass('tr_highlight')
                        $("#orderDisplay tbody").find("tr#customId_"+this.customId).addClass('tr_highlight');    
                        if(opendInfoWindow != null) opendInfoWindow.close();
                        infoWindow[i].open(map, marker);
                        //console.log(marker.title);
                        opendInfoWindow = infoWindow[i];
                        $('.activmap-place').removeClass('active');

                        $('#activmap-place_'+i).addClass('active');
                        activmap_places.scrollTop(activmap_places.scrollTop()+$('#activmap-place_'+i).position().top);
                    });
                    marker.setVisible(false);
                    place.marker = marker;
                    markers.push(marker);

place.html = '<div class="my_sort" style="display: none;">'+place.title+'</div><div class="activmap-place main_result_box" id="activmap-place_'+i+'"><div class="map_dtl_row1"><div id="'+place.uid+'" class="map_dtl_txt"><h3><i class="fa fa-map-marker"></i> '+place.title+'</h3><p><strong>Company Name: </strong>'+companyName+'<br><strong>Email: </strong>'+place.email+'<br><strong>Phone: </strong>'+place.phone+'</p><p>'+place.address+'</p></div></div><div class="more_row moreinfo_show"><a href="'+place.url+'">More Info <i class="fa fa-chevron-right subs-a" style="margin-left:5px;"></i></a></p></div></div>';
                    
                    //Places indexed by tag name (checkbox name)
                    $.each(place.tags, function(j, tag){
                        if(ids[tag] === undefined) ids[tag] = [];
                        ids[tag].push(place.id);
                    }); 
                });
                //Cluster init
                if(s.cluster){
                    markerCluster = new MarkerClusterer(map, markers, {
                        maxZoom: 12,
                        gridSize: 40
                    });
                    markerCluster.setIgnoreHidden(true);
                }
                
                //Center marker init 
                centerMarker = new google.maps.Marker({
                    map: map,
                    position: latlng,
                    icon: (s.center_icon != '' && s.center_icon != undefined) ? s.center_icon : s.icon
                });
                centerMarker.setVisible(true);
                markers.push(centerMarker);
				
                _order();
                
                //Geolocation
                _geolocate = function(){
                    if(navigator.geolocation){
                        browserSupportFlag = true;
                        navigator.geolocation.getCurrentPosition(function(position){
                            initialLocation = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
                            map.setCenter(initialLocation);
                            latlng = initialLocation;
                            _order();
                            $('input[name="marker_type[]"]').each(function(){
                                _update_places_tag($(this));
                            });
                            _update_map();
                        }, function(){
                            handleNoGeolocation(browserSupportFlag);
                        });
                    }else{
                        browserSupportFlag = false;
                        handleNoGeolocation(browserSupportFlag);
                    }
                }

                if(s.autogeolocate == true){
                    _geolocate();
                }
                if($('#activmap-geolocate').length){
                    $('#activmap-geolocate').on('click', function(){
                        _geolocate();
                    });
                }

                //Geolocation error handler
                function handleNoGeolocation(errorFlag){
                    if(errorFlag == true){
                        console.log('Geolocation service failed.');
                        initialLocation = latlng;
                    }else{
                        console.log('Your browser doesn\'t support geolocation.');
                        initialLocation = latlng;
                    }
                    map.setCenter(initialLocation);
                }
                
                if($('#activmap-location').length){
                    if(s.country !== null){
                        var options = {
                           types: ['address'],
                           componentRestrictions: {country: s.country}
                        };
                    }else{
                        var options = {
                           types: ['address']
                        };
                    }
                    var input = document.getElementById('activmap-location');
                    autocomplete = new google.maps.places.Autocomplete(input,  {});					
                
                    google.maps.event.addListener(autocomplete, 'place_changed', function(){
                        var place = autocomplete.getPlace();
						latlng = place.geometry.location;
						console.log(place);
					
                        //if($('.activmap-place').length) _order();
                        $('input[name="marker_type[]"], select[name="marker_type[]"]').each(function(){
                            _update_places_tag($(this), false);
                        });
                        _update_center_marker();
                        bounds = map.getBounds();
                        _update_map();//
                    });
                }
				$("#activmap-loc").on('click',function(){
					
                        if($('.activmap-place').length) _order();
                        $('input[name="marker_type[]"], select[name="marker_type[]"]').each(function(){
                            _update_places_tag($(this), true);
                        });
                        _update_center_marker();
                        //bounds = map.getBounds();
                        _update_map();
				});
                
                //Radius change event
                $('input[name="activmap_radius"]').on('change', function(){
                    s.radius = $(this).val();
                    $('input[name="marker_type[]"]').each(function(){
                        _update_places_tag($(this));
                    });
                    _update_map();
                });

                //Filter change event
                $('input[name="marker_type[]"]').on('change', function(){
                    _update_places_tag($(this));
                    _update_map();
                });

                //Reset click event
                $('#activmap-reset').on('click', function(){
                    $('input[name="marker_type[]"]').prop('checked',false);
                    $('input[name="marker_type[]"]').each(function(){
                        _update_places_tag($(this));
                    });
					$('#activmap-location').val('');
                    _update_map();
                    return false;
                });
                
                //Place click event
                $(document).on('click', '.activmap-place', function(){
                    var id = $(this).attr('id').replace('activmap-place_','');
                    google.maps.event.trigger(markers[id], 'click');
                });
                
                //Window resize event
                $(window).on('resize', function(){
                    _update_map();
                });
                
                $('input[name="marker_type[]"]:checked').each(function(){
                    _update_places_tag($(this));
                });
                _update_map();
            }
            
            _rad = function(a){
                return a * Math.PI / 180;
            }

            /* _getDistance() returns the distance between 2 points in meters
             * 
             */
            _get_distance = function(p1, p2){
                var R = 6378137;
                var dLat = _rad(p2.lat() - p1.lat());
                var dLong = _rad(p2.lng() - p1.lng());
                var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                    Math.cos(_rad(p1.lat())) * Math.cos(_rad(p2.lat())) *
                    Math.sin(dLong / 2) * Math.sin(dLong / 2);
                var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                var d = R * c;
                return d;
            }
            
            /* _update_map() hides or shows the places panel. Shrinks, enlarges and refresh the map
             * 
             */
            _update_map = function(){
                map_w = $('#activmap-wrapper').width();
                if(num_places > 0){
                    //results found
                    if(old_results == 0){
                        //no previous result
                        //side panel displaying for 1st time => shows places
                        if(s.showPanel){
                            if(s.posPanel == 'left'){
                                activmap_places.stop(true,true).animate({
                                    left: 0
                                },600);
                            }
                            if(s.posPanel == 'right'){
                                activmap_places.stop(true,true).animate({
                                    right: 0
                                },600);
                            }
                            //side panel is visible on screen device only => shrinks map
                            if(activmap_places.is(':visible')){
                                activmap_canvas.animate({
                                    width: map_w-cont_w
                                },600, function(){
                                    //update of map's bounds
                                    map.fitBounds(bounds);
                                    if(s.cluster) markerCluster.repaint();
                                });
                            }else{
                                map.fitBounds(bounds);
                                if(s.cluster) markerCluster.repaint();
                            }
                        }else{
                            map.fitBounds(bounds);
                            if(s.cluster) markerCluster.repaint();
                        }
                    }else{
                        if(s.showPanel && activmap_places.is(':visible')) activmap_canvas.width(map_w-cont_w);
                        else activmap_canvas.width(map_w);
                        map.fitBounds(bounds);
                        if(s.cluster) markerCluster.repaint();
                    }
                }else{
                    //no result found
                    if(opendInfoWindow != null) opendInfoWindow.close();
                    if(s.showPanel){
                        if(activmap_places.is(':visible')){
                            //there were previous results
                            //side panel is visible on screen device only => hides places, enlarges map
                            activmap_canvas.animate({
                                width: map_w
                            },600);
                            if(s.posPanel == 'left'){
                                 activmap_places.animate({
                                    left: -cont_w
                                },600);
                            }
                            if(s.posPanel == 'right'){
                                 activmap_places.animate({
                                    right: -cont_w
                                },600);
                            }
                        }else
                            activmap_canvas.width(map_w);
                    }else
                        activmap_canvas.width(map_w);
                    
                    if(s.cluster) markerCluster.repaint();
                    map.setZoom(s.zoom);
                    map.setCenter(latlng);
                }
                var listener = google.maps.event.addListener(map, 'idle', function(){ 
                    if(map.getZoom() > 16) map.setZoom(16);
                    google.maps.event.removeListener(listener);
                });
                old_results = num_places;
            }
            
            /* _map_resize() updates bounds and clusters on map resize
             * 
             */
            _map_resize = function() {
                google.maps.event.trigger(map, 'resize');
                
                var listener = google.maps.event.addListenerOnce(map, 'idle', function(){ 
                    if(map.getZoom() > 16) map.setZoom(16);
                });
                
                if(num_places > 0){
                    map.fitBounds(bounds);
                    var padbnds = _paddedBounds(10, 150, 50, 50);
                    map.fitBounds(padbnds);
                    if(s.cluster) markerCluster.repaint();
                }else{
                    map.setZoom(s.zoom);
                    map.setCenter(latlng);
                }
            }
            
            /* _update_places_bounds() updates map bounds according to visible places
             * 
             */
            _update_places_bounds = function(){
                bounds = new google.maps.LatLngBounds();
                var i = 0;
                $.each(s.places, function(j, place){
                    if(place.isVisible == true){
                        bounds.extend(place.marker.getPosition());
                        i++;
                    }
                });
                bounds.extend(centerMarker.getPosition());
                num_places = i;
            }
            
            /* _update_places_tag(input) updates the array of places and the map's bounds
             * 
             * @param input checkbox object
             * 
             */
            _update_places_tag = function(input){
                var val;
                var i = 0;
                var p_ids = [];
                var ids_copy = [];
                $('input[name="marker_type[]"]:checked').each(function(){
                    val = $(this).val();
                    if(ids[val] === undefined) ids[val] = [];
                    if(i == 0) p_ids = $.merge([], ids[val]);
                    else{
                        if(s.request == 'strict') p_ids = $.arrayIntersect(ids[val], p_ids);
                        if(s.request == 'large'){
                            ids_copy = $.merge([], ids[val]);
                            p_ids = $.merge(ids_copy, p_ids);
                        }
                    }
                    i++;
                });
                $.each(s.places, function(j, place){
                    place.num_tags = 0;
                    place.dist = 0;
                    if($.inArray(place.id, p_ids) >= 0){
                        place.dist = _get_distance(place.marker.position, latlng);
                        //the place is in all tags => set visible
                        if(s.radius == 0 || place.dist <= s.radius*1000){
                            place.num_tags++;
                            place.marker.setVisible(true);
                            place.isVisible = true;
                            $('#activmap-place_'+place.id).show();
                        }else{
                            //perform only if a checkbox is clicked
                            if(place.num_tags > 0) place.num_tags--;
                            if(place.num_tags == 0){
                                place.marker.setVisible(false);
                                place.isVisible = false;
                                $('#activmap-place_'+place.id).hide();
                            }
                        }
                    }else{
                        //perform only if a checkbox is clicked
                        if(place.num_tags > 0) place.num_tags--;
                        if(place.num_tags == 0){
                            place.marker.setVisible(false);
                            place.isVisible = false;
                            $('#activmap-place_'+place.id).hide();
                        }
                    }
                });
                    
                
                //update of map's bounds
                bounds = new google.maps.LatLngBounds();
                var i = 0;
                $.each(s.places, function(j, place){
                    if(place.isVisible == true){
                        bounds.extend(place.marker.getPosition());
                        i++;
                    }
                });
                num_places = i;
                $('#activmap-results-num').html(i+' result(s)');
            }

            if(!Array.isArray(s.places)){
                $.ajax({
                    url: s.places,
                    dataType: 'json',
                    cache: false,
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR);
                        console.log(textStatus);
                        console.log(errorThrown);
                    },
                    success: function(data){
                        var obj = eval(data);
                        s.places = obj.places;
                        _init();
                    }
                });
            }else
                _init();
        }
    });
$("#orderDisplay").find("tbody").find('tr').on('click',function(){
    var customIdTr = $(this).data('custom-id');
    //console.log(customIdTr);
    $.each(markers,function(index,value){
        if(value.customId!=undefined && value.customId == customIdTr){
            google.maps.event.trigger(markers[index], 'click');
        }
    });
});

})(jQuery);