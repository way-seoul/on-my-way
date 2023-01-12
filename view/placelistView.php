<?php
$title = 'ON MY WAY | CHALLENGE LIST';
ob_start();
?>
<script src="./public/responsive_search_bar.js" defer></script>
<h1><?= $title ?></h1>
<!--NEW CONTENT: Responsive Search Bar-->
<form id="search_form">
    <input id="search" type="text" class="input" placeholder="search..."/>
    <button id="clear" type="button" class="clear-results">clear</button>
</form>
<div id="challenges">
    <form action="<?= $listChallenges_path ?>" method="POST">
        <?php for($i = 0; $i<count($places); $i++): 
            $challenges = $c_manager->getChallenges($places[$i]["id"]);    
        ?>
        <details>
            <summary><?= $places[$i]["name"] ?></summary>
            <ul>
                <?php foreach($challenges as $challenge): ?>
                <li>
                    <a href="<?= $challenge_path ?>&id=<?= $challenge['id']?>"><?= $challenge["name"] ?></a>
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