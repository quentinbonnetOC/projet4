<?php
session_start();
function authentification(){
    if($_SESSION['authentification'] == true){
        readArticle();
    }else if(!isset($_POST['envoi'])){
        require('../app/view/authentification.phtml');
    }else if(isset($_POST['envoi'])&& $_POST['envoi']=='envoyer'){
        $class = new Admin();
        $idt = $_POST['idt'];
        $mdp = $_POST['mdp'];
        $authentification  = $class->authentification($idt, $mdp);
        
        if($authentification->fetch()){
            $_SESSION['authentification'] = true;
            readArticle();
        }else{
            echo "erreur d'identifiant ou de mot de passe";
        }
    }   
}
function createArticle(){   
    if(isset($_POST['envoie']) && $_POST['envoie']=='envoyer'){
        var_dump($_POST);
        $class = new Admin();
        $chapter = $_POST['chapter'];
        $title = $_POST['title'];        
        $date = "toto";
        $createArticle = $class->createArticle($chapter, $title, $date);       
    }
    require('../app/view/createArticle.phtml');
}
function readArticle(){
    if(isset($_SESSION['update']) && $_SESSION['update']  == true){
        updateArticle();
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
            updateArticle();
            ///update
        }else{
            $class = new Admin;
            $readArticle = $class->readArticle();
            require('../app/view/backoffice.phtml');
        }       
    } 
}
function updateArticle(){
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
?>