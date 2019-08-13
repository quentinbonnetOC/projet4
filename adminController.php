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
            $class = new Admin();
            $chapter = $_POST['chapter'];
            $title = $_POST['title'];        
            $date = date('d/m/Y');
            $createArticle = $class->createArticle($chapter, $title, $date);       
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
                $testDelete = new Admin;
                $testDelete->deleteArticle($id);
            ///delete
            }else if(!empty($_POST['update'])) {
                //update
                require('../app/view/update.phtml');   
                $_SESSION['update'] = true;
                $this->updateArticle();
                ///update
            }else{
                $class = new Admin();
                $readArticle = $class->readArticle();
                require('../app/view/backoffice.phtml');
            }       
        } 
    }
    private function updateArticle(){
        if(isset($_POST['envoyeur'])){
            $chapter = $_POST['chapter'];
            $title = $_POST['title'];
            $date = $_POST['date'];
            $id = $_POST['envoyeur'];
            $testDelete = new Admin;
            $testDelete->updateArticle($chapter, $title, $date, $id);
            unset($_SESSION['update']);
        }  
    }
    public function signalementCommentAdmin(){
        $class = new Admin();
        $signalementCommentAdmin = $class->signalementCommentAdmin();
        require('../app/view/signalementComment.phtml');
    }
}
?>