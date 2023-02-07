
const getLocationBtn = document.getElementById('get-location');
let userCoords = {};
const maxDistance = 1000; //METRES - places further from user will not show on map
let resultMessageContainer = document.getElementById('resultMessageContainer');

window.onload = function () {
    //Check if browser supports geolocation......
    if (navigator.geolocation) {
        console.log('Geolocation is supported!');
    } else {
        console.log('Geolocation is not supported for this Browser/OS.');
        return
    }
}

getLocationBtn.addEventListener('mouseover', () => {
    getLocationBtn.style.cursor = 'pointer';
})


getLocationBtn.addEventListener('click', async () => {
    navigator.geolocation.getCurrentPosition(getUserLocation);
})

const getUserLocation = async (position) => {
    userCoords.latitude = await position.coords.latitude;
    userCoords.longitude = await position.coords.longitude;
    let dbPlaces = await getExistingPlacesFromDB();
    resetPreviousResults();
    if(getPlacesWithinDist(dbPlaces, maxDistance)) {
        reConfigureMapSettings();
        initMap();
    } else {
        resultMessageContainer.textContent += 
        `Sorry there are no available places within ${maxDistance} KM of your location. `;
        return;
    }
}

const resetPreviousResults = () => {
    resultMessageContainer.textContent = '';
    mapMarkers = [];
}

const getExistingPlacesFromDB = async () => {
    try {
        let data = new FormData();
        data.append('get_place_coords', true);
        //Fetch request will go to home controller on Server....
        let res = await fetch('index.php?action=home', {
            method: 'POST',
            body: data
        });
        return await res.json();
    } catch (err) {
        console.log(err);
    }
}

const reConfigureMapSettings = () => {
    mapOptions.zoom = 14;
    mapOptions.center =  {
            lat: userCoords.latitude ?? 37.53622850959400,
            lng: userCoords.longitude ?? 126.894975568805080
    };
}


const getPlacesWithinDist = (places, maxDistance) => {
    let userGMap = new google.maps.LatLng(
        userCoords.latitude,
        userCoords.longitude
    );
    for(let i=0; i<places.length; i++) {
        let place = new google.maps.LatLng(
            places[i].latitude, 
            places[i].longitude
        );
        let dist = google.maps.geometry.spherical.computeDistanceBetween(place, userGMap);
        if(dist < maxDistance) {
            resultMessageContainer.textContent += 
            `${places[i]['name']}: ${(dist / 1000).toFixed(2)} KM from your location. `;
            mapMarkers.push(
                {
                'name': places[i]['name'],
                'lat': parseFloat(places[i]['latitude']),
                'lng': parseFloat(places[i]['longitude'])
                }
            );
        }
    }
    if(mapMarkers.length === 0 ) {
        return false
    } else {
        return true;
    }
}
  

