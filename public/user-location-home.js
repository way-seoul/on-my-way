
const getLocationBtn = document.getElementById('get-location');

window.onload = function () {
    //Check if browser supports geolocation......
    if (navigator.geolocation) {
        console.log('Geolocation is supported!');
    } else {
        console.log('Geolocation is not supported for this Browser/OS.');
        return
    }
}

const getUserLocation = (position) => {
    console.log(position.coords.latitude);
    console.log(position.coords.longitude);
}

getLocationBtn.addEventListener('click', () => {
    navigator.geolocation.getCurrentPosition(getUserLocation);
})
  

