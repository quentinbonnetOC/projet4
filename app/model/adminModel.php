<?php
/**
 * Class Admin
 */
class Admin{
    /**
     * @param object connexion à la bdd
     */
    public function dbConnect(){
        $db = new PDO('mysql:host=db5000153133.hosting-data.io; dbname=dbs148219; charset=utf8', 'dbu321898', '0306LOVe!');
        return $db;
    }
    /**
     * @param object selection de tous les admins
     */
    public function authentification($idt){
        $db = $this->dbConnect();
        $req = $db->query('SELECT * FROM admin WHERE idt = "'.$idt.'"');
        return $req;
    }
    public function forgetMdp($email){
        $db = $this->dbConnect();
        $req = $db->query('SELECT * FROM admin WHERE email = "'.$email.'"');
        return $req;
    }
}