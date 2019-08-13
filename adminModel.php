<?php
/**
 * Class Admuin
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
    public function createArticle($chapter, $title, $date){
        $db = $this->dbConnect();
        $req = $db->query('INSERT INTO `articles`(chapter, title, date) VALUES ("'.$chapter.'", "'.$title.'", "'.$date.'")');
        return $req;
    }
    public function readArticle(){
        $db = $this->dbConnect();
        $req = $db->query('SELECT * FROM articles');
        return $req;
    }
    public function deleteArticle($id){
        $db = $this->dbConnect();
        $req = $db->query('DELETE FROM `articles` WHERE id="'.$id.'"');
        return $req;
    }
    public function updateArticle($chapter, $title, $date, $id){
        $db = $this->dbConnect();
        $req = $db->query('UPDATE `articles` SET chapter = "'.$chapter.'", title = "'.$title.'", date = "'.$date.'" WHERE id = "'.$id.'"');
        return $req;
    }
    public function signalementCommentAdmin(){
        $db = $this->dbConnect();
        $req = $db->query('SELECT * FROM `signalement`');
        return $req;
    }
}