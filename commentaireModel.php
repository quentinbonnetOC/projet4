<?php
class Commentaire extends Admin{
    public function commentaireUtilisateur($article_id, $nom, $prenom, $email, $commentaire){
        $db = $this->dbConnect();
        $req = $db->query('INSERT INTO `commentaire`(article_id, nom, prenom, email, commentaire) VALUES ("'.$article_id.'", "'.$nom.'", "'.$prenom.'", "'.$email.'", "'.$commentaire.'")');
        return $req;
    }
    public function readConments(){
        
    }
}
?>