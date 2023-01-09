<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create A New Challenge</title>
</head>
<body>
<form action="../on-my-way/index.php?action=create-challenge" method="post">
    <input name="name" type="text" placeholder="Place Name" required>
    <input name="conditions" type="text" placeholder="Conditions" required>
    <input name="score" type="text" placeholder="Score" required>
    <select name="place_id" id="name">
        <?php
        foreach($existingPlaces as $place) {
        ?>
        <option value="<?=$place['id']?>"><?=$place['name']?></option>
        <?php
        }
        ?>
    </select>
    <button type="submit" name="submit">Add New Place</button>
    <div class="errMsg"><?=$errMessage ?? ''?></div>
</form>   
</body>
</html>