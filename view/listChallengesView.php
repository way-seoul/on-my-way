<?php
$h1 = 'Challenge List';
$title = 'ON MY WAY | ' . $h1;
ob_start();
?>
<script src="public/responsive_search_bar.js" defer></script>
<script>
    let mapOptions = {
        disableDefaultUI: true,
        zoom: 13,
        center: 
            { 
                lat: 37.53622850959400, lng: 126.894975568805080 
            }
    };

    let mapMarkers = [];
    <?php foreach($places as $place): ?>
        mapMarkers.push(
            {
                name: '<?= $place['name'] ?>', 
                lat: <?= $place['latitude'] ?>, 
                lng: <?= $place['longitude'] ?>
            }
        )
    <?php endforeach ?>
</script>
<script src="public/map.js" defer></script>
<script defer src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script
      src="https://maps.googleapis.com/maps/api/js?key=<?=$db_password = $_SERVER['ONMYWAY_GMAP_KEY'];?>&callback=initMap&v=weekly&libraries=geometry"
      defer>
</script>

<div class="container list-view">
    <h1 class="list-title"><?= $h1 ?></h1>
    <div class="row">
        <!--NEW CONTENT: Responsive Search Bar-->
        <div class="search-box col-md-6 col-12">
            <form id="search_form">
                <input id="search" type="text" class="input" placeholder="search..."/>
                <button id="clear" type="button" class="clear-results">CLEAR</button>
            </form>
        </div>
        <div class="col-md-6 col-12">
        </div>

    </div>
    <div class="row">
        <div class="col-md-6 col-12">
            <div id="challenges">
                <?php if(isset($delete_msg)): ?> 
                <p style="font-size:1.1em; margin-bottom:10px;color:red;"><?= $delete_msg ?></p>
                <?php endif ?>
                <?php for($i = 0; $i<count($places); $i++): 
                    $challenges = $c_manager->getChallenges($places[$i]["id"]);    
                ?>
                <details open class="list-box">
                    <summary>Location <?= $i+1 . ": " . $places[$i]["name"] ?></summary>
                    <ol>
                        <?php foreach($challenges as $challenge): ?>
                        <li>
                            <a href="<?= CHALLENGE_PATH ?>&id=<?= $challenge['id']?>">
                            <?= $challenge["name"] . ' >' ?>
                        </a></li>
                        <?php endforeach ?>
                    </ol>
                </details>
                <?php endfor ?>
            </div>
        </div>

        <div class="col-md-6 col-12" id="multi-marker">
            <div id="map"></div>
        </div>

    </div>
</div>



<?php
    $html = ob_get_clean(); // give the code into a variable
    include 'template.php'; // and call the variable from the template
?>