<?php 
    $h1 = 'Add a Place';
    $title = 'ON MY WAY | ' . $h1;
    ob_start();
?>

<h1><?= $h1 ?></h1>
<form action="<?= $addPlace_path ?>" method="POST">
    <label for="place_name">Place Name: </label>
    <input type="text" name="name" id="place_name" 
        placeholder="Name it!" value="<?= isset($prefill) ? $prefill['name']:'' ?>"
        required autofocus>
    <div>
        <label for="place_lat">Latitude: </label>
        <input type="text" name="latitude" id="place_lat" 
            placeholder="ex, 37.123123123" value="<?= isset($prefill) ? $prefill['latitude']:'' ?>"
            required>
        <p style="display:<?= $invalidInput == true ? 'block':'none' ?>; padding:0;margin:0;margin-bottom:10px;color:red;font-size:small">
            in decimal from -90 to 90
        </p>
    </div>
    <div>
        <label for="place_lon">Longitude: </label>
        <input type="text" name="longitude" id="place_lon" 
            placeholder="ex, 120.123123123" value="<?= isset($prefill) ? $prefill['longitude']:'' ?>"
            required>
        <p style="display:<?= $invalidInput == true ? 'block':'none' ?>; padding:0;margin:0;margin-bottom:10px;color:red;font-size:small">
            in decimal from -180 to 180
        </p>
    </div>
    <button type="submit" name="add-place" value="true">Add a Place!</button>
</form>

<?php 
    $html = ob_get_clean();
    include 'template.php';
?>