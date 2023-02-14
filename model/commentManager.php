<?php

require_once './model/db.php';

class CommentManager extends Db {
    public function getAllCommentsForChallenge($id) {
        $db = $this->connectDB();
        $comments = $db->prepare(
            "SELECT challenge_comments.id, challenge_comments.content, challenge_comments.date_added, users.first_name, users.last_name 
            FROM challenge_comments
            LEFT JOIN users
            ON challenge_comments.user_id = users.id
            WHERE challenge_comments.challenge_id = ?;"
        );
        $comments->execute([$id]);
        $comments = $comments->fetchAll();
        return $comments;
    }

    public function addComment($challenge_id, $user_id, $comment_content) {
        $db = $this->connectDB();
        $comment_content = trim(($comment_content));
        $newComment = $db->prepare(
            'INSERT INTO challenge_comments
            (content, date_added, user_id, challenge_id)
            VALUES 
            (:content, :date_added, :user_id, :challenge_id)'
        );
        $newComment->execute([
            'content' => $comment_content,
            'date_added' => date("Y-m-d H:i:s"),
            'user_id' => $user_id,
            'challenge_id' => $challenge_id
        ]);
    }

    public function deleteComment($commentId) {
        $db = $this->connectDB();
        $delete = $db->prepare(
            "DELETE FROM challenge_comments WHERE id=:id" 
        );
        $delete->execute([
            'id' => $commentId
        ]);
    }
}