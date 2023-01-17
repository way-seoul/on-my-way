<?php

require_once './model/db.php';

class CommentManager extends Db {
    public function getAllCommentsForChallenge($id) {
        $db = $this->connectDB();
        $comments = $db->prepare(
            "SELECT challenge_comments.content, challenge_comments.date_added, users.first_name, users.last_name 
            FROM challenge_comments
            LEFT JOIN users
            ON challenge_comments.user_id = users.id
            WHERE challenge_comments.challenge_id = ?;"
        );
        $comments->execute([5]);
        $comments = $comments->fetchAll();
        return $comments;
    }
}