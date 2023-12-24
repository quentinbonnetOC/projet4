<?php
/**
 * class signalement
 */
class Signalement extends Bdd{

	/**
	 * signaler un commentaire
	 * @return false|PDOStatement
	 */
	public function signalementCommentAdmin(){
        return $this->dbConnect()->query('SELECT * FROM `commentaire` INNER JOIN `signalement` ON commentaire_id = commentaire.id');
    }

	/**
	 * @param $id
	 *
	 * @return false|PDOStatement
	 */
	public function accepterCommentaireSignaler($id){
        $req = $this->dbConnect()->prepare('DELETE FROM `signalement` WHERE id = :id');
        $req->execute(array('id' => $id));
        return $req;
    }

	/**
	 * @param $id
	 * @param $commentaire_id
	 *
	 * @return array
	 */
	public function refuserCommentaireSignaler($id, $commentaire_id){
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM `signalement` WHERE id = :id');
        $req->execute(array(
            'id' => $id
        ));
        $req2 = $db->prepare('DELETE FROM `commentaire` WHERE id = :commentaire_id');
        $req2->execute(array(
            'commentaire_id' => $commentaire_id
        ));
        return array($req, $req2);
    }
}