<section class="comments">
    <h3>Comments:</h3>
    <?php
        if(isset($comments)) {
            for($i=0; $i<count($comments); $i++) {
    ?>
                <div class="comment">
                    <h4>
                        <?=
                        $comments[$i]['first_name'] . ' ' . $comments[$i]['last_name'] 
                        .' said on: '
                        . $comments[$i]['date_added']
                        ?>
                    </h4>
                    <p class="comment-content">
                        <?=$comments[$i]['content']?>
                    </p>
                </div>
    <?php
            }
        } else {
            echo "No Comments available for this challenge yet";
        }
    ?>
</section>