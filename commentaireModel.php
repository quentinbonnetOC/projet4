<?php
class Commentaire extends Admin{
    public function createComment($article_id, $nom, $prenom, $email, $commentaire, $date){
        $db = $this->dbConnect();
        $req = $db->query('INSERT INTO `commentaire`(article_id, nom, prenom, email, commentaire, date) VALUES ("'.$article_id.'", "'.$nom.'", "'.$prenom.'", "'.$email.'", "'.$commentaire.'", "'.$date.'")');
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
}
?>