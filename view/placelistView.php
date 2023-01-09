<?php
$title = 'Places List';
ob_start();
?>

<div id="challenges">
    <?php for($i = 0; $i<count($places); $i++): 
        $challenges = $c_manager->getChallenges($places[$i]["id"]);    
    ?>
    <details>
        <summary><?= $places[$i]["name"] ?></summary>
        <ul>
            <?php foreach($challenges as $challenge): ?>
            <li><a href="index.php?action=challenge-specific&id=<?= $challenge['id']?>"><?= $challenge["name"] ?></a></li>
            <?php endforeach ?>
        </ul>
      </details>
      <?php endfor ?>
</div>


<?php
    $html = ob_get_clean(); // give the code into a variable
    include 'template.php'; // and call the variable from the template
?>