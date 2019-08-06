<?php
class UtilisateurController{
    public function readArticle(){
        $classi = new Commentaire();
        $readArticle = $classi->readArticle();
        require('../app/view/utilisateur.phtml');
        if(isset($_POST['article_id_createComment'])){
            $this->createComment();
        }
        $this->readComments();
        
    }
    private function createComment(){
        $nom = isset($_POST['nom'])? $_POST['nom']:null;
        $prenom = isset($_POST['prenom'])? $_POST['prenom']:null;
        $email = isset($_POST['email'])? $_POST['email']:null;
        $commentaire = isset($_POST['commentaire'])? $_POST['commentaire']:null;
        $article_id = isset($_POST['id'])? $_POST['id'] : null;
        $class = new Commentaire();
        $createComment = $class->createComment($article_id, $nom, $prenom, $email, $commentaire);
    }
    private function readComments(){
        $classe = new Commentaire();
        $readComments = $classe->readComments();
        require('../app/view/utilisateur.phtml');
    }
}
?>  