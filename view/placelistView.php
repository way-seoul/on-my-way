<?php
$h1 = 'CHALLENGE LIST';
$title = 'ON MY WAY | ' . $h1;
ob_start();
?>
<script src="./public/responsive_search_bar.js" defer></script>
<h1><?= $h1 ?></h1>

<div style="background-color:black; width:fit-content; padding: 10px; margin: 10px;">
    <a href="<?= $addPlace_path ?>">Add a Place ></a>
</div>

<!--NEW CONTENT: Responsive Search Bar-->
<form id="search_form">
    <input id="search" type="text" class="input" placeholder="search..."/>
    <button id="clear" type="button" class="clear-results">clear</button>
</form>

<div id="challenges">
    <form action="<?= LIST_CHALLENGES_PATH ?>" method="POST">
        <?php if(isset($delete_msg)): ?> 
        <p style="font-size:1.1em; margin-bottom:10px;color:red;"><?= $delete_msg ?></p>
        <?php endif ?>
        <?php for($i = 0; $i<count($places); $i++): 
            $challenges = $c_manager->getChallenges($places[$i]["id"]);    
        ?>
        <details>
            <summary><?= $places[$i]["name"] ?></summary>
            <button type="submit" name="delete-Place" value="<?= $places[$i]['id'] ?>">DELETE THE PLACE</button>
            <ul>
                <?php foreach($challenges as $challenge): ?>
                <li>
                    <a href="<?= CHALLENGE_PATH ?>&id=<?= $challenge['id']?>"><?= $challenge["name"] ?></a>
                    <div class="btns">
                        <button type="submit" name="edit" value="<?= $challenge['id'] ?>">EDIT</button>
                        <button type="submit" name="delete" value="<?= $challenge['id'] ?>">DELETE</button>
                    </div>
                </li>
                <?php endforeach ?>
            </ul>
        </details>
        <?php endfor ?>
    </form>
</div>


<?php
    $html = ob_get_clean(); // give the code into a variable
    include 'template.php'; // and call the variable from the template
?>