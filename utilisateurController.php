<?php
class UtilisateurController{
    public function readArticleUtilisateur(){
        $class = new Admin();
        $readArticle = $class->readArticle();
        if(isset($_POST['id'])){
            $this->_commentaireUtilisateur();
        }
        require('../app/view/utilisateur.phtml');
    }
    private function _commentaireUtilisateur(){
        $nom = isset($_POST['nom'])? $_POST['nom']:null;
        $prenom = isset($_POST['prenom'])? $_POST['prenom']:null;
        $email = isset($_POST['email'])? $_POST['email']:null;
        $commentaire = isset($_POST['commentaire'])? $_POST['commentaire']:null;
        $article_id = isset($_POST['id'])? $_POST['id'] : null;
        $class = new Commentaire();
        $commentaireUtilisateur = $class->commentaireUtilisateur($article_id, $nom, $prenom, $email, $commentaire);
    }
}
?>  