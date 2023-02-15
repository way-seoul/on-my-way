<?php
$h1 = 'Challenge List';
$title = 'ON MY WAY | ' . $h1;
ob_start();
?>
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
    let placesById = JSON.parse('<?= $json_places ?>');
    let search_key = "<?= $search_param ?>";
    const mapBound = true;
</script>
<script src="public/responsive_search_bar.js" defer></script>
<script src="public/map.js" defer></script>
<script src="public/list-challenge-script.js" defer></script>
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
                <input id="search" type="text" class="input" placeholder="search..."
                <?php if($search_param != ""): ?>
                    value="<?= $search_param ?>"
                <?php endif ?>
                />
                <button id="clear" type="button" class="clear-results">CLEAR</button>
            </form>
        </div>
        <div class="col-md-6 col-12">
        </div>

    </div>
    <div class="row">
        <div class="col-md-6 col-12">
            <div id="challenges">
                <?php for($i = 0; $i<count($places); $i++): 
                    $challenges = $c_manager->getChallenges($places[$i]["id"]);    
                ?>
                <details open class="list-box">
                    <summary>
                        Location <?= $i+1 . ": " . $places[$i]["name"] ?>
                        <span data-placeid="<?= $places[$i]["id"] ?>" class="pan-map-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd" d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </summary>
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