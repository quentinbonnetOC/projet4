<?php
session_start();
error_reporting(E_ALL);
ob_start();
        require '../app/Autoloader.php';
        App\Autoloader::register();
        require('../app/controller/adminController.php');
        require('../app/controller/utilisateurController.php');

        //require('../app/controller/utilisateurController.php');
        if(isset($_GET['action'])){
            if($_GET['action'] == 'admin')/*'name of controller de la page d'acceuil*/{
                $adminController = new AdminController();
                $adminController->readArticle();
            }else if($_GET['action']== 'authentification')/*'name of controller2'*/{
                $adminController = new AdminController();
                $adminController->authentification();
            }else if($_GET['action']=='signalement'){
                $adminController = new AdminController();
                $adminController->readArticle();
            }else if($_GET['action']=='forgetMdp'){
                $adminController = new AdminController();
                $adminController->forgetMdp();
            }else{
                echo 'Erreur';
            }
        }else{
            $utilisateurController = new UtilisateurController();
            $utilisateurController->readArticle();
        }
?>
<?php $content = ob_get_clean();?>
<?php require 'template.php';?>