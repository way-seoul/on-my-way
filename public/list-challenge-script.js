const locations = document.querySelectorAll('span');

for (let location of locations) {
    location.addEventListener("click", (e) => {
        let clicked_placeId = e.currentTarget.getAttribute('data-placeid');
        reConfigureMapSettings(
            parseFloat(placesById[clicked_placeId].latitude), 
            parseFloat(placesById[clicked_placeId].longitude)
        )
        
        initMap(true); // true will stop the map to refresh markers
    })
}

const reConfigureMapSettings = (latitude, longitude) => { // duplicated from user-location-home.js
    mapOptions.zoom = 14;
    mapOptions.center =  {
            lat: latitude,
            lng: longitude
    };
}
