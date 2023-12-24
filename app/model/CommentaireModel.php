<?php
class Commentaire extends Bdd{
    public function createComment($article_id, $pseudo, $email, $commentaire, $date){
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO `commentaire`(article_id, pseudo, email, commentaire, date) VALUES (:article_id, :pseudo, :email, :commentaire, :date)');
        $req->execute(array(
            'article_id' => $article_id,
            'pseudo' => $pseudo,
            'email' => $email,
            'commentaire' => $commentaire,
            'date' => $date
        ));
        return $req;
    }
    public function readComments(){
        return $this->dbConnect()->query('SELECT * FROM `commentaire`');
    }
    public function readArticle(){
        return $this->dbConnect()->query('SELECT * FROM `articles`');
    }
    public function signalementComment($commentaire_id, $motif){
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO `signalement`(commentaire_id, motif) VALUES (:commentaire_id, :motif)');
        $req->execute(array(
            'commentaire_id' => $commentaire_id,
            'motif' => $motif
        ));
        return $req;
    }
}
