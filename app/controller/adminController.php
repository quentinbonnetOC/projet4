<?php
class AdminController{
    public function authentification(){
        if(isset($_SESSION['authentification'])){
            $this->readArticle();
        }else if(!isset($_POST['envoi'])){
            require('../app/view/authentification.phtml');
        }else if(isset($_POST['envoi'])){
            $class = new Admin();
            $idt = $_POST['idt'];
            $mdp = $_POST['mdp'];
            $authentification  = $class->authentification($idt);
            if(password_verify($mdp, $authentification->fetch()['mdp'])){
                $this->readArticle();
            }else{
                echo "erreur d'identifiant ou de mot de passe";
            } 
        }   
    }
    public function createArticle(){   
        if(isset($_POST['envoie']) && $_POST['envoie']=='envoyer'){
            $class = new Article();
            $chapter = $_POST['chapter'];
            $contenu = $_POST['contenu'];
            $title = $_POST['title'];        
            $date = date('d/m/Y');
            $createArticle = $class->createArticle($chapter, $title, $contenu, $date);       
        }
        require('../app/view/createArticle.phtml');
    }
    public function readArticle(){
        if(isset($_SESSION['update']) && $_SESSION['update']  == true){
            $this->updateArticle();
        }else{
            //delete
            if(!empty($_POST['delete'])){  
                $id = $_POST['delete'];
                $testDelete = new Admin();
                $testDelete->deleteArticle($id);
            ///delete
            }else if(!empty($_POST['update'])) {
                //update
                require('../app/view/update.phtml');   
                $_SESSION['update'] = true;
                $this->updateArticle();
                ///update
            }else{
                $class = new Article();
                $readArticle = $class->readArticle();
                require('../app/view/backoffice.phtml');
            }       
        } 
    }
    private function updateArticle(){
        if(isset($_POST['envoyeur'])){
            $chapter = $_POST['chapter'];
            $title = $_POST['title'];
            $contenu = $_POST['contenu'];
            $date = $_POST['date'];
            $id = $_POST['envoyeur'];
            $testDelete = new Admin();
            $testDelete->updateArticle($chapter, $title, $contenu, $date, $id);
            unset($_SESSION['update']);
        }  
    }
    public function signalementCommentAdmin(){
        $class = new Signalement();
        $signalementCommentAdmin = $class->signalementCommentAdmin();
        $this->traitementCommentaireSignaler();
        require('../app/view/signalementComment.phtml');
    }
    private function traitementCommentaireSignaler(){
        $id = isset($_GET['id'])? $_GET['id'] : null;
        $commentaire_id = isset($_GET['commentaire_id']) ? $_GET['commentaire_id'] : null;
        $class = new Signalement();
        if(isset($_GET['accepter'])&& $_GET['accepter']==true){
            $accepterCommentaireSignaler = $class->accepterCommentaireSignaler($id);
            header('Location: http://localhost/projet_4/public/?action=signalement');
        }else if(isset($_GET['refuser']) && $_GET['refuser']==true){
            $refuserCommentaireSignaler = $class->refuserCommentaireSignaler($id, $commentaire_id);
            header('Location: http://localhost/projet_4/public/?action=signalement');
        }
    } 
}
?>