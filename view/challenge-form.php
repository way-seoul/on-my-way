<?php 
    $h1 = isset($backBtn) ? 'Edit: ' . $name:'Create A New Challenge';
    $title = 'ON MY WAY | ' . $h1;
    ob_start();
?>


<div class="container form-view">

    <?php if(isset($backBtn)): ?>
        <div class="back-btn">
            <?= $backBtn ?>
        </div>
    <?php endif ?>

    <h1><?= $h1 ?></h1>
    
    <form action="<?= ROOT . $action ?>" method="post">
        <div class="row">
            <div class="col-md-6 col-12 form-box">
                <?php
                if(isset($challengeId)) {
                ?>
                <input type="hidden" id="edit" name="edit" value="<?=$challengeId?>">
                <?php 
                }
                ?>
                <div class="fields">
                    <label for="ch_name">Challenge Name: </label>
                    <input name="name" id="ch_name" type="text" placeholder="Give a good name!" value="<?=$name ?? ''?>" required autofocus>
                </div>
                <div class="">
                    <label for="content">Content: </label>
                    <textarea name="content" id="content" cols="50" rows="3" placeholder="Describe in detail!" required><?=$content ?? '' ?></textarea>
                </div>
                <div class="fields">
                    <label for="conditions">Conditions: </label>
                    <input name="conditions" id="conditions" type="text" placeholder="Extra conditions for fun!" value="<?=$conditions ?? ''?>" required>
                </div>
            </div>
            <div class="col-md-6 col-12 form-box">
                <div class="fields">
                    <label for="score">Score: </label>
                    <input name="score" id="score" type="number" placeholder="Points to receive" value="<?=$score ?? ''?>" required>
                </div>
                <div class="fields">
                    <label for="name">Select Location: </label>
                    <select name="place_id" id="name">
                        <?php
                        foreach($existingPlaces as $place) {
                            if(isset($edit_place_id)) {
                                $selected = $place['id'] == $edit_place_id ? 'selected' : '';
                            }
                        ?>
                        <option value="<?=$place['id']?>" <?=$selected ?? ''?>><?=$place['name']?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" name="<?=$btnName?>" class="submit-btn"><?=$btnText?></button>
                <div class="errMsg"><?=$formMsg ?? ''?></div>
            </div>
        </div>
    </form>   

</div>

<?php 
    $html = ob_get_clean();
    include 'template.php';
?>