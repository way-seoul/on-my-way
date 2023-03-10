
//-------------------------------------------------------//
//This code is re-used across each page using the GMAP API
//For the page to work ensure the following variables are made available in the global scope:
//mapOptions =  { zoom: xxx, center: {lat: xx, lng: xx}}
//mapMarkers =  [{'name': xxx, 'lat': xxx, 'lng': xxx}, etc, etc]
//-------------------------------------------------------//

if( typeof mapBound == "undefined" ) {
    mapBound = false;
}
// console.log(mapBound);

function initMap(bool) { // there'll be no arguments from API call
    const map = new google.maps.Map(document.getElementById("map"), mapOptions);
    setMarkers(map, bool); // then false will be delivered
}


function setMarkers(map, bool) {
    let bounds = new google.maps.LatLngBounds();

    for (let i = 0; i < mapMarkers.length; i++) { 
        let marker = mapMarkers[i];
        new google.maps.Marker({
            position: {lat: marker.lat, lng: marker.lng},
            map: map,
            title: 'Location: ' + marker.name
        });
        bounds.extend(mapMarkers[i]);
    }

    // do this only when list-challenges page is on load
    if(!bool && mapBound) map.fitBounds(bounds); // this is to fit in all markers created on the map
}

