<?php
/**
 * Class UtilisateurController
 * gère le frontend
 */
class UtilisateurController{

	/**
	 * permer de lire les chapitres
	 * @return void
	 */
	public function readArticle(){
        $class = new Commentaire();
        $readArticle = $class->readArticle();
        $fetchAll_readarticles = $readArticle->fetchAll();
        if(isset($_POST['article_id_createComment'])){
            $this->createComment();
        }elseif(isset($_POST['signaler'])){
            $this->signalementComment();
        }
        $class = new Commentaire();
        $readComments = $class->readComments();
        $fetchAll_readComments = $readComments->fetchAll();
        require_once '../app/view/utilisateur.phtml';
    }

	/**
	 * permet de créer un commentaire
	 * @return void
	 */
	private function createComment(){
        $pseudo = isset($_POST['pseudo'])? htmlspecialchars($_POST['pseudo']):null;
        $email = isset($_POST['email'])? htmlspecialchars($_POST['email']):null;
        $commentaire = isset($_POST['commentaire'])? htmlspecialchars($_POST['commentaire']):null;
        $date = date('Y/m/d');

        $article_id = isset($_POST['article_id_createComment'])? htmlspecialchars($_POST['article_id_createComment']) : null;
        $class = new Commentaire();
        $createComment = $class->createComment($article_id, $pseudo, $email, $commentaire, $date);
        header("Location: ?confirm_comment=true");
    }

	/**
	 * permet de signaler un commentaire
	 * @return void
	 */
	private function signalementComment(){
        $commentaire_id = $_POST['commentaire_id'];
        $motif = $_POST['motif'];
        $class = new Commentaire();
        $class->signalementComment($commentaire_id, $motif);
        header("Location: ?confirm_signalement=true");
    }
}
