<?php 
    $title = 'Create a New Challenge';
    ob_start();
?>

<form action="<?= $editChallenge_path ?>" method="post">
    <!-- <select name="edit-challenge" id=""> -->
        <!----------- PHP LOOP HERE -------->
        <select name="edit-challenge-id" id="edit-challenge">
        <?php
            for($i=0; $i<count($existingChallenges); $i++) {
                $chal = $existingChallenges[$i];
        ?>
            <option value="<?=$chal['id']?>"><?=$chal['name']?></option>
        <?php
            }
        ?>
        </select>
        <input type="submit" name="edit-challenge-submit" id="edit-challenge-submit" value="Edit A Challenge">
</form>
    
<?php 
    $html = ob_get_clean();
    include 'template.php';
?>