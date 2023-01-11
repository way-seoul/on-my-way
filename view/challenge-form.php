<?php 
    $title = 'ON MY WAY | CREATE A NEW CHALLENGE';
    ob_start();
?>

<?php
    if(isset($backBtn)) echo $backBtn;
?>
<form action="../on-my-way/index.php?action=<?=$action?>" method="post">
    <input name="name" type="text" placeholder="Place Name" value="<?=$name ?? ''?>" required>
    <input name="conditions" type="text" placeholder="Conditions" value="<?=$conditions ?? ''?>" required>
    <input name="score" type="text" placeholder="Score" value="<?=$score ?? ''?>" required>
    <select name="place_id" id="name">
        <?php
        foreach($existingPlaces as $place) {
            if(isset($edit_place_id)) {
                $selected = $place['id'] == $edit_place_id ? 'selected' : '';
            }
        ?>
        <option value="<?=$place['id']?>" <?=$selected?>><?=$place['name']?></option>
        <?php
        }
        ?>
    </select>
    <button type="submit" name="submit"><?=$btnText?></button>
    <div class="errMsg"><?=$errMessage ?? ''?></div>
</form>   

<?php 
    $html = ob_get_clean();
    include 'template.php';
?>