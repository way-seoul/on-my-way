<?php
$title = 'ON MY WAY | '.$challenge['name'];
$coord = array(
    "lat" => $place['latitude'],
    "lng" => $place['longitude']
);
//WILL NEED TO BE PULLED DYNAMICALLY FROM SESSION LATER..
$userID = 1;
print_r($title);
echo "<br>";
echo "<br>";
print_r($coord);
echo "<br>";
echo "<br>";
print_r($challenge);
echo "<br>";
echo "<br>";
print_r($place);
ob_start();
?>
<!-- DEFINE GLOBAL VARS NEEDED IN CHALLENGE-SPECIFIC SCRIPT.. -->
<script>
    let placeLoc = { lat: <?= $coord['lat'] ?>, lng: <?= $coord['lng']?> };
    let userID = <?=$userID?>;
    let score = <?=$challenge['score']?>;
    let challID = <?=$challenge['id']?>
</script>
<script src="public/challenge-specific-script.js" async defer></script>

<h1><?= $challenge['name'] ?></h1>
<button id="onspot">
    I'm ON the SPOT!
</button>
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
        <strong><a href="<?= $listChallenges_path ?>">
            <?= $place['name'] ?>
        </strong></a> <!-- let's replace the link later with list of challenges on this spot -->
    </p>
    <p id="result-message-container"></p>
    <?=require_once 'listComments.php'?>
    <div id="single-marker">
        <div id="map"></div>
    </div>
</div>

<?php
    $html = ob_get_clean(); // give the code into a variable
    include 'template.php'; // and call the variable from the template
?>