<?php
/**
 * class signalement
 */
class Signalement extends Admin{
    /**
     * @param object signaler un commentaire
     */
    public function signalementCommentAdmin(){
        $db = $this->dbConnect();
        // $req = $db->query('SELECT * FROM `signalement`');
        $req = $db->query('SELECT * FROM `commentaire` INNER JOIN `signalement` ON commentaire_id = commentaire.id');
        return $req;
    }
    public function accepterCommentaireSignaler($id){
        $db = $this->dbConnect();
        $req = $db->query('DELETE FROM `signalement` WHERE id = "'.$id.'"');
        return $req;
    }
    public function refuserCommentaireSignaler($id, $commentaire_id){
        $db = $this->dbConnect();
        $req = $db->query('DELETE FROM `signalement` WHERE id = "'.$id.'"');
        $req2 = $db->query('DELETE FROM `commentaire` WHERE id = "'.$commentaire_id.'"');
        return array($req, $req2);
    }
}