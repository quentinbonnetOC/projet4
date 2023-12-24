<?php
/**
 * Class AdminController
 * gère le backend
 */
class AdminController{

	/**
	 * @return void
	 */
	public function authentification(){
        if(!isset($_POST['envoi'])){
            $form = new Form($_POST);
            require_once '../app/view/authentification.phtml';
        }else{
            $idt = isset($_POST['remember']) && $_POST['remember'] ? $_POST['idt'] : '';
            setcookie('pseudo', $idt, time()+ 365*24*3600);
            
            $class = new Admin();
            $idt = $_POST['idt'];
            $mdp = $_POST['mdp'];
            $authentification  = $class->authentification($idt);
            if(!password_verify($mdp, $authentification->fetch()['mdp'])){
                $_SESSION['authentification'] = true;
                header('Location: ?action=admin');
            }else{
                echo "erreur d'identifiant ou de mot de passe";
            }
        }
    }

	/**
	 * @return void
	 */
	public function readArticle(){
        if(isset($_SESSION['authentification']) && $_SESSION['authentification']){
                //delete
                if(isset($_GET['delete'])){
                    header("Location: ?action=admin&id=".$_GET['id']."&confirm_delete=");
                }
                if(isset($_GET['confirm_delete']) && $_GET['confirm_delete'] === 'true'){
                    $testDelete = new Article();
                    $testDelete->deleteArticle($_GET['id']);
                    unset($_GET);
                    header("Location: ?action=admin&deleted=true");
                ///delete
                }elseif(isset($_GET['update'])){
                    //update
                    $class = new Article();
                    $updateArticle = $class->readArticle();
                    while($test = $updateArticle->fetch()){
                        if($_GET['id'] == $test['id']){
                            $chapter = $test['chapter'];
                            $title = $test['title'];
                            $contenu = $test['contenu'];
                        }
                    }
                    if(isset($_POST['envoyeur'])){
                        $class = new Article();
                        $class->updateArticle($_POST['chapter'], $_POST['title'], $_POST['contenu'], $_POST['envoyeur']);
                        header("Location: ?action=admin&updated=true");
                    }
                    require_once '../app/view/update.phtml';

                    ///update
                }else{
                    $form = new Form($_POST);
                    $class = new Article();
                    $readArticle = $class->readArticle();
                    $donnees = $readArticle->fetchAll();
                    $class = new Signalement();
                    $signalementCommentAdmin = $class->signalementCommentAdmin();
                    $signalements = $signalementCommentAdmin->fetchAll();
                    $this->traitementCommentaireSignaler();
                    if(isset($_POST['envoie']) && $_POST['envoie']=='envoyer'){
                        $class = new Article();
                        $chapter = htmlspecialchars($_POST['chapter']);
                        $contenu = htmlspecialchars($_POST['contenu']);
                        $title = htmlspecialchars($_POST['title']);
                        $date = date('Y/m/d');
                        $createArticle = $class->createArticle($chapter, $title, $contenu, $date);
                        header("Location: ?action=admin&article_created=true");
                    }
                    require_once '../app/view/backoffice.phtml';
                }
            
        }else{
            /*si pas acces par authentification*/
            header("Location: ?action=authentification&msg=''");
        }
    }

	/**
	 * @return void
	 */
	private function traitementCommentaireSignaler(){
        $id = isset($_GET['id'])? $_GET['id'] : null;
        $commentaire_id = isset($_GET['commentaire_id']) ? $_GET['commentaire_id'] : null;
        $class = new Signalement();
        if(isset($_GET['accepter'])&& $_GET['accepter']){
            $accepterCommentaireSignaler = $class->accepterCommentaireSignaler($id);
            header("Location: ?action=admin&commentaire_accept='true'");
        }elseif(isset($_GET['refuser']) && $_GET['refuser']){
            $refuserCommentaireSignaler = $class->refuserCommentaireSignaler($id, $commentaire_id);
            header("Location: ?action=admin&commentaire_refuse=true");
        }
    }

	/**
	 * @return void
	 */
	public function forgetMdp(){
        $form = new Form($_POST);
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
                        <p>Afin de réitialiser votre mot de passe, veuillez cliquer sur le lien suivant : <a href="?action=traitementForgetMdp"></a></p>
                    </body>
                </html>';
                $headers = 'Content-type: text/html; charset=\"ISO-8859-1\"' . "\r\n" .
                'From: webmaster@sfr.fr' . "\r\n" .
                'Reply-To: webmaster@sfr.fr' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
                //Envoi du mail
                error_log($email);
                $test = mail($email, $subject, $message, $headers);
                error_log((int)$test);
                //Redirection
             
            }else{
                header("Location: ?action=authentification&erreur_mail='true'");
            }
        }
        require_once '../app/view/forgetMdp.phtml';
    }
}
