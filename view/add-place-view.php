<?php 
    $h1 = 'Add a Place';
    $title = 'ON MY WAY | ' . $h1;
    ob_start();
?>
<div class="container form-view">

    <h1><?= $h1 ?></h1>

    <div class="row">
        <div class="col-md-6 col-12 fill-vp form-map-img">
            <div id="phase2-rp">
                <h2>FOR PHASE 2: ADD PLACE BY POINTING ON MAP</h2>
                <p>The image will be replaced with Google Maps.</p>
            </div>
        </div>
        <div class="col-md-6 col-12 fill-vp form-box">
            <form action="<?= ADD_PLACE_PATH ?>" method="POST">
                <div class="fields">
                    <label for="place_name">Place Name: </label>
                    <input type="text" name="name" id="place_name" 
                    placeholder="Name it!" value="<?= isset($prefill) ? $prefill['name']:'' ?>"
                    required autofocus>
                </div>
                <div class="fields">
                    <label for="place_lat">Latitude: </label>
                    <input type="text" name="latitude" id="place_lat" class="<?= $invalidInput == true ? 'invalid':'none' ?>"
                        placeholder="ex, 37.123123123" value="<?= isset($prefill) ? $prefill['latitude']:'' ?>"
                        required>
                    <p style="display:<?= $invalidInput == true ? 'block':'none' ?>;">
                        in decimal from -90 to 90
                    </p>
                </div>
                <div class="fields">
                    <label for="place_lon">Longitude: </label>
                    <input type="text" name="longitude" id="place_lon" class="<?= $invalidInput == true ? 'invalid':'none' ?>"
                        placeholder="ex, 120.123123123" value="<?= isset($prefill) ? $prefill['longitude']:'' ?>"
                        required>
                    <p style="display:<?= $invalidInput == true ? 'block':'none' ?>;">
                        in decimal from -180 to 180
                    </p>
                </div>
                <button type="submit" name="add-place" value="true" class="submit-btn">Save</button>
            </form>
        </div>
    </div>

</div>

<?php 
    $html = ob_get_clean();
    include 'template.php';
?>