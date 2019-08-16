<?php
class UtilisateurController{
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
    private function createComment(){
        $pseudo = isset($_POST['pseudo'])? $_POST['pseudo']:null;
        $email = isset($_POST['email'])? $_POST['email']:null;
        $commentaire = isset($_POST['commentaire'])? $_POST['commentaire']:null;
        $date = date('d/m/Y');
        $article_id = isset($_POST['article_id_createComment'])? $_POST['article_id_createComment'] : null;
        $class = new Commentaire();
        $createComment = $class->createComment($article_id, $pseudo, $email, $commentaire, $date);
        ?><script>setTimeout(function(){
            document.location.href="http://localhost/projet_4/public";
        },0000);
        alert("Votre commentaire a bien été enregistré");</script><?php
    }
    private function signalementComment(){
        $commentaire_id = $_POST['commentaire_id'];
        $motif = $_POST['motif'];
        $class = new Commentaire();
        $class->signalementComment($commentaire_id, $motif);
        ?><script>setTimeout(function(){
            document.location.href="http://localhost/projet_4/public";
        },0000);
        alert("Votre signalement a bien été enregistré");</script><?php
    }
}
?>  