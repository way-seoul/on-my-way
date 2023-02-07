
console.log('HI App.js');
//User Delete Function using AJAX
let buttons = document.querySelectorAll('button.delete-user');

buttons.forEach(button => {

    let id = button.getAttribute('data-id');

    button.addEventListener('click', function(e){
        e.preventDefault();

        let formData = new FormData();
        formData.append('id', id);
        formData.append('delete', 'delete');

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '');
        xhr.send(formData);


        // when we're done with the request
        xhr.addEventListener('readystatechange', function(){
            if(xhr.readyState == XMLHttpRequest.DONE){

                // get a reference to the row for the place
                let row = button.closest("tr");

                //delete row
                row.remove();
            }
        });


    });

});


//Google Map API show multiple locations on one map

function initMap() {

    // The map, centered at wcoding
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 14,
        center: { lat: 37.53622850959400, lng: 126.894975568805080 },
        disableDefaultUI: true
    });
    setMarkers(map);
}


function setMarkers(map) {
    for (let i = 0; i < locations.length; i++) { 
        let location = locations[i];
        new google.maps.Marker({
            position: {lat: location[1], lng: location[2]},
            map: map,
            title: 'Location' + (i+1) + ': ' + location[0]
        });
    }
}

window.initMap = initMap;

// Reset user password
let reset_buttons = document.querySelectorAll('button.reset-password');

reset_buttons.forEach(reset_button => {

    let id = reset_button.getAttribute('data-id');

    reset_button.addEventListener('click', function(){
        let formData = new FormData();
        formData.append('id', id);
        formData.append('reset', 'reset');

        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'index.php?action=admin');
        xhr.send(formData);

        xhr.addEventListener('readystatechange', function(){
            if(xhr.readyState == XMLHttpRequest.DONE){
                alert("Password reset successful!");
            }
        })
    })
})

