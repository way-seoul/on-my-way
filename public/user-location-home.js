
const getLocationBtn = document.getElementById('get-location');
let userCoords = {};
//DIST IN METRES - places further from user location  will not show on map
const maxDistance = 10000;
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

//GOOGLE MAP CODE - immediately called from google API script
function initMap() {
    // The map, centered at wcoding
    const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 16,
    center: {
        lat: userCoords.latitude ?? 37.53622850959400,
        lng: userCoords.longitude ?? 126.894975568805080
    },
    });
}

window.initMap = initMap;

const getUserLocation = async (position) => {
    userCoords.latitude = await position.coords.latitude;
    userCoords.longitude = await position.coords.longitude;
    console.log(userCoords);
    let placeCoords = await getExistingPlaceCoordsFromDB();
    await insertClosePlacesOnMap(placeCoords, maxDistance);
}

const getExistingPlaceCoordsFromDB = async () => {
    try {
        //Fetch request will go to home controller on Server....
        let res = await fetch('index.php?get_place_coords', {
            method: 'GET'
        });
        let places = await res.json();
        return places;
    } catch (err) {
        console.log(err);
    }
}

const insertClosePlacesOnMap = async (places, maxDistance) => {
    let user = new google.maps.LatLng(
        userCoords.latitude,
        userCoords.longitude
    );
    let mapOptions = {
        zoom: 14,
        center: {
            lat: userCoords.latitude ?? 37.53622850959400,
            lng: userCoords.longitude ?? 126.894975568805080
        },
    }
    let map = new google.maps.Map(document.getElementById("map"), mapOptions);
    //Insert User Location On Map
    let userLocMarker = new google.maps.Marker(
        {
            position: user,
            title: 'My Location'
        }
    );
    userLocMarker.setMap(map);
    if(places.length === 0 ) {
        resultMessageContainer.textContent = `No places found within ${maxDistance} of your location`;
        return;
    } else {
        resultMessageContainer.textContent += 
        `${places.length} places found within ${maxDistance / 1000} KM of your location. `;
        for(let i=0; i<places.length; i++) {
            console.log(i);
            let place = new google.maps.LatLng(
                places[i].latitude, 
                places[i].longitude
            );
            //Returns Distance In Meters
            let dist = google.maps.geometry.spherical.computeDistanceBetween(place, user);
            console.log('THE DISTANCE IN METRES IS : ', dist);
            resultMessageContainer.textContent += 
            `${places[i]['name']}: ${(dist / 1000).toFixed(2)} KM from your location. `;
            if(dist < maxDistance) {
                let myLatlng = new google.maps.LatLng(
                    parseFloat(places[i]['latitude']),
                    parseFloat(places[i]['longitude'])
                );
                let marker = new google.maps.Marker(
                    {
                        position: myLatlng,
                        title: places[i]['name']
                    }
                );
                marker.setMap(map);
            }
        }

    }
}

getLocationBtn.addEventListener('mouseover', () => {
    getLocationBtn.style.cursor = 'pointer';
})


getLocationBtn.addEventListener('click', async () => {
    navigator.geolocation.getCurrentPosition(getUserLocation);
})
  

