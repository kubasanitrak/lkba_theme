<?php 

$GMAP_API_KEY = get_field( 'gmap_api_key' );
$LAT = get_field( 'gmap_lang' );
$LNG = get_field( 'gmap_long' );

?>
<!-- START CUSTOM MAP -->
<!-- <div class="lazyload" data-theme="dark" id="mapcontainerID" > -->
	<div class="map-container iframe-container lazyload">
		<div class="overlay" onclick="style.pointerEvents='none'"></div>
		<div id="map" class="map-cont"></div>
		<script>
			var map;
			let _LAT = '<?php echo $LAT; ?>',
				_LNG = '<?php echo $LNG; ?>';

				_LAT = parseFloat(_LAT);
				_LNG = parseFloat(_LNG);
			function initMap() {
			map = new google.maps.Map(document.getElementById('map'), {
				center: {lat: _LAT, lng: _LNG},
				zoom: 18,
				zoomControl: true,
				mapTypeControl: false,
				scaleControl: false,
				streetViewControl: false,
				rotateControl: false,
				fullscreenControl: false,
				styles: [{"elementType": "geometry", "stylers": [{"color": "#2a2a27"} ] }, {"elementType": "labels.icon", "stylers": [{"visibility": "off"} ] }, {"elementType": "labels.text.fill", "stylers": [{"color": "#757575"} ] }, {"elementType": "labels.text.stroke", "stylers": [{"visibility": "off"} ] }, {"featureType": "administrative", "elementType": "geometry", "stylers": [{"color": "#757575"} ] }, {"featureType": "administrative.country", "elementType": "labels.text.fill", "stylers": [{"color": "#9e9e9e"} ] }, {"featureType": "administrative.land_parcel", "stylers": [{"visibility": "off"} ] }, {"featureType": "administrative.locality", "elementType": "labels.text.fill", "stylers": [{"color": "#bdbdbd"} ] }, {"featureType": "poi", "elementType": "labels.text.fill", "stylers": [{"color": "#757575"} ] }, {"featureType": "poi.business", "stylers": [{"visibility": "off"} ] }, {"featureType": "poi.park", "elementType": "geometry", "stylers": [{"color": "#27271F"} ] }, {"featureType": "poi.park", "elementType": "labels.text", "stylers": [{"visibility": "off"} ] }, {"featureType": "poi.park", "elementType": "labels.text.fill", "stylers": [{"color": "#616161"} ] }, {"featureType": "poi.park", "elementType": "labels.text.stroke", "stylers": [{"visibility": "off"} ] }, {"featureType": "road", "elementType": "geometry.fill", "stylers": [{"color": "#323B37"} ] }, {"featureType": "road", "elementType": "labels.text.fill", "stylers": [{"color": "#8a8a8a"} ] }, {"featureType": "road.arterial", "elementType": "geometry", "stylers": [{"color": "#384B3F"} ] }, {"featureType": "road.highway", "elementType": "geometry", "stylers": [{"color": "#384B3F"} ] }, {"featureType": "road.highway.controlled_access", "elementType": "geometry", "stylers": [{"color": "#4e4e4e"} ] }, {"featureType": "road.local", "elementType": "labels.text.fill", "stylers": [{"color": "#616161"} ] }, {"featureType": "transit", "elementType": "labels.text.fill", "stylers": [{"color": "#757575"} ] }, {"featureType": "water", "elementType": "geometry", "stylers": [{"color": "#25251F"} ] }, {"featureType": "water", "elementType": "labels.text.fill", "stylers": [{"color": "#384B3F"} ] } ]

				// #2a2a27
			});
			var image = '<?php echo get_template_directory_uri(); ?>' +'/assets/images/NIVB-map-marker.png';
			var MAPMarker = new google.maps.Marker({
				position: {lat: _LAT, lng: _LNG},
				map: map,
				icon: image
			});
			}
	    </script>
		<script src="https://maps.googleapis.com/maps/api/js?key=<?=$GMAP_API_KEY;?>&callback=initMap" async defer></script>
	</div>
<!-- </div> -->
<!-- END CUSTOM MAP -->