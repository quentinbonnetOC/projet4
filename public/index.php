<?php
session_start();
error_reporting(E_ALL);
ob_start();
        require_once '../app/Autoloader.php';
        App\Autoloader::register();
        require_once '../app/controller/AdminController.php';
        require_once '../app/controller/UtilisateurController.php';

        if(isset($_GET['action'])){
            $adminController = new AdminController();
            switch ($_GET['action']) {
                case 'admin':
                case 'signalement':
                    $adminController->readArticle();
                    break;
                case 'authentification':
                    $adminController->authentification();
                    break;
                case 'forgetMdp':
                    $adminController->forgetMdp();
                    break;
                default:
                    echo 'Erreur';
                    break;
            }
        }else{
            $utilisateurController = new UtilisateurController();
            $utilisateurController->readArticle();
        }

 $content = ob_get_clean();
  require_once 'template.php';
