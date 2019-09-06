<?php
/**
 * Class AdminController
 * gère le backend
 */
class AdminController{
    /**
     * @param object permet de s'authentifier
     */
    public function authentification(){
        if(!isset($_POST['envoi'])){
            require('../app/view/authentification.phtml');
        }else if(isset($_POST['envoi'])){
            if(isset($_POST['remember'])&& $_POST['remember']==true){
                setcookie('pseudo', $_POST['idt'], time()+ 365*24*3600);
            }else{
                setcookie('pseudo', '', time()+ 365*24*3600);                
            }
            $class = new Admin();
            $idt = $_POST['idt'];
            $mdp = $_POST['mdp'];
            $authentification  = $class->authentification($idt);
            if(password_verify($mdp, $authentification->fetch()['mdp'])){
                $_SESSION['authentification']=true;
                header('Location: ?action=admin');
            }else{
                echo "erreur d'identifiant ou de mot de passe";
            } 
        }   
    }
    /**
     * @param object permet de lire la liste des chapitres ou de supprimer un chapitre
     */
    public function readArticle(){
        if(isset($_SESSION['authentification']) && $_SESSION['authentification']==true){         
                //delete
                if(isset($_GET['delete'])){
                    $id = $_GET['id'];
                    header("Location: ?action=admin&id=".$id."&confirm_delete=");  
                }
                if(isset($_GET['confirm_delete'])&& $_GET['confirm_delete']=='true'){ 
                    $id = $_GET['id'];
                    $testDelete = new Article();
                    $testDelete->deleteArticle($id);
                    unset($_GET);
                    header("Location: ?action=admin&deleted=true");                   
                ///delete
                }else if(isset($_GET['update'])){
                    //update
                    $class = new Article();
                    $updateArticle = $class->readArticle();
                    while($test = $updateArticle->fetch()){
                        if($_GET['id'] == $test['id']){
                            $chapter = $test['chapter'] ;
                            $title = $test['title'];
                            $contenu = $test['contenu'];
                        }
                    }       
                    if(isset($_POST['envoyeur'])){
                        $chapter = $_POST['chapter'];
                        $title = $_POST['title'];
                        $contenu = $_POST['contenu'];
                        $date = date('d/m/Y');
                        $id = $_POST['envoyeur'];
                        $class = new Article();
                        $class->updateArticle($chapter, $title, $contenu, $date, $id);
                        header("Location: http://localhost/projet_4/public?action=admin&updated=true");
                    } 
                    require('../app/view/update.phtml');

                    ///update
                }else{
                    $class = new Article();
                    $readArticle = $class->readArticle();
                    $class = new Signalement();
                    $signalementCommentAdmin = $class->signalementCommentAdmin();
                    $this->traitementCommentaireSignaler();
                    if(isset($_POST['envoie']) && $_POST['envoie']=='envoyer'){
                        $class = new Article();
                        $chapter = $_POST['chapter'];
                        $contenu = $_POST['contenu'];
                        $title = $_POST['title'];        
                        $date = date('d/m/Y');
                        $createArticle = $class->createArticle($chapter, $title, $contenu, $date);
                        header("Location: ?action=admin&article_created=true");       
                    }
                    require('../app/view/backoffice.phtml');
                }      
            
        }else{
            /*si pas acces par authentification*/
            header("Location: http://localhost/projet_4/public?action=authentification&msg=''");           
        }
    }
    private function traitementCommentaireSignaler(){
        $id = isset($_GET['id'])? $_GET['id'] : null;
        $commentaire_id = isset($_GET['commentaire_id']) ? $_GET['commentaire_id'] : null;
        $class = new Signalement();
        if(isset($_GET['accepter'])&& $_GET['accepter']==true){
            $accepterCommentaireSignaler = $class->accepterCommentaireSignaler($id);
            header("Location: http://localhost/projet_4/public?action=admin&commentaire_accept='true'");            
        }else if(isset($_GET['refuser']) && $_GET['refuser']==true){
            $refuserCommentaireSignaler = $class->refuserCommentaireSignaler($id, $commentaire_id);
            header("Location: http://localhost/projet_4/public?action=admin&commentaire_refuse='true'");
        }
    } 
    public function forgetMdp(){
        if(isset($_POST['forgetMdp'])){   
            $email = $_POST['email'];
            $class = new Admin();
            $forgetMdp = $class->forgetMdp($email);
            if($forgetMdp->fetch()){
                //Variables du formulaire
                $subject = utf8_decode('Récupération de votre mot de passe'); 
                $message = '
                <html>
                    <head>
                        <title>Récupération de votre mot de passe</title>
                    </head>
                    <body>
                        <p>Bonjour Mr FORTEROCHE</p>
                        <p>Afin de réitialiser votre mot de passe, veuillez cliquer sur le lien suivant : <a href="localhost/projet_4/public/?action=traitementForgetMdp"></a></p>
                    </body>
                </html>';
                $headers = 'Content-type: text/html; charset=\"ISO-8859-1\"' . "\r\n" .
                'From: webmaster@sfr.fr' . "\r\n" .
                'Reply-To: webmaster@sfr.fr' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();                    
                //Envoi du mail
                $test = mail($email, $subject, $message, $headers);
                //Redirection
             
            }else{
                header("Location: http://localhost/projet_4/public/?action=authentification&erreur_mail='true'");
            }
        }
        require('../app/view/forgetMdp.phtml');
    }
}
?>