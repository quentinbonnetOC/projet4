<?php
class Commentaire extends Admin{
    public function createComment($article_id, $nom, $prenom, $email, $commentaire){
        $db = $this->dbConnect();
        $req = $db->query('INSERT INTO `commentaire`(article_id, nom, prenom, email, commentaire) VALUES ("'.$article_id.'", "'.$nom.'", "'.$prenom.'", "'.$email.'", "'.$commentaire.'")');
        return $req;
    }
    public function readComments(){
        $db = $this->dbConnect();
        $req = $db->query('SELECT * FROM `commentaire`');
        return $req;
    }
    public function readArticle(){
        $db = $this->dbConnect();
        $req = $db->query('SELECT * FROM articles');
        return $req;
    }
}
?>