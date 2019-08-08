<?php
class UtilisateurController{
    public function readArticle(){
        $class = new Commentaire();
        $readArticle = $class->readArticle();
        if(isset($_POST['article_id_createComment'])){
            $this->createComment();
        }
        $class = new Commentaire();
        $readComments = $class->readComments(); 
       require('../app/view/utilisateur.phtml');  
    }
    private function createComment(){
        $nom = isset($_POST['nom'])? $_POST['nom']:null;
        $prenom = isset($_POST['prenom'])? $_POST['prenom']:null;
        $email = isset($_POST['email'])? $_POST['email']:null;
        $commentaire = isset($_POST['commentaire'])? $_POST['commentaire']:null;
        $date = date('d/m/Y');
        $article_id = isset($_POST['article_id_createComment'])? $_POST['article_id_createComment'] : null;
        

        $class = new Commentaire();
        $createComment = $class->createComment($article_id, $nom, $prenom, $email, $commentaire, $date);
    }
}
?>  