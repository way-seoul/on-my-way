
const onTheSpot = document.getElementById('onspot');
const completedMsg = document.getElementById('completed-container');
const resultMsg = document.getElementById('result-message-container');
const loadingImg = document.getElementById('loading-container');
const popupBg = document.getElementsByClassName('popup-dim')[0];
const popupClose = document.querySelector(".popup-box button");
let userLoc = {};

console.log(userCompleteChallenge);
console.log(maxDistance);

window.onload = function () {
    //Check if browser supports geolocation......
    if (navigator.geolocation) {
        console.log('Geolocation is supported!');
    } else {
        console.log('Geolocation is not supported for this Browser/OS.');
        return
    }
    if(userCompleteChallenge != 0) {
        completedMsg.innerHTML = '<hr><img src="https://www.onlygfx.com/wp-content/uploads/2018/04/completed-stamp-3.png" alt="completed-img" height="150"></img>';
        onTheSpot.style.display = 'none';
    }
    body.style.visibility = 'visible';
}

onTheSpot.addEventListener('click', async () => {
    popupBg.style.display = "block";
    loadingImg.innerHTML = '<img src="https://media.tenor.com/UnFx-k_lSckAAAAM/amalie-steiness.gif" alt="loading" class="loading-img">'
    navigator.geolocation.getCurrentPosition(getUserLocation);
})

onTheSpot.addEventListener('mouseover', () => {
    onTheSpot.style.cursor = 'pointer';
})

const getUserLocation = async (position) => {
    userLoc.lat = await position.coords.latitude;
    userLoc.lng = await position.coords.longitude
    resultMsg.innerText = '';
    let userPassedChall = await didUserPassChallenge();
    if(userPassedChall) {
        let dbUpdated = await addResultToDB();
        console.log(dbUpdated);
        resultMsg.innerHTML += dbUpdated.msg;
        onTheSpot.style.display = 'none';
        completedMsg.innerHTML = '<hr><img src="https://www.onlygfx.com/wp-content/uploads/2018/04/completed-stamp-3.png" alt="completed-img" height="150"></img>';
    } else {
        resultMsg.innerHTML += 'Sorry you didn\'t meet the conditions needed to achieve the challenge';
    }
    loadingImg.innerHTML='';
    resultMsg.parentElement.style.visibility = 'visible';
    window.addEventListener("click", () => {
        popupBg.style.display="none";
    })
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
    console.log(dist);
    resultMsg.innerHTML += `Your distance from the place is ${dist} metres.\n`;
    console.log(resultMsg);
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