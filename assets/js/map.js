mapoverlay = Array();
var markers = [];
var geocoder = null;
var map;
var dragst=0;



function initialize() {
	if (GBrowserIsCompatible()) {
		
		var mapOptions = {    
			googleBarOptions : {      
				style : "new",      
				adsOptions: {        
					client: "partner-google-maps-api",        
					channel: "AdSense for Search channel",        
					adsafe: "high",        
					language: "en"      
				}    
			} 
		}
		
		
		map = new GMap2(document.getElementById("map_canvas"),mapOptions); 
		map.setUIToDefault();
		map.setMapType(G_PHYSICAL_MAP );
		map.enableScrollWheelZoom();
		map.setCenter(new GLatLng(14.039340627573987,100.65811157226562),7);
		var lat = document.getElementById('txt_lat').value;
		var lon = document.getElementById('txt_lon').value;
		
//		document.getElementById('show_lat').innerHTML = lat;
//		document.getElementById('show_lon').innerHTML = lon;
		document.getElementById('txt_lat').value   = lat;
		document.getElementById('txt_lon').value  = lon;
		
		lat = document.getElementById('txt_lat').value;
		lon = document.getElementById('txt_lon').value;
		
		if(lat!="" && lon!=""){
			//alert(lat+','+lon);
			var latlng = new GLatLng(lat, lon);
			var opts = {draggable:true};
			marker = new GMarker(latlng, opts);
			map.addOverlay(marker);
			map.panTo(latlng);
			GEvent.addListener(marker, 'dragend', function(latlng) {				
				map.panTo(latlng);
				var lat = latlng.lat();
			    var lon = latlng.lng();
				
//			    document.getElementById('show_lat').innerHTML = lat;
//			    document.getElementById('show_lon').innerHTML = lon;
			    document.getElementById('txt_lat').value = lat;
			    document.getElementById('txt_lon').value = lon;	
				
			  });
			  if(latlng){
//                                document.getElementById('show_lat').innerHTML = lat;
//			    	document.getElementById('show_lon').innerHTML = lon;
			  }
		}
		
		
		geocoder = new GClientGeocoder();
		map.enableGoogleBar();
		GEvent.addListener(map, 'click', function(overlay, latlng) { 
		  if(latlng){   
		  	  
			  var lat = latlng.lat();
			  var lon = latlng.lng();
			  var point = new GLatLng(lat, lon);
			  var opts = {draggable:true};
	
			  marker = new GMarker(point,opts);
			  var  p_arr = markers.push(marker);
			  thispoint = p_arr-1;
			  if(p_arr > 1){
			   markers[p_arr].remove();
			  }
              
			  //alert(lat+','+lon);
//                          document.getElementById('show_lat').innerHTML = lat;
//			  document.getElementById('show_lon').innerHTML = lon;
			  document.getElementById('txt_lat').value = lat;
			  document.getElementById('txt_lon').value = lon;
			  GEvent.addListener(marker, 'dragend', function(latlng) {				
				map.panTo(latlng);
				var lat = latlng.lat();
			    var lon = latlng.lng();
				//alert(lat+','+lon);
//			    document.getElementById('show_lat').innerHTML = lat;
//			    document.getElementById('show_lon').innerHTML = lon;
			    document.getElementById('txt_lat').value = lat;
			    document.getElementById('txt_lon').value = lon;	
				
			  });
			  
			  dragst = 0;
			  map.addOverlay(marker);
			  map.panTo(point);  
			}
		});
	 }
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