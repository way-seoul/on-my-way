<?php
$title = 'ON MY WAY | '.$challenge['name'];
$coord = array(
    "lat" => $place['latitude'],
    "lng" => $place['longitude']
);
ob_start();
?>
<!-- DEFINE GLOBAL VARS NEEDED IN CHALLENGE-SPECIFIC SCRIPT & map.js. -->
<script>
    const maxDistance = <?=MAX_METRES_FROM_PLACE_FOR_USER_TO_ACHIEVE_CHALLENGE?>;
    let body = document.querySelector('body');
    //For better UX. Body shown once JS file loads.
    body.style.visibility = 'hidden';
    let userCompleteChallenge = <?=$userCompleteChall?>;
    let placeLoc = { lat: <?= $coord['lat'] ?>, lng: <?= $coord['lng']?> };
    let userID = <?=$_SESSION['user_id']?>;
    let score = <?=$challenge['score']?>;
    let challID = <?=$challenge['id']?>;
    let mapOptions = {
        center: placeLoc,
        zoom: 15,
        disableDefaultUI: true,
        zoomControl: false,
    };
    let mapMarkers =
    [
        {
            name: '<?= $place['name'] ?>', 
            lat: <?=$coord['lat']?>, 
            lng: <?=$coord['lng']?>
        }
    ];
</script>
<script src="public/challenge-specific-script.js" defer></script>
<!--Only includes function definitions-->
<script src="public/map.js"></script>
<script defer src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script
src="https://maps.googleapis.com/maps/api/js?key=<?=$db_password = $_SERVER['ONMYWAY_GMAP_KEY'];?>&callback=initMap&v=weekly&libraries=geometry"
defer>
</script>
<div class="container">
    <div id="challenge-specific-title">
        <h1><?= $challenge['name'] ?></h1>
    </div>
    <div class="row">
        <div class="col-md-4 col-12">
            <div id="challenge-specific-description-box">
                <div class="rewards">
                    <p>REWARDS</p>
                    <p><?= $challenge['score'] ?> points</p>
                </div>
                <div class="description">
                    <p>DESCRIPTION</p>
                    <p><?= ($challenge['content'] == null || $challenge['content'] == "") ? "-":$challenge['content']?></p>
                </div>
                <div class="conditions">
                    <p>CONDITIONS</p>
                    <p><?= ($challenge['conditions'] == null || $challenge['conditions'] == "") ? "none":$challenge['conditions']?></p>
                </div>
                <div class="location" id="ch-sp-lo">
                    <p>LOCATION</p>
                    <p><a href="<?= LIST_CHALLENGES_PATH ?>&search=<?= $place['name'] ?>" title="See every challenge at <?= $place['name'] ?>"><?= $place['name'] ?> →</a></p>
                </div>
                <div id="completed-container"></div>
                <!-- <p id="result-message-container"></p> -->
            </div>
        </div>
        <div id="single-marker" class="col-md-8 col-12 text-center">
            <div id="map"></div>
        </div>
    </div>
    <div id="onspot_container">
        <button id="onspot">COMPLETE THE CHALLENGE!</button>
    </div>
</div>
<?php require_once 'listComments.php'?>
<div class="popup-dim"><div class="popup-fix"><div class="popup-container">
    <div id="loading-container"></div>
    <div class="popup-box">
        <p id="result-message-container"></p>
    </div>
</div></div></div>
<?php
    $html = ob_get_clean(); // give the code into a variable
    include 'template.php'; // and call the variable from the template
?>