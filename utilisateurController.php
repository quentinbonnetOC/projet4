<?php
/**
 * Class UtilisateurController
 * gère le frontend
 */
class UtilisateurController{
    /**
     * @param object permer de lire les chapitres
     */
    public function readArticle(){
        $class = new Commentaire();
        $readArticle = $class->readArticle();
        if(isset($_POST['article_id_createComment'])){
            $this->createComment();
        }else if(isset($_POST['signaler'])){
            $this->signalementComment();
        }
        $class = new Commentaire();
        $readComments = $class->readComments(); 
        require('../app/view/utilisateur.phtml');  
    }
    /**
     * @param object permet de créer un commentaire
     */
    private function createComment(){
        $pseudo = isset($_POST['pseudo'])? $_POST['pseudo']:null;
        $email = isset($_POST['email'])? $_POST['email']:null;
        $commentaire = isset($_POST['commentaire'])? $_POST['commentaire']:null;
        $date = date('d/m/Y');
        $article_id = isset($_POST['article_id_createComment'])? $_POST['article_id_createComment'] : null;
        $class = new Commentaire();
        $createComment = $class->createComment($article_id, $pseudo, $email, $commentaire, $date);
        header("Location: http://localhost/projet_4/public?confirm_comment=true");
    }
    /**
     * @param object permet de signaler un commentaire
     */
    private function signalementComment(){
        $commentaire_id = $_POST['commentaire_id'];
        $motif = $_POST['motif'];
        $class = new Commentaire();
        $class->signalementComment($commentaire_id, $motif);
        header("Location: http://localhost/projet_4/public?confirm_signalement=true");
    }
}
?>  