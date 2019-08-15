<?php
/**
 * Class Admin
 */
class Admin{
    /**
     * @param object connexion à la bdd
     */
    public function dbConnect(){
        $db = new PDO('mysql:host=localhost; dbname=projet_4; charset=utf8', 'asul', 'asul');
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
}