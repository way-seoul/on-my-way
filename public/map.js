
//TO LOAD GOOGLE MAP, THIS PAGE MUST RECEIVE THE FOLLOWING VARIABLES!
// mapOptions =  { zoom: xxx, center: {lat: xx, lng: xx}}
// mapMarkers =  [{'name': xxx, 'lat': xxx, 'lng': xxx}]

//Google Map API show multiple locations on one map
function initMap() {
    // The map, centered at wcoding
    const map = new google.maps.Map(document.getElementById("map"), mapOptions);
    setMarkers(map);
}

function setMarkers(map) {
    for (let i = 0; i < mapMarkers.length; i++) { 
        let marker = mapMarkers[i];
        console.log(mapMarkers);
        new google.maps.Marker({
        position: {lat: marker.lat, lng: marker.lng},
        map: map
        });
    }
}

window.initMap = initMap;
