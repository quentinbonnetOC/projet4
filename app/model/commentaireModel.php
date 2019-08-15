<?php
class Commentaire extends Admin{
    public function createComment($article_id, $pseudo, $email, $commentaire, $date){
        $db = $this->dbConnect();
        $req = $db->query('INSERT INTO `commentaire`(article_id, pseudo, email, commentaire, date) VALUES ("'.$article_id.'", "'.$pseudo.'", "'.$email.'", "'.$commentaire.'", "'.$date.'")');
        return $req;
    }
    public function readComments(){
        $db = $this->dbConnect();
        $req = $db->query('SELECT * FROM `commentaire`');
        return $req;
    }
    public function readArticle(){
        $db = $this->dbConnect();
        $req = $db->query('SELECT * FROM `articles`');
        return $req;
    }
    public function signalementComment($commentaire_id, $motif){
        $db = $this->dbConnect();
        $req = $db->query('INSERT INTO `signalement`(commentaire_id, motif) VALUES ("'.$commentaire_id.'", "'.$motif.'")');
        return $req;
    }
}
?>