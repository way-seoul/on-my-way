<?php
$title = 'ON MY WAY | '.$challenge['name'];
$coord = array(
    "lat" => $place['latitude'],
    "lng" => $place['longitude']
);
ob_start();
?>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script>
    let map;

    function initMap() {
        let location = { lat: <?= $coord['lat'] ?>, lng: <?= $coord['lng']?> };

        map = new google.maps.Map(document.getElementById("map"), {
            center: location,
            zoom: 15,
            disableDefaultUI: true,
            zoomControl: false,
        });

        const marker = new google.maps.Marker({
            position: location,
            map: map,
            title: "Port Dodong"
        });

    }

    window.initMap = initMap;
</script>

<h1><?= $challenge['name'] ?></h1>
<div onclick="alert('hello!');" id="onspot">
    I'm ON the SPOT!
</div>
<div id="challenge">
    <p>Description: 
        <?= $challenge['content'] ?>
    </p>
    <p>Extra conditions: 
        <?= ($challenge['conditions'] == null || $challenge['conditions'] == "") ? "none":$challenge['conditions']?>
    </p>
    <p>Rewards: 
        <strong><?= $challenge['score'] ?> points</strong>
    </p>
    <p>Location: 
        <strong><a href="<?= LIST_CHALLENGES_PATH ?>">
            <?= $place['name'] ?>
        </strong></a> <!-- let's replace the link later with list of challenges on this spot -->
    </p>
    <?=require_once 'listComments.php'?>
    <div id="single-marker">
        <div id="map"></div>
    </div>
</div>
<script
    src="https://maps.googleapis.com/maps/api/js?key=
            AIzaSyD2BtiQ-uN99L2bC0QfQHo_RI1nk53XqYk
        &callback=initMap&v=weekly"
    defer
></script>

<?php
    $html = ob_get_clean(); // give the code into a variable
    include 'template.php'; // and call the variable from the template
?>