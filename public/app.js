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
    zoom: 16,
    center: { lat: 37.53622850959400, lng: 126.894975568805080 },
    });
    setMarkers(map);
}

const locations = [
    ['Sample Place 1', 37.53622850959400, 126.894975568805080],
    ['Sample Place 2', 37.537053744792225, 126.896220113787990],
];

function setMarkers(map) {
    for (let i = 0; i < locations.length; i++) { 
        const location = locations[i];
        new google.maps.Marker({
        position: {lat: location[1], lng: location[2]},
        map: map
        });
    }
}

window.initMap = initMap;
