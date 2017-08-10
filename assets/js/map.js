mapoverlay = Array();
var markers = [];
var geocoder = null;
var map;



function initialize() {

		var myLatlng = new google.maps.LatLng(13.0934384,101.4286521);
		var myOptions = {
			zoom: 9,
			center: myLatlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		}

		map = new google.maps.Map(document.getElementById("map_canvas"),myOptions);

			// Create the search box and link it to the UI element.
		        var input = document.getElementById('pac-input');
		        var searchBox = new google.maps.places.SearchBox(input);
		        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

		        // Bias the SearchBox results towards current map's viewport.
		        map.addListener('bounds_changed', function() {
		          searchBox.setBounds(map.getBounds());
		        });

				var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          // Clear out the old markers.
					var  p_arr = markers.push(marker);
					if(p_arr >= 1){
						for (var i = 0; i < p_arr; i++) {
							markers[i].setMap(null);
						}
					}
          /*markers.forEach(function(marker) {
            marker.setMap(null);
          });*/

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }

            // Create a marker for each place.
						marker = new google.maps.Marker({
              map: map,
							draggable:true,
              title: place.name,
              position: place.geometry.location
            });
            markers.push(marker);
						var lat = marker.position.lat();
		      	var lon = marker.position.lng();
						console.log(lat+','+lon);
					  document.getElementById('txt_lat').value = lat;
					  document.getElementById('txt_lon').value = lon;
						google.maps.event.addListener(marker, 'dragend', function(latlng) {
							var lat = marker.position.lat();
			      	var lon = marker.position.lng();
						  document.getElementById('txt_lat').value = lat;
						  document.getElementById('txt_lon').value = lon;
						});
            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
        });

		var lat = document.getElementById('txt_lat').value;
		var lon = document.getElementById('txt_lon').value;

		if(lat!="" && lon!=""){
			//alert(lat+','+lon);
			//console.log(lat+','+lon);
			var latlng = new google.maps.LatLng(lat, lon);
			marker = new google.maps.Marker({position: latlng,draggable:true, map: map});

			google.maps.event.addListener(marker, 'dragend', function(latlng) {
				var lat = marker.position.lat();
      	var lon = marker.position.lng();
			  document.getElementById('txt_lat').value = lat;
			  document.getElementById('txt_lon').value = lon;
			});

		}

		google.maps.event.addListener(map, 'click', function(latlng) {
		  if(latlng){
				var  p_arr = markers.push(marker);
				console.log('p_arr:'+p_arr);
				if(p_arr >= 1){
					for (var i = 0; i < p_arr; i++) {
						markers[i].setMap(null);
						console.log('setMap null');
					}
			  }

				//console.log('latlng:'+latlng.latLng.lat());
				var lat = latlng.latLng.lat();
				var lon = latlng.latLng.lng();
				document.getElementById('txt_lat').value = lat;
				document.getElementById('txt_lon').value = lon;
				var latlng = new google.maps.LatLng(lat, lon);
			  marker = new google.maps.Marker({position: latlng,draggable:true, map: map});

				google.maps.event.addListener(marker, 'dragend', function(latlng) {
					var lat = marker.position.lat();
	      	var lon = marker.position.lng();
				  document.getElementById('txt_lat').value = lat;
				  document.getElementById('txt_lon').value = lon;
				});

			}
		});
}


function sendVar(){
  opener.document.getElementById('latitude').value = document.getElementById('txt_lat').value;
  opener.document.getElementById('longitude').value = document.getElementById('txt_lon').value;
  window.close();
}

function resetMaps(){
	map.removeOverlay(marker);
	markers = [];
//	document.getElementById('show_lat').innerHTML = '';
//	document.getElementById('show_lon').innerHTML = '';
	document.getElementById('txt_lat').value = '';
	document.getElementById('txt_lon').value = '';
	//initialize();
}
$( document ).ready(function() {
    initialize();
});
