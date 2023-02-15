
const onTheSpot = document.getElementById('onspot');
const resultMsg = document.getElementById('result-message-container');
let userLoc = {};

console.log(userCompleteChallenge);

window.onload = function () {
    //Check if browser supports geolocation......
    if (navigator.geolocation) {
        console.log('Geolocation is supported!');
    } else {
        console.log('Geolocation is not supported for this Browser/OS.');
        return
    }
    if(userCompleteChallenge != 0) {
        resultMsg.innerText += 'You\'ve already completed the challenge! Try another one!';
        onTheSpot.style.display = 'none';
    }
    body.style.visibility = 'visible';
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
    let userPassedChall = await didUserPassChallenge();
    resultMsg.innerText = '';
    if(userPassedChall) {
        let dbUpdated = await addResultToDB();
        console.log(dbUpdated);
        resultMsg.innerText += dbUpdated.msg;
        resultMsg.innerText += '.\nYou just completed this challenge! Now try a different one!';
        onTheSpot.style.display = 'none';
    } else {
        resultMsg.innerText += 'Sorry you didn\'t meet the conditions needed to achieve the challenge';
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
    console.log('MAX DIST', maxDistance);
    console.log('userDist from loc', dist, typeof dist);
    if((dist <= maxDistance) && conditions) {
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


