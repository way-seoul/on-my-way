
const getLocationBtn = document.getElementById('get-location');
//DIST IN METRES - places further from user location  will not show on map
const maxDistance = 1000;
const onTheSpot = document.getElementById('onspot');
const resultMsg = document.getElementById('result-message-container');
let userLoc = {};

window.onload = function () {
    //Check if browser supports geolocation......
    if (navigator.geolocation) {
        console.log('Geolocation is supported!');
    } else {
        console.log('Geolocation is not supported for this Browser/OS.');
        return
    }
}

function initMap() {

map = new google.maps.Map(document.getElementById("map"), {
    center: placeLoc,
    zoom: 15,
    disableDefaultUI: true,
    zoomControl: false,
});

const marker = new google.maps.Marker({
    position: placeLoc,
    map: map,
    title: "Port Dodong"
});

}

window.initMap = initMap;

const getUserLocation = async (position) => {
    userLoc.lat = await position.coords.latitude;
    userLoc.lng = await position.coords.longitude
    let challengeAchieved = await didUserPassChallenge();
    if(!challengeAchieved) {
        resultMsg.innerText += 'Sorry you didn\'t meet the conditions needed to achieve the challenge';
        return;
    }
    //USER ACHIEVED CHALLENGE SO TRY TO UPDATE THE DB
    let dbUpdated = await addResultToDB();
    console.log(dbUpdated);
    //Then display msg to user..
    resultMsg.innerText += dbUpdated.msg;
}

const didUserPassChallenge = async () => {
    console.log(placeLoc.lat, placeLoc.lng);
    let place = new google.maps.LatLng(
        placeLoc.lat,
        placeLoc.lng
    );
    console.log(userLoc.lat, userLoc.lng);
    let user = new google.maps.LatLng(
        userLoc.lat,
        userLoc.lng
    );
    //Returns Distance In Meters
    let dist = google.maps.geometry.spherical.computeDistanceBetween(place, user);
    console.log('THE DISTANCE IN METRES IS : ', dist);
    resultMsg.innerHTML = `Your distance from the place is ${dist} metres. <br>`;
    //CONDITIONS WILL ALSO NEED TO BE PASSED ONCE ADDED TO DB
    //FOR NOW.. Set to true by default....
    let conditions = true;
    if(dist <= maxDistance && conditions) {
        return true;
    } else {
        return false;
    }
}

const addResultToDB = async () => {
    //PREP DATA
    let data = new FormData();
    data.append('challengeAchieved', true);
    data.append('userID', userID);
    data.append('challID', challID);
    data.append('score', score)
    console.log(data);
    //MAKE REQ TO SERVER
    try {
        let res = await fetch('index.php?action=challenge-specific', {
                method: 'POST',
                body: data 
        });
        let resjson = await res.json();
        return resjson;
    } catch (err) {
        console.log(err);
    }
}

onTheSpot.addEventListener('click', async () => {
    navigator.geolocation.getCurrentPosition(getUserLocation);
})

onTheSpot.addEventListener('mouseover', () => {
    onTheSpot.style.cursor = 'pointer';
})
