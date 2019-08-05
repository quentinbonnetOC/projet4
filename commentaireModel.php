<?php
class Commentaire extends Admin{
    public function commentaireUtilisateur($nom, $prenom, $email, $commentaire){
        $db = $this->dbConnect();
        $req = $db->query('INSERT INTO `commentaire`(nom, prenom, email, commentaire) VALUES ("'.$nom.'", "'.$prenom.'", "'.$email.'", "'.$commentaire.'")');
        return $req;
    }
}
?>