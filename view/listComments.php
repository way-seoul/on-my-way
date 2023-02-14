<section id="challenge-specific-comments-section">
    <?php
    $path = CHALLENGE_PATH . '&id=' . $id;
    ?>
    <div id="challenge-specific-comment-box">
        <form class="comment_form" action="<?=$path?>" method="post">
            <textarea required class="comment_content" name="comment_content" cols="80" rows="5" placeholder="Leave a comment"></textarea>
            <button class="add_comment" name="add_comment">SEND</button>
        </form>
    </div>
    <?php
        if(isset($comments) && count($comments) > 0) {
            for($i=0; $i<count($comments); $i++) {
    ?>
        <div class="challenge-specific-comment">
            <div>
                <h5 class="comment_user">
                    <?=
                    $comments[$i]['first_name'] . ' ' . $comments[$i]['last_name'] 
                    .' said on: '
                    . $comments[$i]['date_added']
                    ?>
                </h5>
            </div>
            <div class="comments">
                <p>
                    <?=$comments[$i]['content']?>
                </p>
            </div>
        </div>
        <?php if($_SESSION['admin'] == true){?>
            <form class="delete_comment_form" action="<?=$path?>" method="post">
                <button class="delete_comment" name="delete">DELETE COMMENT</button>
                <input type="hidden" name="comment_id" value="<?=$comments[$i]['id']?>">
            </form>
        <?php } ?>
    <?php
            }
        } else {
            echo "No Comments available for this challenge yet";
        }
    ?>
</section>