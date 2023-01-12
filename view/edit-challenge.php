<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
</head>
<body>
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
    
</body>
</html>