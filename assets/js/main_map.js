var styles = [{
        url: 'http://122.155.197.104/sysdamrongdham/assets/images/pin-map.png',
        height: 48,
        width: 30,
        anchor: [-18, 0],
        textColor: '#ffffff',
        textSize: 10,
        iconAnchor: [15, 48]
      }];
function addlayerXML(obj){
 var url = obj.value;
if(!xml[url]){
    downloadUrl(url, function(data) {
      xml[url] = data;
      all_markers[url] = [];
      all_polygons[url] = Array();
      all_polygonMap[url] = Array();
        var markers = data.documentElement.getElementsByTagName("marker");

      for (var i = 0; i < markers.length; i++) {
        var latlng = new google.maps.LatLng(parseFloat(markers[i].getAttribute("lat")),
                    parseFloat(markers[i].getAttribute("lng")));
        all_markers[url][i] = createMarker(markers[i].getAttribute("name"), markers[i].getAttribute("identify"), markers[i].getAttribute("icon"), latlng,250,150);
        if(markers[i].getAttribute("shape")){
            var plarr = markers[i].getAttribute("shape").split(" ");
            //alert(plarr);
            for(var is=0;is<plarr.length;is++){
              var pll = plarr[is].split(',');
              //alert(pll);
              all_polygons[url][is] = new google.maps.LatLng(parseFloat(pll[1]), parseFloat(pll[0]));
            }
            //alert(markers[i].getAttribute("shape_color"));
            all_polygonMap[url] = new google.maps.Polygon({
              paths: all_polygons[url],
              strokeColor: '#DF780A',
              strokeOpacity: 0.8,
              strokeWeight: 0.7,
              fillColor: markers[i].getAttribute("shape_color"),
              fillOpacity: markers[i].getAttribute("shape_opacity")
            });

            //addpolygon(all_polygonMap[obj.name]);
            all_polygonMap[url].setMap(map);
        }
       }
     });

      //markerClusterer = new MarkerClusterer(map, all_markers[url]);
}else{
  if(obj.checked){
      addpoint(all_markers[url]);
      if(all_polygons[url].length>0){
        addpolygon(all_polygonMap[url]);
      }
      //all_polygonMap[obj.name].setMap(map);
  }else{
      removepoint(all_markers[url]);
      if(all_polygons[url].length>0){
        removepolygon(all_polygonMap[url]);
      }

  }
}
}
