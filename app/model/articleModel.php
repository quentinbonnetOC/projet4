<?php
/**
 * class article
 */
class Article extends Admin{
    public function createArticle($chapter, $title, $contenu, $date){
        $db = $this->dbConnect();
        $req = $db->query('INSERT INTO `articles`(chapter, title, contenu, date) VALUES ("'.$chapter.'", "'.$title.'", "'.$contenu.'", "'.$date.'")');
        return $req;
    }
    /**
     * @param object lire tous les articles
     */
    public function readArticle(){
        $db = $this->dbConnect();
        $req = $db->query('SELECT * FROM articles');
        return $req;
    }
    /**
     * @param object $id supprime un article
     */
    public function deleteArticle($id){
        $db = $this->dbConnect();
        $req = $db->query('DELETE FROM `articles` WHERE id="'.$id.'"');
        return $req;
    }
    /**
     * @param object $chapter, $title, $contenu, $date, $id modifie un article
     */
    public function updateArticle($chapter, $title, $contenu, $id){
        $db = $this->dbConnect();
        $req = $db->query('UPDATE `articles` SET chapter = "'.$chapter.'", contenu = "'.$contenu.'", title = "'.$title.'" WHERE id = "'.$id.'"');
        return $req;
    }
}