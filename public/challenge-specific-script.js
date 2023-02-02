
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
onTheSpot.addEventListener('click', async () => {
    navigator.geolocation.getCurrentPosition(getUserLocation);
})

onTheSpot.addEventListener('mouseover', () => {
    onTheSpot.style.cursor = 'pointer';
})

const getUserLocation = async (position) => {
    userLoc.lat = await position.coords.latitude;
    userLoc.lng = await position.coords.longitude
    resultMsg.innerText = '';
    let challengeAchieved = await didUserPassChallenge();
    if(!challengeAchieved) {
        resultMsg.innerText += 'Sorry you didn\'t meet the conditions needed to achieve the challenge';
        return;
    } else {
        //USER ACHIEVED CHALLENGE SO TRY TO UPDATE THE DB
        let dbUpdated = await addResultToDB();
        console.log(dbUpdated);
        //Then display msg to user..
        resultMsg.innerText += dbUpdated.msg;
    }
}

const didUserPassChallenge = async () => {
    let place = new google.maps.LatLng(
        placeLoc.lat,
        placeLoc.lng
    );
    let user = new google.maps.LatLng(
        userLoc.lat,
        userLoc.lng
    );
    let dist = google.maps.geometry.spherical.computeDistanceBetween(place, user);
    resultMsg.innerHTML = `Your distance from the place is ${dist} metres. <br>`;
    //CONDITIONS WILL ALSO NEED TO BE PASSED ONCE ADDED TO DB..FOR NOW.. Set to true by default....
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


