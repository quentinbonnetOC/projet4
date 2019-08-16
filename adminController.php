<?php
class AdminController{
    public function authentification(){
        if(!isset($_POST['envoi'])){
            require('../app/view/authentification.phtml');
        }else if(isset($_POST['envoi'])){
            $class = new Admin();
            $idt = $_POST['idt'];
            $mdp = $_POST['mdp'];
            $authentification  = $class->authentification($idt);
            if(password_verify($mdp, $authentification->fetch()['mdp'])){
                $_SESSION['authentification']=true;
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
        if(isset($_SESSION['authentification']) && $_SESSION['authentification']==true){         
            if(isset($_SESSION['update']) && $_SESSION['update']  == true){
                $this->updateArticle();
                unset($_SESSION['update']);
            }else{
                //delete
                if(!empty($_POST['delete'])){  
                    $id = $_POST['delete'];
                    $testDelete = new Article();
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
        }else{
            /*si pas acces par authentification*/
            ?><script>setTimeout(function(){
                document.location.href="http://localhost/projet_4/public?action=authentification";
            },0000);
            alert("Veuillez vous identifiez");</script><?php
        }
    }
    private function updateArticle(){
        if(isset($_POST['envoyeur'])){
            $chapter = $_POST['chapter'];
            $title = $_POST['title'];
            $contenu = $_POST['contenu'];
            $date = date('d/m/Y');
            $id = $_POST['envoyeur'];
            $testDelete = new Article();
            $testDelete->updateArticle($chapter, $title, $contenu, $date, $id);
            unset($_SESSION['update']);
        }  
    }
    public function signalementCommentAdmin(){
        if(isset($_SESSION['authentification']) && $_SESSION['authentification']==true){
            $class = new Signalement();
            $signalementCommentAdmin = $class->signalementCommentAdmin();
            $this->traitementCommentaireSignaler();
            require('../app/view/signalementComment.phtml');
        }else{
            /*si pas acces par authentification*/
            ?><script>setTimeout(function(){
                document.location.href="http://localhost/projet_4/public?action=authentification";
            },0000);
            alert("Veuillez vous identifiez");</script><?php

        }
    }
    private function traitementCommentaireSignaler(){
        $id = isset($_GET['id'])? $_GET['id'] : null;
        $commentaire_id = isset($_GET['commentaire_id']) ? $_GET['commentaire_id'] : null;
        $class = new Signalement();
        if(isset($_GET['accepter'])&& $_GET['accepter']==true){
            $accepterCommentaireSignaler = $class->accepterCommentaireSignaler($id);
            ?><script>setTimeout(function(){
                document.location.href="http://localhost/projet_4/public?action=signalement";
            },0000);
            alert("Le commentaire a bien été accepté");</script><?php
        }else if(isset($_GET['refuser']) && $_GET['refuser']==true){
            $refuserCommentaireSignaler = $class->refuserCommentaireSignaler($id, $commentaire_id);
            ?><script>setTimeout(function(){
                document.location.href="http://localhost/projet_4/public?action=signalement";
            },0000);
            alert("Le commentaire a bien été refusé");</script><?php
        }
    } 
}
?>