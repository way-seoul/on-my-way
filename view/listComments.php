<section id="challenge-specific-comments-section">
    <?php
    $path = CHALLENGE_PATH . '&id=' . $id;
    ?>
    <div id="challenge-specific-comment-box">
        <form action="<?=$path?>" method="post">
            <textarea required id="comment_content" name="comment_content" cols="80" rows="5" placeholder="Leave a comment"></textarea>
            <button name="add_comment" value="add_comment">Add a comment</button>
        </form>
    </div>
    <?php
        if(isset($comments) && count($comments) > 0) {
            for($i=0; $i<count($comments); $i++) {
    ?>
        <div class="challenge-specific-comment">
            <div class="comment_user">
                <h4>
                    <?=
                    $comments[$i]['first_name'] . ' ' . $comments[$i]['last_name'] 
                    .' said on: '
                    . $comments[$i]['date_added']
                    ?>
                </h4>
            </div>
            <div>
                <p class="comment-content">
                    <?=$comments[$i]['content']?>
                </p>
            </div>
                <?php if($_SESSION['admin'] == true){?>
                    <form action="<?=$path?>" method="post">
                        <button style="background-color: red;" name="delete">DELETE COMMENT</button>
                        <input type="hidden" name="comment_id" value="<?=$comments[$i]['id']?>">
                    </form>
                <?php } ?>
        </div>
    <?php
            }
        } else {
            echo "No Comments available for this challenge yet";
        }
    ?>
</section>